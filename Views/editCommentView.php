<?php if(($_SESSION['user']['user_id'] == $comment['comment_user_id']) || ($_SESSION['user']['is_user_admin'] == 2)): ?>

<!-- Seul l'user qui a laissé le commentaire ou l'admin peuvent modifier -->

<h1><i class="fas fa-pencil-alt"></i> <?= $title ?></h1>

<section class="comments-form edit-form">

    <form method="POST" action="#">
            <fieldset>
                <legend>Modifier un commentaire</legend>
                <div>
                    <textarea name="content" id="content"></textarea>
                </div>
                <div>
                    <button type="submit" name="submit_comment">Envoyer</button>
                </div>
                <p class='error_comment'><?php if(isset($erreur)) { echo $erreur;} ?></p>
            </fieldset>
    </form>

</section>

<?php endif ;?> 

