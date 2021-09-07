<?php

namespace App\Controller;

use App\Autoloader;
use App\core\AuthController;
use App\Models\UserModel;
require_once 'App/Autoloader.php';
Autoloader::load();

// require_once 'App/Models/UserModel.php';
// require_once 'App/core/Session.php';
// require_once 'App/core/AuthController.php';

class AppController{
    
    
    
    public function home(){
        
    
    $title= 'Accueil - Game-Zone ';
    $view = 'Views/homeView.php';
    require 'Template/template.php';
        

        
    }
    
    public function allGames(){
        
    $title= 'Tous les jeux - Game-Zone ';
    $view = 'Views/allGamesView.php';
    require 'Template/template.php';
        

        
    }
    
    public function about(){        
    
    $title= 'A propos - Game-Zone ';
    $view = 'Views/aboutView.php';
    require 'Template/template.php';
        

        
    }
    
    public function register(){

    if($_POST):            
        $auth = new AuthController(new User);
        $tabMessages = $auth->registerForm($_POST);           
    endif;
        
    
    $title= 'Créer un compte - Game-Zone ';
    $view = 'Views/registerView.php';
    require 'Template/template.php';
        

        
    }
    
    public function login(){
        
    if($_POST):            
            $auth = new AuthController(new User);
            $tabMessages = $auth->loginForm($_POST);               
    endif;
        
    $title= 'Se connecter - Game-Zone ';
    $view = 'Views/loginView.php';
    require 'Template/template.php';
        
    }

    public function logout(){
        
        session_start();
        Session::resetSession('user');
        Session::setFlashMessage('success','Au revoir et à bientôt');
        
        header('Location: index.php');
        exit;
        
    }

}