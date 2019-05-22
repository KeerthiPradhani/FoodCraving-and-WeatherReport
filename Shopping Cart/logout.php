<?php
    include 'inc/session.php';

    // Destroy the session
    destroySession();

    // Redirect to the login page
    header('Location: login.php');    
    exit();
?>