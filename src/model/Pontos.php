<?php

    use Database\Connection;

    class Pontos{ 

        private $id_pontos;
        private $id_user;
        private $pontos;
        private $status_pontos;


        
        public function createPontos(){ 
            $conn = Connection::getConn();

            //** VERIFICA SE O USUÁRIO JA TEM PONTOS */
            $sql = 'SELECT * from pontos WHERE id_user = :id_user';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id_user', $this->id_user);
            $stmt->execute();

            if($stmt->rowCount()){
                $sql = 'UPDATE pontos SET pontos = :pontos WHERE id_user = :id_user';
                
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id_user', $this->id_user);
                $stmt->bindValue(':pontos', $this->pontos);
                $stmt->execute();

                if($stmt->rowCount()){
                    $result = $stmt->fetch();
    
                    return true;
                }

            }else{
            //** SE NÃO HOUVER PONTOS INSERE NA TABELA */

                $sql = 'INSERT INTO pontos (id_user,pontos,status_pontos) VALUES (:id_user,:pontos,:status_pontos) ';

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id_user', $this->id_user);
                $stmt->bindValue(':pontos', $this->pontos);
                $stmt->bindValue(':status_pontos', $this->status_pontos);
    
                $stmt->execute();
    
                if($stmt->rowCount()){
                    $result = $stmt->fetch();
    
                    return true;
                }
            }
            
            throw new \Exception('Cadastro de Pontos Inválido');

        }

        public function deletarPontos(){ 
            $conn = Connection::getConn();

            $sql = 'UPDATE pontos SET status_pontos = :status_pontos WHERE id_user = :id_user';

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id_user', $this->id_user);
            $stmt->bindValue(':status_pontos', $this->status_pontos);

            $stmt->execute();

            if($stmt->rowCount()){
                $result = $stmt->fetch();
            

                return true;
            
            }

            throw new \Exception('Exclusão dos pontos Inválida');
        }


        public function setId_user($id_user){ 
            $this->id_user = $id_user;
        }
        public function setPontos($pontos){ 
            $this->pontos = $pontos;
        }
        public function setStatus_pontos($status_pontos){ 
            $this->status_pontos = $status_pontos;
        }
        public function getId_user(){ 
            return $this->id_user;
        }
        public function getPontos(){ 
            return $this->pontos;
        }
        public function getStatus_pontos(){ 
            return $this->status_pontos;
        }
        public function getDados($id){ 
            $conn = Connection::getConn();

            $sql = 'SELECT id,user_perm,name_user,user_name,status_user FROM users WHERE id = :id';

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);

            $stmt->execute();

            if($stmt->rowCount()){
                $result = $stmt->fetch();
            
                if($result['user_perm'] === 'ADM'){ 

                    $sql = 'SELECT id_user,pontos FROM pontos WHERE status_pontos = "A"';
                    

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    if($stmt->rowCount()){
                        $response = $stmt->fetchAll();
                        $_SESSION['pontos'] = array('pontos'=>$response);

                    }

                }else{
                    $sql = 'SELECT pontos FROM pontos WHERE status_pontos = "A" AND id_user = :id_user';
                    

                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':id_user', $id);
                    $stmt->execute();

                    if($stmt->rowCount()){
                        $response = $stmt->fetch();
                        
                        $_SESSION['pontos'] = array('pontos'=>$response['pontos']);

                    }

                }

                return true;
            
            }

            throw new \Exception('Busca por pontos Inválida');
        }
    }