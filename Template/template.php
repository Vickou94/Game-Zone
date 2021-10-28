<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resources/img/favicon.ico" />
    <title>Game-Zone</title>
    
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rampart+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <header>
      <div class="banner"></div>
        
        <nav>
            <ul>
                <li><a title="Accueil" href="index.php?page=home">Accueil</a></li>
                <li><a title="Tous les articles" href="index.php?page=allArticles">Tous les articles</a></li>
                <li><a title="Tous les jeux" href="index.php?page=allGames">Tous les jeux</a></li>
                <li><a title="A propos" href="index.php?page=about">A propos</a></li>
                <?php if(array_key_exists('user',$_SESSION) == false): ?>
                <li><a title="Créer un compte" href="index.php?page=register">Créer un compte</a></li>
                <li><a title="Se connecter" href="index.php?page=login">Se connecter</a></li>
                <?php else:?>                
                <li><a title="Se déconnecter" href="index.php?page=logout">Se deconnecter</a></li>
                <?php endif;?>
            </ul>
        </nav>
        
    </header>
    <!-- MESSAGE FLASH  -->
    <div class="flash-msg">
        <?php if(!empty($_SESSION['flash-message'])) : ?>
    
            <?php foreach($_SESSION['flash-message'] as $key => $value) :  ?>
                <div class="alert alert-<?= $key ?>">
                    <?= $value ?>
                </div>
            <?php endforeach ?>

        <?php unset($_SESSION['flash-message']) ; endif; ?>
    </div>
    <main>
        
        <?php require $view ?>
        
    </main>
    
    <footer>
        
            
        <section class="reseaux">
                <h3>Nos autres réseaux :</h3>
                    <a title="Mon profil LinkedIn" href="https://www.linkedin.com/in/victor-no%C3%ABl-440b8521a/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a title="Mon GitHub" href="https://github.com/Vickou94" target="_blank"><i class="fab fa-github"></i></a>
                    <a title="Facebook GameZone" href="#"><i class="fab fa-facebook-square"></i></a>
                    <a title="Instagram GameZone" href="#"><i class="fab fa-instagram-square"></i></a>
        </section>

        <section class="contact">
                <h3>Nous contacter :</h3>

                <p><a title="Contact mail" href="mailto:victor.noel@outlook.fr"><i class="fas fa-envelope"></i> Par mail : victor.noel@outlook.fr</a></p>
                <p><a title="Contact téléphone" href="tel:+33662753163"><i class="fas fa-phone"></i> Par téléphone : +33 6 62 75 31 63</a></p>
        </section>

        <section class="service">
                <h3>Service :</h3>

                <p><i class="fas fa-laptop"></i> Web développement et intégration</p>
        </section> 

    </footer>
    <script src="js/game.js" type="module"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/gamelist.js"></script>
</body>
</html>