<?php

require_once 'App/core/Database.php';


class Comment extends Database {

    // recuperer un commentaire 
    public function getOneComment($comment_id) :array {
        
        $sql = 'SELECT 
                    `comment_id`, 
                    `comment_content`,
                    `comment_user_id`,
                    `comment_created_at`
                FROM 
                    `comments` 
                    
                WHERE `comment_id` = :comment_id';
                    
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':comment_id', $comment_id , PDO::PARAM_INT);
        $query->execute();
    
        
        return ($query->fetch(PDO::FETCH_ASSOC)) ?:  [];
        

    }
    
    //recuperer tous les commentaires
    public function getComments(string $articleId) :array {
        
        $sql =  'SELECT 
                    `comment_id`,
                    `comment_pseudo`,
                    `comment_content`,
                    `comment_created_at`,
                    `comment_user_id`,
                    `comment_article_id`
                FROM 
                    `comments`

                WHERE 
                     comment_article_id = :comment_article_id
                ORDER BY 
                    `comments`.`comment_id` DESC';

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':comment_article_id', $articleId, PDO::PARAM_INT);
        $query->execute();             
        return $query->fetchAll(PDO::FETCH_ASSOC);
         
    }

    //ajouter un commentaire
    public function addComment(string $commentPseudo, string $commentContent, int $userId, int $articleId) {

        $sql = 'INSERT INTO
                    `comments`(
                              `comment_pseudo`,
                              `comment_content`,
                              `comment_user_id`,
                              `comment_article_id`)
                VALUES
                    (         
                              :comment_pseudo,
                              :comment_content,
                              :comment_user_id,
                              :comment_article_id)';


        $query = $this->pdo->prepare($sql);
        $query->bindValue(':comment_pseudo', $commentPseudo, PDO::PARAM_STR);
        $query->bindValue(':comment_content', $commentContent, PDO::PARAM_STR);
        $query->bindValue(':comment_article_id', $articleId, PDO::PARAM_INT);
        $query->bindValue(':comment_user_id', $userId, PDO::PARAM_INT);
        $query->execute();
    }

    //modifier un commentaire
    public function editComment(int $commentId, string $commentContent) {

        $sql = 'UPDATE
                    `comments`
                SET 
                    `comment_content` = :comment_content
                WHERE 
                     comment_id = :comment_id';

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':comment_content', $commentContent, PDO::PARAM_STR);
        $query->bindValue(':comment_id', $commentId, PDO::PARAM_INT);      
        $query->execute();

    }

    //supprimer un commentaire
    public function deleteComment(int $commentId) {

        $sql = 'DELETE FROM 
                    `comments`
                WHERE 
                     comment_id = :comment_id';

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':comment_id', $commentId, PDO::PARAM_INT);
        $query->execute();

    }
}