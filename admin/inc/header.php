<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/ico" href="../img/icon/control-Panel.ico" >
        <link rel="stylesheet" type="text/css" href="../admin/style/admin.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
        <title>Centre de commandement</title>
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
                    <div class="logout">
                        <a href="logout.php" title="deconnexion">Déconnexion</a>
                    </div>
                </div>
                <div class="nav-block" >
                    <nav class="nav-header">
                        <ul><!--
                            <li><a class="link-without-style" href="inc/register.php" title="affichage popup de connexion">Connexion</a></li>
                            <li><a class="link-without-style" href="inc/login.php" title="affichage popup d'inscription">Inscription</a></li>-->
                            <li><button class="tabNav" onclick="tabElement('block-register',this,'#FFFFFF','div-form')">Gestion BDD</button></li>
                            <li><button class="tabNav" onclick="tabElement('block-login',this,'#FFFFFF','div-form')">Gestion page</button></li>
                            <li><button class="tabNav" onclick="tabElement('block-login',this,'#FFFFFF','div-form')">Statistiques</button></li>
                        </ul>
                    </nav>
                </div><!--END div nav-block-->
            </div><!-- END div block_header -->
        </header>