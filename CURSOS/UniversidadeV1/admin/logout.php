<?php
    session_start();
    //session_destroy($_SESSION['login']);
    session_destroy(); 
    header('Location: login_admin.html');
?>