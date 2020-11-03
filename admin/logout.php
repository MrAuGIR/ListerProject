<?php
    session_start();
    unset($_SESSION['auth']); // on supprime les infos de session utilisateur
    
    header('Location: ../index.php');

