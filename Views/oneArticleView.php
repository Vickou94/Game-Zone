<h1><i class="fas fa-newspaper"></i><?= $title ?></h1>

    <!-- Affichage d'un article en détail -->

<div class="article-back">

    <article class="Allarticles">

        <h3><?= htmlspecialchars($article['article_title']) ?></h3>

        <!-- Je peux récupérer une image pour l'article depuis mon dossier "resources/img/image.jpg" comme pour un input text-->

            <img src="resources/img/<?= htmlspecialchars($article['article_image']) ?>" alt="jeux videos actualité">

            <p><?= htmlspecialchars($article['article_content']) ?></p>
        
            <p><em>Article publié le : <?= htmlspecialchars($article['article_creation_date']) ?> </em></p>

    </article>

    <!-- Si l'user est connecté, il peut accéder à l'espace commentaire -->

    <?php if(array_key_exists('user',$_SESSION) == true): ?>

    <section class="comments-form">

        <h3>Liste des commentaires :</h3>

      
        <?php foreach($comments as $comment): ?>
            
            <article class="Allcomments">

                <h4>De : <?= htmlspecialchars($comment['comment_pseudo']); ?></h4>
                <p>Publié le : <?= htmlspecialchars($comment['comment_created_at']); ?></p>
                <p><?= htmlspecialchars($comment['comment_content']); ?></p>

            <!-- Seul l'user qui a écrit le commentaire ou un admin peut modifier ou supprimer le commentaire -->

            <?php if(($_SESSION['user']['user_id'] == $comment['comment_user_id']) || ($_SESSION['user']['is_user_admin'] == 2)): ?>
                <div class="comment_buttons">
                    <a title="Modifier" href="index.php?page=editCom&commentId=<?= intval($comment['comment_id']); ?>">Modifier</a>
                    <a title="Supprimer" href="index.php?page=deleteCom&commentId=<?= intval($comment['comment_id']); ?>">Supprimer</a>
                </div>
            <?php endif;?>    

            </article>

        <?php endforeach ;?>


        <form method="POST" action="#">
            <fieldset>
                <legend>Ajouter un commentaire</legend>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo">
                <div>
                    <textarea name="content" id="content" placeholder="Votre texte ici..."></textarea>
                </div>
                <div>
                    <button type="submit" name="submit_comment">Envoyer</button>
                </div>
                <p class='error_comment'><?php if(isset($erreur)) { echo $erreur;} ?></p>
            </fieldset>
        </form>
    </section>

    <?php endif;?>

</div>

