<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
unset($_SESSION["id"]);
unset($_SESSION["nome"]);
unset($_SESSION["email"]);
header("Location: ../index.php");
?>