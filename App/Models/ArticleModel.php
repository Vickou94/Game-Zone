<?php

require_once 'App/core/Database.php';



class Article extends Database {
    

    // recupere un article 
    public function getOneArticle($article_id) :array {
        
        $sql = 'SELECT 
                    `article_id`, 
                    `article_title`, 
                    `article_content`,
                    `article_image`,
                    `article_creation_date` 
                FROM 
                    `articles` 
                    
                WHERE `article_id` = :article_id';
                    
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':article_id', $article_id , PDO::PARAM_INT);
        $query->execute();
    
        
        return ($query->fetch(PDO::FETCH_ASSOC)) ?:  [];
        

    }
    
    // recupere tous les articles
    public function getAllArticles() :array{
        
        $sql = 'SELECT
                    `article_id`,
                    `article_title`,
                    `article_content`,
                    `article_creation_date`
                FROM 
                    `articles` 
                ORDER BY 
                    `articles`.`article_id` DESC';
                    
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC); 
        
    }

    // ajout d'un article
    public function addArticle(string $articleTitle, string $articleImage, string $articleContent, string $articleUserId) {

        $sql = 'INSERT INTO
                    `articles`(
                              `article_title`,
                              `article_image`,
                              `article_content`,
                              `article_user_id`)
                VALUES
                    (         
                              :article_title,
                              :article_image,
                              :article_content,
                              :article_user_id)';

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':article_title', $articleTitle, PDO::PARAM_STR);
        $query->bindValue(':article_image', $articleImage, PDO::PARAM_STR);
        $query->bindValue(':article_content', $articleContent, PDO::PARAM_STR);
        $query->bindValue(':article_user_id', $articleUserId, PDO::PARAM_STR);
        $query->execute();
    }

    //modification d'un article
    public function editArticle(int $articleId, string $articleTitle, string $articleImage, string $articleContent) {

        $sql = 'UPDATE
                    `articles`
                SET 
                    `article_title` = :article_title,
                    `article_image` = :article_image,
                    `article_content` = :article_content
                WHERE 
                     article_id = :article_id';

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':article_title', $articleTitle, PDO::PARAM_STR);
        $query->bindValue(':article_image', $articleImage, PDO::PARAM_STR);
        $query->bindValue(':article_content', $articleContent, PDO::PARAM_STR);
        $query->bindValue(':article_id', $articleId, PDO::PARAM_INT);      
        $query->execute();

    }
    
    //supression d'un article
    public function deleteArticle(int $articleId) {

        $sql = 'DELETE FROM 
                    `articles`
                WHERE 
                     article_id = :article_id';

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':article_id', $articleId, PDO::PARAM_INT);
        $query->execute();

    }
}