<?php

namespace App\core;

class Session {
    
    
    public static function setFlashMessage(string $message){
        
        $_SESSION['flash-message'] = $message;
        
    }
    

    /**
     * le but c'est d'appeler la fonction dans le form comme çà si jamais le coup d'avant il n'avait pas été validé je récupere mes valeurs 
     * c'est une fonction qu'on appelera dans chaque input du form 
     * 
     */
    public static function setInputs(array $fields) :void{
        
        foreach($fields as $key => $value){

            $_SESSION['input'][$key] = $value;

        }
        

    }
    
    
    public static function setUser(array $fields) :void{
        
        foreach($fields as $key => $value){

            if (is_numeric($value)):
                $value = intval($value);
            else:
                $value = htmlspecialchars($value);
            endif;
            
            $_SESSION['user'][$key] = $value;

        }
        

    }
    
    
    public static function resetSession(string $tabSession):void{
        
        unset($_SESSION[$tabSession]);

    }
    
    
    
    
    
}
