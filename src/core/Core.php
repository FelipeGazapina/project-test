<?php
    class Core{
        public function start($urlGet,$post){
            if(isset($urlGet['page'])){
                $controller = ucfirst($urlGet['page']) . 'Controller';

            }else{
                $controller = 'HomeController';
            }
            if(isset($urlGet['acao'])){
                $acao = ucfirst($urlGet['acao']);

            }else{
                $acao = 'index';
            }
            

            if(!class_exists($controller)){
                $controller = 'ErrorController';

            }

            call_user_func_array(array(new $controller, $acao), $post);
            
        }
    }
?>