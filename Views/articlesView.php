<h1><i class="fas fa-list"></i> <?= $title ?></h1>

<!-- Affichage du formulaire d'ajout d'article si user est admin uniquement -->

<?php if(isset(($_SESSION['user']['is_user_admin'])) AND ($_SESSION['user']['is_user_admin']) == 2): ?>
<article class="article-form">

    <form method="POST" action="#">
        <fieldset>
            <legend>Ajouter un article</legend>
                <input type="text" id="title" name="title" class="input-text" placeholder="Tire de l'article">
                <label for="avatar">Image de l'article:</label>
                <input type="file" id="image" name="article_img" accept="image/png, image/jpeg">
            <div>
                <textarea name="article_content" id="article_content" placeholder="Texte de l'article..."></textarea>
            </div>
            <div>
                <button type="submit" name="submit_article">Envoyer</button>
            </div>
                <p class='error_comment'><?php if(isset($erreur)) { echo $erreur;} ?></p>
        </fieldset>
    </form>
</article>
<?php endif ;?> 

<div class="article-back">

    <!-- Affichage des articles -->

<?php foreach($articles as $article) : ?>

    <article class="Allarticles">
        <h3><?= htmlspecialchars($article['article_title']) ?></h3>

        <p><?= htmlspecialchars(substr($article['article_content'],0,200)) ?>[...]</p>

        <a title="Lire la suite" href="index.php?page=oneArticle&articleId=<?= intval($article['article_id']) ?>">Lire la suite...</a>

        <!-- Seul l'admin ou l'user qui a posté peut modifier ou supprimer un commentaire -->

        <?php if(isset(($_SESSION['user']['is_user_admin'])) AND ($_SESSION['user']['is_user_admin']) == 2): ?>

        <a title="Supprimer" href="index.php?page=deleteArt&articleId=<?= intval($article['article_id']); ?>">Supprimer</a>

        <a title="Modifier" href="index.php?page=editArt&articleId=<?= intval($article['article_id']); ?>">Modifier</a>

        <?php endif ;?> 
    </article>

<?php endforeach ;?>

</div>

