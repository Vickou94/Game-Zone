<h1><i class="fas fa-address-card"></i> <?= $title ?></h1>


        <form class="authform" method="post" action="#">
            <!-- MESSAGES ERROR FORM -->
            <?php if(!empty($tabMessages)) : ?>
                <?php foreach($tabMessages as $message) :  ?>
                    <p class="auth-error"><?= $message[key($message)]?></p>
                <?php endforeach ?>
            <?php endif ?>



            <!-- BODY FORM -->
            <div>
                <input  type="text" id="user-lastname" name="user_lastname" placeholder="Nom">                
            </div>
            <div>
                <input type="text" id="user-name" name="user_firstname" placeholder="Prénom">
                
            </div>
            <div>
                <input  type="text" id="user-email" name="user_email" placeholder="Email">
                
            <div>
                <input type="password" id="password" name="user_password" placeholder="Mot de passe">
            </div>
            <div>
                <input type="password" id="password-confirm" name="password_confirm" placeholder="Confirmez mot de passe">
            </div>
            <div>
                <button type="submit">Créer le compte</button>
            </div>
        </form>   