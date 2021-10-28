<?php 

session_start();
require 'App/Controller/AppController.php';


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
        case 'allArticles':
        case 'oneArticle':
        case 'oneComment':
        case 'deleteCom':
        case 'editCom':
        case 'deleteArt':
        case 'editArt':
        
        
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