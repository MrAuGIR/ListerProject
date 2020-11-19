<?php
/*
if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}
*/

$user = isset($_SESSION['auth'])? $_SESSION['auth']:null;
$user_name = isset($_SESSION['auth']['name'])? $_SESSION['auth']['name']:'';

//tableau listant les erreurs
$errors=array();
//definition des variables
$name='';
$firstname='';
$email='';

if(!empty($_POST)){ //formulaire soumit

    require_once '../admin/utility/bdd.php'; //on se connecte a la base de données
    require_once 'function.php'; // on appel le fichier des fonctions pour pouvoir les utiliser

    if(!isset($_POST['cgu'])){
        $errors['cgu']= 'Les CGU ne sont pas accepter.';
    }else{

        //on verifie le prénom
        if(!isset($_POST['firstname']) || empty($_POST['firstname']) || strlen($_POST['firstname'])<1){
            $errors['fistname']= "Veuillez renseigner un prénom valide ";
        }else{
            $firstname = $_POST['firstname'];
            $firstnameVerify = verify_input_form($firstname);
        }

        // on verifie le nom
        if(!isset($_POST['name']) || empty($_POST['name']) || strlen($_POST['name'])<1 ){
            $errors['name']= "Veuillez renseigner un nom valide";
        }else{
            $name = $_POST['name'];
            $nameVerify = verify_input_form($name);
        }

        // on verifie l'email
        if(!isset($_POST['email']) || empty($_POST['email'])){
            $errors['email']= "Veuillez renseigner un email valide";
        }elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $errors['email']= "Format email invalide";
        }else{
            $email = verify_input_form($_POST['email'],'email');
            // on verifie que l'email n'est pas deja utilise
            $sql = "SELECT email FROM users WHERE email = :email";
            $reponse = $bdd->prepare($sql);
            $reponse->bindValue('email',$email,PDO::PARAM_STR);
            $reponse->execute();
            $user= $reponse->fetch();
            if($user){
                $errors['email'] = 'Email déjà utilisé';
            }
        }

        // on verifie le password
        if(!isset($_POST['password']) || empty($_POST['password'])){
            $errors['password']="Veuillez renseigner un mot de passe";
        }elseif(strlen($_POST['password'])<6){
            $errors['password']="Mot de passe incorrect (min 6 carac. alphanum)";
        }else{

            $password_hash = password_hash($_POST['password'],PASSWORD_BCRYPT);
        }

        //si pas d'erreur
        if(empty($errors)){

            $sql = "INSERT INTO users (firstname, name, email, pass) VALUES (:firstname, :name, :email, :pass)";
            $req = $bdd->prepare($sql);
            $req->bindValue('firstname', $firstnameVerify, PDO::PARAM_STR);
            $req->bindValue('name', $nameVerify, PDO::PARAM_STR);
            $req->bindValue('email', $email, PDO::PARAM_STR);
            $req->bindValue('pass', $password_hash, PDO::PARAM_STR);
            $req->execute();

            // on recupére le dernier id inseré
            $user_id = $bdd->lastInsertId(); //renvoie le dernier id généré par pdo

            $sql = 'SELECT * FROM users WHERE id = :id';
            $reponse = $bdd->prepare($sql);
            $reponse->bindValue('id',$user_id,PDO::PARAM_INT);
            $reponse->execute();
            $user=$reponse->fetch();
            session_start(); //je demarre la session une fois que l'utilisateur est validé
            $_SESSION['auth'] = $user;

            header('location: ../user/account.php');

        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
    <body>
        <?php require 'header.php'; ?>
            <div class="main-block">
                <main class="central-block container">
                    <div class="central_left">
                        <?php  if(!empty($errors)): ?>
                        <div class="alerte-message">
                            <p>Vous n'avez pas rempli le formulaire correctement</p>
                            <ul>
                                <?php foreach($errors as $error): ?>
                                    <li><?= $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div> <!--END div class 'central_left'-->
                    <div class="central_right">
                        <div  class="form-sign-in">
                            <h2>Inscrivez-vous</h2>
                            <?php if(!empty($errors)) : ?>
                                <div class="alerte">
                                    <p>Erreur de saisie </p>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="register_post.php">             
                                <label for="firstname" hidden>Prénom</label>
                                <input type="text" name="firstname" id="firstname" placeholder="Prénom" >
                                <?php if(array_key_exists('firstname',$errors)): ?>
                                    <span><?= $errors['fistname'] ?></span>
                                <?php endif; ?>
                                <br>
                                <label for="name" hidden>Nom</label>
                                <input type="text" name="name" id="name" placeholder="Nom">
                                <?php if(array_key_exists('name',$errors)): ?>
                                    <span><?= $errors['name'] ?></span>
                                <?php endif; ?>
                                <br>
                                <label for="email" hidden>Email</label>
                                <input type="text" name="email" id="email" placeholder="Email">
                                <?php if(array_key_exists('email',$errors)): ?>
                                    <span><?= $errors['email'] ?></span>
                                <?php endif; ?>
                                <br>
                                <label for="password" hidden>Password</label>
                                <input type="text" name="password" id="password" placeholder="Mot de passe">
                                <?php if(array_key_exists('password',$errors)): ?>
                                    <span><?= $errors['password'] ?></span>
                                <?php endif; ?>
                                <br>
                                <label for="cgu" hidden>Condition d'utilisation</label>
                                <input type="checkbox" name="cgu" id="cgu">
                                <span>Accepter les conditions d'utilisation</span>
                                <?php if(array_key_exists('cgu',$errors)): ?>
                                    <span><?= $errors['cgu'] ?></span>
                                <?php endif; ?>
                                <br>
                                <input type="submit" value="Validation">
                            </form> 
                        </div>   
                    </div>
                </main>
            </div><!--END div main-block -->
        <?php require 'footer.php'; ?>
        <script src="../scripts/switch.js"></script>
        <script src="../scripts/tab.js"></script>
    </body>
</html>