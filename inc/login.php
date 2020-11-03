<?php 
    $path = $_SERVER['SCRIPT_NAME'];
    if($path === '/ListerProject/index.php'){
        $actionPath = 'inc/login_post.php';
    }
    else{
        $actionPath = 'login_post.php';
    }

?>
<h2>Connectez vous</h2>
<form method="POST" action='<?php echo $actionPath; ?>'>
    <label for="pseudo" hidden>Pseudo ou login</label>
    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
    <br>
    <label for="password" hidden>Password</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe">
    <br>
    <label for="autoLogin" >Connexion automatique
    <input type="checkbox" name="autoLogin" id="autoLogin"></label>
    <br>
    <input type="submit" value="Validation">
</form>