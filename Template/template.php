<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Game-Zone</title>
    
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rampart+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
</head>
<body>
    
    <header>
      <div class="banner">
      </div>
        
        <nav>
            <ul>
                <li><a href="index.php?page=home">Accueil</a></li>
                <li><a href="index.php?page=allGames">Tous les jeux</a></li>
                <li><a href="index.php?page=about">A propos</a></li>
                <?php if(array_key_exists('user',$_SESSION) == false): ?>
                <li><a href="index.php?page=register">Créer un compte</a></li>
                <li><a href="index.php?page=login">Se connecter</a></li>
                <?php else:?>
                <li><a href="index.php?page=logout">Se deconnecter</a></li>
                <?php endif;?>
            </ul>
        </nav>
        
    </header>
    
    <main>
        
        <?php require $view ?>
        
    </main>
    
    <footer>
        
            <div>
                <h3>Nos autres réseaux :</h3>
                    <a href="https://www.linkedin.com/in/victor-no%C3%ABl-440b8521a/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/Vickou94" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-instagram-square"></i></a>
            </div>

            <div>
                <h3>Nous contacter :</h3>

                <p><a href="mailto:victor.noel@outlook.fr"><i class="fas fa-envelope"></i> Par mail : victor.noel@outlook.fr</a></p>
                <p><a href="tel:+33662753163"><i class="fas fa-phone"></i> Par téléphone : +33 6 62 75 31 63</a></p>
            </div>

            <div>
                <h3>Service :</h3>

                <p><i class="fas fa-laptop"></i> Web développement et intégration</p>
            <div>
        
    </footer>
    
    <script src="js/game.js"></script>
</body>
</html>