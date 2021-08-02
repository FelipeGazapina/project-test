<?php

    use Database\Connection;

    class User{ 

        private $id;
        private $name_user;
        private $user_name;
        private $user_pass;
        private $status_user;


        public function checkLogin(){ 
            $conn = Connection::getConn();

            $sql = 'SELECT * FROM users WHERE user_name = :user_name';

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':user_name', $this->user_name);

            $stmt->execute();

            if($stmt->rowCount()){
                $result = $stmt->fetch();

                if($result['user_pass'] === $this->user_pass){
                    if($result['user_perm'] === 'ADM'){ 

                        $sql = 'SELECT id,user_perm,name_user,user_name,status_user FROM users WHERE status_user = "A"';
                        

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        if($stmt->rowCount()){
                            $response = $stmt->fetchAll();
                            $_SESSION['user'] = array('id'=>$result['id'], 'name_user'=>$result['name_user']);
                            $_SESSION['users'] = array('users' => $response);
                        }

                    }else{
                        $_SESSION['user'] = array('id'=>$result['id'], 'name_user'=>$result['name_user']);

                    }

                    return true;
                }
            }

            throw new \Exception('Login Inválido');
            
        }
        public function createUser(){ 
            $conn = Connection::getConn();

            $sql = 'INSERT INTO users (name_user,user_name,user_pass,status_user) VALUES (:name_user,:user_name,:user_pass,:status_user) ';

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name_user', $this->name_user);
            $stmt->bindValue(':user_name', $this->user_name);
            $stmt->bindValue(':user_pass', $this->user_pass);
            $stmt->bindValue(':status_user', $this->status_user);

            $stmt->execute();

            if($stmt->rowCount()){
                $result = $stmt->fetch();

                return true;
            }
            throw new \Exception('Cadastro Inválido');

        }
        public function deletarUser($id){ 
            $conn = Connection::getConn();

            $sql = 'UPDATE users SET status_user = :status_user WHERE id = :id_user';

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id_user', $id);
            $stmt->bindValue(':status_user', $this->status_user);

            $stmt->execute();

            if($stmt->rowCount()){
                $result = $stmt->fetch();
            

                return true;
            
            }

            throw new \Exception('Busca por pontos Inválida');
        }


        public function setName_user($name_user){ 
            $this->name_user = $name_user;
        }
        public function setUser_name($user_name){ 
            $this->user_name = $user_name;
        }
        public function setUser_pass($user_pass){ 
            $this->user_pass = $user_pass;
        }
        public function setStatus_user($status_user){ 
            $this->status_user = $status_user;
        }
        public function getName_user(){ 
            return $this->name_user;
        }
        public function getUser_name(){ 
            return $this->user_name;
        }
        public function getUser_pass(){ 
            return $this->user_pass;
        }
        public function getStatus_user(){ 
            return $this->status_user;
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

                    $sql = 'SELECT id,user_perm,name_user,user_name,status_user FROM users WHERE status_user = "A"';
                    

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    if($stmt->rowCount() != 0){
                        $response = $stmt->fetchAll();
                        
                        $_SESSION['user'] = array('id'=>$result['id'], 'name_user'=>$result['name_user']);
                        $_SESSION['users'] = array('users' => $response);

                    }

                }else{
                    $_SESSION['user'] = array('id'=>$result['id'], 'name_user'=>$result['name_user']);

                }

                return true;
            
            }

            throw new \Exception('Login Inválido');
        }
    }