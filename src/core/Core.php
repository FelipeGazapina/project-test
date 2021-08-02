<?php
    ini_set('display_errors', 1);

class Core {

    private $url;

    private $controller;
    private $method = 'index';
    private $params = array();

    private $user;

    public function __construct(){
        $this->user = $_SESSION['user'] ?? null;
    }

    public function start($request){
        if(isset($request['url'])){
            $this->url = explode('/', $request['url']);

            $this->controller = ucfirst($this->url[0]). 'Controller';
            array_shift($this->url);

            if(isset($this->url[0]) && $this->url != ''){ 
                $this->method = $this->url[0];
                array_shift($this->url);
            }
            if(isset($this->url[0]) && $this->url != ''){ 
                $this->params = $this->url;
                array_shift($this->url);
            }
            
        }
        if($this->user){
            $pg_permition = ['DashboardController'];

            if(!isset($this->controller) || !in_array($this->controller,$pg_permition)){
                $this->controller = 'DashboardController';
                $this->method = 'index';
            }
        }else{
            $pg_permition = ['LoginController','CadastrarController'];

            if(!isset($this->controller) || !in_array($this->controller,$pg_permition)){
                $this->controller = 'LoginController';
                $this->method = 'index';
            }
        }
        // var_dump($this->controller, $this->method);
        return call_user_func(array(new $this->controller, $this->method),$this->params);
    }
        
}