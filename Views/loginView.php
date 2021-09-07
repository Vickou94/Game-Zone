<h1><i class="fas fa-sign-in-alt"></i> <?= $title ?></h1>

<form action="#" method="post">
<!-- MESSAGES ERROR FORM -->
<?php if(!empty($tabMessages)) : ?>
    <div>
        <?php foreach($tabMessages as $message) :  ?>
            <p class="auth-error"><?= $message[key($message)]?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
    <div>
        <input type="text" name="user_email" placeholder="Email">
    </div>
    <div>
        <input type="password" name="user_password" placeholder="Mot de passe">
    </div>
    <div>
        <button type="submit" value="submit">Se connecter</button>
    </div>
</form>