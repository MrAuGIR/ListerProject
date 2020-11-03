<?php
if(session_status() == PHP_SESSION_NONE) //ON VERIFIE QUE LA SESSION N'EST PAS DEJA DEMARRE
{
    session_start();
}

$user = $_SESSION['auth'];
?>

<?php require '../inc/header_account.php'; ?>
        <div class="main-block">
            <main class="central-block container">
                <h1>Bienvenue dans votre espace personnel <?php echo $_SESSION['auth']['pseudo']; ?> </h1>
                
            </main>
        </div><!--END div main-block -->
        <?php require '../inc/footer.php'; ?>

