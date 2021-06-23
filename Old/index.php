<?php
if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}
$user_name= isset($_SESSION['auth']['name'])? $_SESSION['auth']['name']:'';
?>
<!-- insertion du header -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="shopping list management website">
    <meta name="author" content="aurélien Girard">
    <link rel="icon" type="image/png" href="img/icon/favicon.png" >
    <link rel="stylesheet" type="text/css" href="styles/indexStyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>LISTER - Page d'accueil</title>
</head>
    <body>
        <header>
            <div class="block-header container">
                <div class="logo-block">
                    <div class="logo-Lister">
                        <a class="link-without-style" href="index.php" title="vers page d'accueil"><img src="img/icon/logoList_medium.png" alt="logo lister"></a>
                    </div>
                    <div class="name-lister">
                        <h1>Lister</h1>
                    </div>
                </div>
                <div id="central_header_block" class="central_header">
                </div><!--END div logo-block-->
                <div class="nav-block align-right-block" >
                    <nav class="nav-header">
                        <ul><!--
                            <li><a class="link-without-style" href="inc/register.php" title="affichage popup de connexion">Connexion</a></li>
                            <li><a class="link-without-style" href="inc/login.php" title="affichage popup d'inscription">Inscription</a></li>-->
                            <?php if($user_name ===''): ?>
                                <li><button class="tabNav" onclick="tabElement('block-register',this,'#FFFFFF','div-form')">Inscription</button></li>
                                <li><button class="tabNav" onclick="tabElement('block-login',this,'#FFFFFF','div-form')">Connexion</button></li>
                            <?php else : ?>
                                <li><a class="tabNav" href="user/account.php?name=<?= $user_name ?>" title="compte personnel"><i class="far fa-user-circle"></i><?= $user_name; ?></a></li>
                                <li><a class="tabNav" href="user/logout.php" title="deconnexion"><i class="fas fa-user-times"> Deconnexion</i></a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div><!--END div nav-block-->
            </div><!-- END div block_header -->
        </header> <!--header end-->
        <div class="main-block">
            <main class="central-block container">
                <div class="central_left ">
                    <section id="presentation">
                        <h2>Lister</h2>
                        <h3>Organiser vos course</h3>
                        <p>Liste est un outil permettant l'organisation de vos courses et de vos futur achats.</p>
                    </section>
                    <section id="list_illustration">
                        <div id="left_arrow">
                            <button class="arrow" onclick="switchElement('clickLeft')" id="clickLeft" title="illustration précédente"><i class="fas fa-angle-left fa-7x"></i></button>
                        </div>
                        <div id="illustration_default" class="center_illustration">
                            <div class="center_illustration_left">
                                <p>Créer, modifier des listes de courses et sauvegarder les dans votre espace personnel. Partager les ensuite avec vos proches.</p>
                            </div>
                            <div class="center_illustration_right">
                            <img src="img/illustration/Page_principal_xd.png" alt="illustration page principal">
                            </div>
                        </div>
                        <div id="illustration_second" class="center_illustration" >
                            <div class="center_illustration_left">
                                <p>L'outil d'édition vous permet de créer votre liste personnalisé, notamment grace à une bibliothèque de produits près enregistrés</p>
                            </div>
                            <div class="center_illustration_right">
                            <img src="img/illustration/Page_edition_xd.png" alt="illustration page édition">
                            </div>
                        </div>
                        <div id="illustration_third" class="center_illustration" >
                            <div class="center_illustration_left">
                                <p>L'outil de visualisation, vous permet de suivre vos course en direct, et de savoir à tous moment ou vous en êtes et ce qui vous reste à faire.</p>
                            </div>
                            <div class="center_illustration_right">
                            <img src="img/illustration/Page_visualisation_xd.png" alt="illustration page visualisation">
                            </div>
                        </div>
                        <div id="right_arrow">
                        <button class="arrow" onclick="switchElement('clickRight')" id="clickRight" title="illustration suivante"><i class="fas fa-angle-right fa-7x"></i></button>
                        </div>
                    </section><!--END section list_outil-->
                    <div id="bottom_tools">
        
                    </div>
                </div> <!--END div class 'central_left'-->
                <div class="central_right ">
                    <div id="block-register" class="form-sign-in div-form">
                        <?php require 'inc/register.php'; ?> 
                    </div>
                    <div id="block-login" class="form-log-in div-form">
                        <?php require 'inc/login.php'; ?>
                    </div>
                </div> <!--END div class 'central_right'-->
            </main>
        </div><!--END div main-block -->
        <footer>
            <div class="block-footer container">
                <nav class="nav-footer">
                    <ul>
                        <li><a class="link-without-style" href="#" title="vers page contact">Contact</a></li>
                        <li><a class="link-without-style" href="#" title="vers page confidentialité">confidentialité</a></li>
                        <li><a class="link-without-style" href="#" title="vers page mention légal">Mention légal</a></li>
                        <li><a class="link-without-style" href="#" title="vers page aides">Aides</a></li>
                    </ul>
                </nav>
                <div class="block-rs">
                    <ul class="horizontal-list"><h4>Où nous suivre :</h4>
                        <li><a href="http://www.facebook.fr" title="vers page facebook lister" target="_blank"><img src="img/icon/logo_facebook_32x32.png" alt="logo facebook"/a></li>
                        <li><a href="http://www.twitter.fr" title="vers page twitter lister" target="_blank"><img src="img/icon/logo_twitter_32x32.png" alt="logo twitter"></a></li>
                        <li><a href="https://github.com/MrAuGIR/ListerProject" title="vers page github lister" target="_blank"><img src="img/icon/logo_github_32x32.png" alt="logo github"></a></li>
                    </ul>
                </div>
            </div><!--END main div block footer-->
        </footer>
        <script src="scripts/switch.js"></script>
        <script src="scripts/tab.js"></script>
    </body>
</html>