<?php

if( !empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['password']) ){

    require_once '../admin/bdd.php'; //on se connecte a la base de données
    require_once 'function.php'; // on appel le fichier des fonctions pour pouvoir les utiliser
    require_once '../admin/config.php'; 

    $listErrors = array(); //tableau qui va lister les erreurs

    $sql = 'SELECT * FROM users WHERE (pseudo  = :username or email = :username)';
    $req = $bdd->prepare($sql); // requète préparé
    $req->execute(['username'=>$_POST['pseudo']]);
    $user = $req->fetch(); // on recupère le premier utilisateur trouvé
    // on verifie le password tapé et celui dans la base de donnée
    if(password_verify($_POST['password'], $user['pass'])) 
    {
        
        // si le mot de passe est bon on connecte
        // on verifie le level utilisateur
        if($user['level'] != $adminLevel){
            header('Location: user/account.php');
            exit();
        }
        else{
            header('Location: ../admin/controleCenter.php');
            exit();
        }
        }else{
            $listErrors['connexion']= 'Mauvais identifiant ou mot de passe';
    }
}

?>
        <?php require 'header.php'; ?>
        <div class="main-block">
            <main class="central-block container">
                <div class="central_left">
                    <?php  if(!empty($listErrors)): ?>
                    <div class="alerte-message">
                        <p>Vous n'avez pas rempli le formulaire correctement</p>
                            <ul>
                                <?php foreach($listErrors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                    </div>
                    <?php endif; ?>
                </div> <!--END div class 'central_left'-->
                <div class="central_right ">
                    <div id="block-register" class="form-sign-in div-form">
                        <?php require 'register.php'; ?> 
                    </div>
                    <div id="block-login" class="form-log-in div-form">
                        <?php require 'login.php'; ?>
                    </div>
                </div> <!--END div class 'central_right'-->
            </main>
        </div><!--END div main-block -->

        
        <?php require 'footer.php'; ?>
        <script src="../scripts/switch.js"></script>
        <script src="../scripts/tab.js"></script>
    </body>
</html>