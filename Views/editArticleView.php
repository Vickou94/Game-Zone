<?php if(isset(($_SESSION['user']['is_user_admin'])) AND ($_SESSION['user']['is_user_admin']) == 2): ?>

<!-- Si user est admin il peut acceder au formulaire pour modifier l'article -->

<h1><i class="fas fa-pencil-alt"></i> <?= $title ?></h1>

<section class="comments-form edit-form">

    <form method="POST" action="#">
            <fieldset>
                <legend>Modifier un article</legend>
                <input type="text" id="article_title" name="article_title" class="input-text" placeholder="Titre de l'article">
                <label for="avatar">Modifier l'image de l'article:</label>
                <input type="file" id="image" name="article_img" accept="image/png, image/jpeg">
                <div>
                    <textarea name="article_content" id="article_content"></textarea>
                </div>
                <div>
                    <button type="submit" name="submit_article">Envoyer</button>
                </div>
                <p class='error_comment'><?php if(isset($erreur)) { echo $erreur;} ?></p>
            </fieldset>
    </form>

</section>

<?php endif ;?> 