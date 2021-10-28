<?php


require_once 'App/Models/UserModel.php';
require_once 'App/Models/ArticleModel.php';
require_once 'App/Models/CommentModel.php';
require_once 'App/core/Session.php';
require_once 'App/core/AuthController.php';

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

    // ARTICLES CONTROLLER
    
    public function allArticles(){

        //AFFICHAGE DES ARTICLES

        $articleModel = new Article();
        $articles = $articleModel->getAllArticles();

        //AJOUT D'UN ARTICLE PAR UN ADMIN

        if(isset($_POST['submit_article'])) {
            if(!empty($_POST['title']) && !empty($_POST['article_content']) && !empty($_POST['article_img'])) {

                
            $addArticleModel = new Article();
            $addoneArticle = $addArticleModel->addArticle($_POST['title'],
                                                          $_POST['article_img'],
                                                          $_POST['article_content'],
                                                          $_SESSION['user']['user_id']);

            header('Location: index.php?page=allArticles');

            }else{
                $erreur = "Tous les champs doivent être complétés";
            }
        }        
        
        
        

    $title = 'Tous les articles - Game-Zone ';
    $view = 'Views/articlesView.php';
    require 'Template/template.php';
               
    }

        // MODIFICATION D'UN ARTICLE

    public function editArt() {
    
        if($_POST){
            if(!empty($_GET['articleId']) && !empty($_POST['article_content']) && !empty($_POST['article_img'])) {
                    
                    $editArticleModel = new Article();
                    $editArticleModel->editArticle($_GET['articleId'],
                                                   $_POST['article_title'], 
                                                   $_POST['article_img'], 
                                                   $_POST['article_content']);
    
                header('Location: index.php?page=allArticles');
                
                }else{
                    $erreur = "Tous les champs doivent être complétés";
                }   
            }
        $title = 'Modifiez votre article - Game-Zone';
        $view = 'Views/editArticleView.php';
        require 'Template/template.php';
        }

        //SUPPRESSION D'UN ARTICLE PAR UN ADMIN

    public function deleteArt() {

        $deleteArticleModel = new Article();
        $deleteArticleModel->deleteArticle($_GET['articleId']);

        header('Location: index.php?page=allArticles');
        exit;

    }

    public function oneArticle(){

        // AFFICHAGE D'UN ARTICLE COMPLET

        if(isset($_GET['articleId']) && !empty($_GET['articleId'])) {
            $articleId = htmlspecialchars($_GET['articleId']);
        
            $articleModel = new Article();
            $article = $articleModel->getOneArticle($articleId);
        }
        // Si article n'est pas dans la BDD ou que l'id est <= à 0
        if ((!$article) OR ($articleId <= 0)) {               
            echo 'Erreur, l\'article demandé n\'existe pas.';
            exit();     
        }

        // AJOUT DES COMMENTAIRES

        if(isset($_POST['submit_comment'])) {
            if(!empty($_POST['pseudo']) && !empty($_POST['content'])) {

                
            $addCommentModel = new Comment();
            $addoneComment = $addCommentModel->addComment($_POST['pseudo'],
                                                          $_POST['content'],
                                                          $_SESSION['user']['user_id'],
                                                          $_GET['articleId']);

            header('Location: index.php?page=oneArticle&articleId=' . $_GET['articleId']);

            }else{
                $erreur = "Tous les champs doivent être complétés";
            }
        }

        // AFFICHAGE DES COMMENTAIRES
            $commentModel = new Comment();
            $comments = $commentModel->getComments($_GET['articleId']);
  

    $title = 'Détail de l\'article - Game-Zone';
    $view = 'Views/oneArticleView.php';
    require 'Template/template.php';
    }


    public function editCom() {

        // RECUPERATION D'UN COMMENTAIRE
        
                if(isset($_GET['commentId']) && !empty($_GET['commentId'])) {
                    $commentId = htmlspecialchars($_GET['commentId']);
                
                    $commentModel = new Comment();
                    $comment = $commentModel->getOneComment($commentId);
                }
                // Si article n'est pas dans la BDD ou que l'id est <= à 0
                if ((!$comment) OR ($commentId <= 0)) {               
                    echo 'Erreur, le commentaire demandé n\'existe pas.';
                    exit();     
                }
        
        // MODIFICATION D'UN COMMENTAIRE
    
        if($_POST){
            if(!empty($_GET['commentId']) && !empty($_POST['content'])) {
                
                $editCommentModel = new Comment();
                $editCommentModel->editComment($_GET['commentId'], $_POST['content']);

            header('Location: index.php?page=allArticles');
            
            }else{
                $erreur = "Tous les champs doivent être complétés";
            }   
        }
    $title = 'Modifiez votre commentaire - Game-Zone';
    $view = 'Views/editCommentView.php';
    require 'Template/template.php';
    }

        // SUPPRESSION D'UN COMMENTAIRE

    public function deleteCom() {

        $deleteCommentModel = new Comment();
        $deleteCommentModel->deleteComment($_GET['commentId']);

        header('Location: index.php?page=allArticles');
        exit;

    }

        //PAGE A PROPOS

    public function about(){        
    
    $title = 'A propos - Game-Zone ';
    $view = 'Views/aboutView.php';
    require 'Template/template.php';
        
        
    }
    
        // CREATION DE COMPTE

    public function register(){

    if($_POST):            
        $auth = new AuthController(new User);
        $tabMessages = $auth->registerForm($_POST);           
    endif;
        
    
    $title = 'Créer un compte - Game-Zone ';
    $view = 'Views/registerView.php';
    require 'Template/template.php';
        
    }
    
        // CONNEXION

    public function login(){
        
    if($_POST):            
        $auth = new AuthController(new User);
        $tabMessages = $auth->loginForm($_POST);             
    endif;
    
        
    $title = 'Se connecter - Game-Zone ';
    $view = 'Views/loginView.php';
    require 'Template/template.php';
        
    }

        // DECONNEXION

    public function logout(){
        
        session_start();
        Session::resetSession('user');
        Session::setFlashMessage('success','Au revoir et à bientôt');
        
        header('Location: index.php');
        exit;
        
    }

}