<?php

function usuario_autenticado(){
    if(!isset($_SESSION['token'])){
       header('location:login.php');
       exit();
    }
    if(!isset($_COOKIE['token'])){
        header('location:login.php');
        exit();
     }
     if($_SESSION['token'] != $_COOKIE['token']){
        header('location:login.php');
        exit();
     }
}

session_start();
usuario_autenticado();



?>