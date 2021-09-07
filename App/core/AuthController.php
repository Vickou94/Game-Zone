<?php

namespace App\core;
use App\Autoloader;
use App\core\Session;
require_once 'App/core/Session.php';

class AuthController{
    
    private User $user;
    
    public function __construct(User $user){
        
         $this->userClass = $user;
    }
    
    public function registerForm(array $fields){
        $tabMessages = [];
        
        foreach($fields as $field => $content){
            if( empty($fields[$field]) ){
                Session::setInputs($_POST);
                return [ ['Les champs ne sont pas remplis'] ];
            }
        }
        
        if(!filter_var($fields['user_email'], FILTER_VALIDATE_EMAIL))
            $tabMessages[] = ['Ce n\'est pas un mail valide '];

        if($fields['user_password'] !== $fields['password_confirm'])
            $tabMessages[] = ['Les mots de passe sont differents'];
            
        if($this->userClass->getOneUser($fields['user_email']) == true)
            $tabMessages[] = ['Un utilisateur existe deja avec cet email'];
        
        
        // je rentre dans le if si j'ai au moins une erreur 
        if($tabMessages){
            Session::setInputs($_POST);
            return $tabMessages;
        };
        
        
        $this->userClass->addOneUser($_POST);
        // Session::resetSession('input');
        alert('Bravo votre compte à été crée');
        
        header('location: index.php?page=login');
        exit();
        
        
        
    }
    
    
    public  function loginForm(array $fields){
        $tabMessages     = [];  
        
        foreach($fields as $field => $content){
            if( empty($fields[$field]) ){
                return [ ['Les champs ne sont pas remplis'] ];
            }
        }
        
        $user = $this->userClass->getOneUser($fields['user_email']);
        
        if($user == false)
            return [ ['L\'utilisateur n\'existe pas'] ];
            
    
        if (password_verify($fields['user_password'], $user['user_password']) == false)
            return [ ['Mot de passe incorrect'] ];
    
        // je met toutes les infos dans $_SESSION
        Session::setUser($user);
        Session::setFlashMessage('Félicitations vous êtes connecté');

        header('location: index.php');
        exit();  
    }
    
    
}