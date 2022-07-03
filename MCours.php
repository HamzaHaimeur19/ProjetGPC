<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:./login.php");
    die();
}
if(isset($_POST["modifier"])){
//connexion avec la BD
$pdo=new PDO('mysql:host=localhost;dbname=siteprof',"root","");

//recuperation des variables


$intitule=$_POST["intitule"];

//preparation de la requette
$stm=$pdo->prepare("update cours set intitule=? where id_cours=? ");

//execution de requette
$stm->execute(array($intitule,$_POST["id_cours"]));

//header("location:GererProfesseurs.php");
$_SESSION["ModifCours"]="Cours modifié avec succés!";
header("location:GererCours.php");

}else{
    $_SESSION["ErrCours"]="Il y'a une erreur!";
    header("location:editerCours.php");

}
?>