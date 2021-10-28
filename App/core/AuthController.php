<?php

require_once 'App/core/Session.php';

class AuthController{
    
    private User $user;
    
    public function __construct(User $user){
        
         $this->userClass = $user;
    }

    //GESTION DES ERREURS CREATION DE COMPTE
    
    public function registerForm(array $fields){
        $tabMessages = [];
        
        foreach($fields as $field => $content){
            if(empty($fields[$field]) ){
                Session::setInputs($_POST);
                return [ ['Les champs ne sont pas remplis'] ];
            }
        }
        
        if(!filter_var($fields['user_email'], FILTER_VALIDATE_EMAIL))
            $tabMessages[] = ['Ce n\'est pas un mail valide '];

        if(strlen($fields['user_password']) < 4)
        $tabMessages[] = ['Le mot de passe doit contenir au moins 4 caractères'];

        if($fields['user_password'] !== $fields['password_confirm'])
            $tabMessages[] = ['Les mots de passe sont differents'];
            
        if($this->userClass->getOneUser($fields['user_email']) == true)
            $tabMessages[] = ['Un utilisateur existe deja avec cet email'];
        
         
        if($tabMessages){
            Session::setInputs($_POST);
            return $tabMessages;
        };
        
        //SI PAS D'ERREUR ALORS ON VALIDE LA CREATION AVEC UN FLASHMESSAGE
        
        $this->userClass->addOneUser($_POST);
        Session::setFlashMessage('success','Félicitations votre compte a bien été créé');
        header('location: index.php?page=login');
        exit();
        
        
        
    }
    
        //GESTION DES ERREURS A LA CONNEXION
    
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
    
        
        Session::setUser($user);
        Session::setFlashMessage('success','Bienvenue ' . ($user['user_email']));

        header('location: index.php');
        exit();  
    }
    
    
}