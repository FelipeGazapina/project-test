<?php

require_once '/src/database/DB.class.php';

class User {
    public $nome;
    public $user;
    public $senha;

    public function __construct(){
        
    }

    public function create($nome, $user, $senha){
        $this->nome = $nome;
        $this->user = $user;
        $this->senha = $senha;

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (nome_user, login_user, senha_user, status_user) VALUES(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $user, $senha, 'A'));
        Banco::desconectar();
    }
}