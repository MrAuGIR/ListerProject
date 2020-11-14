<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}
$user_name= isset($_SESSION['auth']['pseudo'])? $_SESSION['auth']['pseudo']:'';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="shopping list management website">
    <meta name="keywords" content="list, liste, shopping, courses, management, gestion">
    <meta name="author" content="aurélien Girard">
    <link rel="icon" type="image/png" href="../img/icon/favicon.png" >
    <link rel="stylesheet" type="text/css" href="../styles/indexStyle.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Connexion</title>
</head>
<body>
    <header>
        <div class="block-header container">
            <div class="logo-block">
                <div class="logo-Lister">
                    <a class="link-without-style" href="../index.php" title="vers page d'accueil"><img src="../img/icon/logoList_medium.png" alt="logo lister"></a>
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
                        <?php if($user_name===''): ?>
                            <li><a href="register_post.php" title="inscription">Inscription</a></li>
                            <li><a href="login_post.php" title="connexion">Connexion</a></li>
                        <?php else : ?>
                            <li><button class="tabNav" href="user/account.php?name=<?= $user_name ?>"><?= $user_name ?></button></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div><!--END div nav-block-->
        </div><!-- END div block_header -->
    </header> <!--header end-->