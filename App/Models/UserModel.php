<?php

namespace App\Models;
use App\Autoloader;
use App\core\Database;
require_once 'App/Autoloader.php';
Autoloader::load();
// require_once 'App/core/Database.php';


class User extends Database {
    

    public function addOneUser( array $infoUser) :void {
    
        $password_crypted = password_hash($infoUser['user_password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO 
                    `users`( `user_firstname`, 
                            `user_lastname`, 
                            `user_email`,
                            `user_password`)

                VALUES 
                    (       :user_firstname, 
                            :user_lastname, 
                            :user_email,
                            :user_password)";
                            
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':user_firstname', $infoUser['user_firstname'] , PDO::PARAM_STR);
        $query->bindValue(':user_lastname', $infoUser['user_lastname'] , PDO::PARAM_STR);
        $query->bindValue(':user_email', $infoUser['user_email'] , PDO::PARAM_STR);
        $query->bindValue(':user_password', $password_crypted , PDO::PARAM_STR);
        $query->execute(); 
        

    }


    public function getOneUser( string $mail) :array {
        
        $sql =  "SELECT 
                    `user_id`, 
                    `user_firstname`, 
                    `user_lastname`, 
                    `user_email`, 
                    `user_password`
                FROM 
                    `users` 
                WHERE 
                    `user_email` = :user_email";
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':user_email', $mail , PDO::PARAM_STR);
        $query->execute(); 
        
        return ($query->fetch(PDO::FETCH_ASSOC)) ?:  [];
        
    }

    // recupere tout les Users 
    function getAllUser() :array {
        
        $sql =  "SELECT 
                    `user_id`, 
                    `user_firstname`, 
                    `user_lastname`, 
                    `user_email`, 
                    `user_password`
                FROM 
                    `users` 
                ORDER BY 
                    `users`.`user_id` ASC";
        $query = $this->pdo->prepare($sql);
        $query->execute(); 
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
     
    }
    
}


