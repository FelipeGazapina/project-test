<?php


class User {

    public function create($nome, $user, $senha){

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (name_user, user_name, user_pass, status_user) VALUES(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $user, $senha, 'A'));
        Banco::desconectar();
    }

    public function search($user){

        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE user_name = ? AND status_user = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user, 'A'));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Banco::desconectar();

        return $data;
    }
}