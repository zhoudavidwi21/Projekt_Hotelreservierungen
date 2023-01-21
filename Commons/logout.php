<?php
//Muss auf jeder Seite vor der HTML sein
if (!isset($_SESSION)) {
    session_start(); //muss zu beginn von jeder session stehen
}

//Logout Funktion 
$_SESSION = array();
session_unset();
session_destroy();
if (isset($_COOKIE['userId'])) {
    unset($_COOKIE['userId']); 
    setcookie('userId', null, time() - 3600, "/"); 
}
if (isset($_COOKIE['username'])) {
    unset($_COOKIE['username']); 
    setcookie('username', null, time() - 3600, "/"); 
}
if (isset($_COOKIE['loginCookie'])) {
    unset($_COOKIE['loginCookie']); 
    setcookie('loginCookie', null, time() - 3600, "/"); 
}
header('Refresh:0; url=../index.php');
