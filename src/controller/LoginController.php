<?php

    class LoginController{
        public function index(){ 
            
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache',
                'auto_reload' => true
            ]);
            $template = $twig->load('login.html');
            return $template->render(['the' => 'variables', 'go' => 'here']);
        }
        public function check(){

            try {
                $user = new User();
                $user->setUser_name($_POST['user']);
                $user->setUser_pass($_POST['password']);
                $user->checkLogin();

                $pontos = new Pontos();
                $pontos->setId_user($user->getId_user());
                $pontos->setPontos('0');
                $pontos->setPontos_alterado(date("Y-m-d H:i:s"));
                $pontos->setStatus_pontos('A');
                $pontos->createPontos();

                header('Location: http://projecttest/dashboard');

            } catch (\Exception $e) {
                header('Location: http://projecttest/');
            }
        }
    }