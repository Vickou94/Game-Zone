<?php 

session_start();
// require 'App/Controller/AppController.php';
use App\Autoloader;
use App\Controller\AppController;

require_once 'App/Autoloader.php';
Autoloader::load();

$app = new AppController();

if(array_key_exists('page',$_GET)):
    
    $page = $_GET['page'];
    
    switch($page){
        
        case 'home':
        case 'login':
        case 'logout':
        case 'register':
        case 'about':
        case 'allGames':
        
            
        break;
        // si jamais je tombe dans un cas ou l'user a modifié index.php?route= alors je vais dans default 
        default : 
            $page = 'home';
        
        
    }
    
    $app->$page();
    
    
else:
    // si jamais je tombe dans un cas ou l'user à enlevé index.php?route= alors je vais sur la page d'accueil
    header('location: index.php?page=home');
    exit;
    
endif;