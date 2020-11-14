<?php

if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
     session_start();
}


if( !empty($_POST) && !empty($_POST['email']) && !empty($_POST['password']) ){

    require_once '../admin/utility/bdd.php'; //on se connecte a la base de données
    require_once 'function.php'; // on appel le fichier des fonctions pour pouvoir les utiliser
    //require_once '../admin/config.php'; 

    $listErrors = array(); //tableau qui va lister les erreurs

    $sql = 'SELECT * FROM users WHERE (email = :email)';
    $req = $bdd->prepare($sql); // requète préparé
    $req->execute(['email'=>$_POST['email']]);
    $user = $req->fetch(); // on recupère le premier utilisateur trouvé
    // on verifie le password tapé et celui dans la base de donnée
    if(password_verify($_POST['password'], $user['pass'])) 
    {
        $_SESSION['auth'] = $user; // on crée la session utilisateur
        // si le mot de passe est bon on connecte
        // on verifie le level utilisateur
        if($user['level'] != ADMIN_LEVEL){
            header('Location: ../user/account.php');
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
                    <div  class="form-log-in ">
                        <h2>Connectez vous</h2>
                        <form method="POST" action="">
                            <label for="email" hidden>Email</label>
                            <input type="text" name="email" id="email" placeholder="Votre email" required>
                            <br>
                            <label for="password" hidden>Password</label>
                            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                            <br>
                            <label for="autoLogin" >Connexion automatique
                            <input type="checkbox" name="autoLogin" id="autoLogin"></label>
                            <br>
                            <input type="submit" value="Validation">
                        </form>
                    </div>
                </div> <!--END div class 'central_right'-->
            </main>
        </div><!--END div main-block -->

        
        <?php require 'footer.php'; ?>
        <script src="../scripts/switch.js"></script>
        <script src="../scripts/tab.js"></script>
    </body>
</html>