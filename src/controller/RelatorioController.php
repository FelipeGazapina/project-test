<?php

    class RelatorioController{

        private $ord = 'ASC';

        public function index(){ 

            if(isset($_POST['ord'])){
                $this->ord = $_POST['ord'];
            }
            // print_r($_POST['ord']);die();
            $user = new User();
            $user->getDados($_SESSION['user']['id'],$this->ord);
            
            $pontos = new Pontos();
            $pontos->getDados($_SESSION['user']['id']);
            
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache',
                'auto_reload' => true
            ]);
            $template = $twig->load('relatorio.html');
            if(isset($_SESSION['users'])){
                return $template->render(['id' => $_SESSION['user']['id'], 'name_user' => $_SESSION['user']['name_user'], 'users' => $_SESSION['users'], 'pontuacao' => $_SESSION['pontos']]);
            }
            return $template->render(['id' => $_SESSION['user']['id'], 'name_user' => $_SESSION['user']['name_user'], 'pontuacao' => $_SESSION['pontos']]);
        }

        public function alterar(){ 
            try {
                $pontos = new Pontos();
                $pontos->setId_user($_POST['id_user']);
                $pontos->setPontos($_POST['pontos']);
                $pontos->setStatus_pontos('A');
                $pontos->createPontos();


                header('Location: http://projecttest/dashboard');

            } catch (\Exception $e) {
                header('Location: http://projecttest/');
            }
        }
        

        public function logout(){
            unset($_SESSION['user']);
            session_destroy();

            header('Location: http://projecttest/');
        }
    }