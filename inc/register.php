<h2>Inscrivez-vous</h2>
<form method="POST" action="inc/register_post.php">
    <label for="firstname" hidden>Prénom</label>
    <input type="text" name="firstname" id="firstname" placeholder="Prénom" >
    <br>
    <label for="name" hidden>Nom</label>
    <input type="text" name="name" id="name" placeholder="Nom">
    <br>
    <label for="email" hidden>Email</label>
    <input type="text" name="email" id="email" placeholder="Email">
    <br>
    <label for="password" hidden>Password</label>
    <input type="text" name="password" id="password" placeholder="Mot de passe">
    <br>
    <label for="cgu" hidden>Condition d'utilisation</label>
    <input type="checkbox" name="cgu" id="cgu">
    <span>Accepter les conditions d'utilisation</span>
    <br>
    <input type="submit" value="Validation">
</form>