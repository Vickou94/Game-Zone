<?php

//CONNEXION A LA BDD

class Database{
    
    private string $server;
    private string $user;
    private string $password;
    private array $options;
    public PDO $pdo;
    
    public function __construct(){

        $this->server   = 'mysql:host=localhost;dbname=gamezone';
        $this->user     = 'root';
        $this->password = '';
        $this->options  = [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'  
                        ];
                        
        $this->pdo = $this->connexion();
    }
    
    
    
    public function connexion(){
        
       try {

            return new PDO($this->server,$this->user,$this->password,$this->options);
                                
        } catch (PDOException $e) {
                
            echo 'Impossible de se connecter : ' .$e->getMessage();
    
        } 
        
        
    }
    
}


