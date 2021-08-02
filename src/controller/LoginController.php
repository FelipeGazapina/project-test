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

                header('Location: http://projecttest/dashboard');

            } catch (\Exception $e) {
                header('Location: http://projecttest/');
            }
        }
    }