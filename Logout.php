<?php
//commencer la session
session_start(); 

session_unset();

//détruire la session
session_destroy(); 


//retourner à la page login
header("location:Login.php");

//quitter
exit();
?>