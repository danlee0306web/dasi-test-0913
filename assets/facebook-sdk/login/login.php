<?php

    session_start();

    // Script By Qassim Hassan, wp-time.com

    if( isset($_SESSION['success']) ){ // check if user is logged in
        header("location: index.php"); // redirect user to index page
        return false;
    }

    include 'config.php'; // include app info

    $_SESSION['login'] = 1;

    header("location: 'https://www.facebook.com/dialog/oauth?client_id=".$app_id."&redirect_uri=".$redirect_uri."&scope=".$scope."'"); // redirect user to oauth page

?>
