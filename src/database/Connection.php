<?php

    namespace Database;

    abstract class Connection{

        private static $conn;

        public function getConn(){ 
            if(!self::$conn){
                self::$conn = new \PDO('mysql:host=localhost;dbname=project_test', 'root','');
            }
            return self::$conn;

        }   
    }