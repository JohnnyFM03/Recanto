<?php

session_start();

if(isset($_SESSION['recanto_userid'])){
    $_SESSION['recanto_userid'] = NULL;
    unset($_SESSION['recanto_userid']);
}

header("Location: ../regis_login/login.html");

die;