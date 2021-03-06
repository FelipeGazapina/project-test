<?php
    ini_set('display_errors', 1);

    class CadastrarController{
        public function index(){ 
            
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache',
                'auto_reload' => true
            ]);
            $template = $twig->load('cadastrar.html');
            return $template->render(['the' => 'variables', 'go' => 'here']);
        }
        public function create(){

            try {
                $user = new User();
                $user->setName_user($_POST['name']);
                $user->setUser_name($_POST['user']);
                $user->setUser_pass($_POST['password']);
                $user->setStatus_user('A');
                $user->createUser();

                header('Location: http://projecttest/');

            } catch (\Exception $e) {
                header('Location: http://projecttest/cadastrar');
            }
        }
    }