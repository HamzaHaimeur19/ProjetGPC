<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:./login.php");
    die();
}
//connexion à la BD
$pdo=new PDO('mysql:host=localhost;dbname=siteprof', 'root', '');
//recuperation de l'id à partir du formulaire
$id=$_GET["id"];

$stm=$pdo->prepare("delete from professeur where Id_prof=:memid");
$stm->bindParam(':memid', $id);
$stm->execute();
$_SESSION["SuppProf"]="Professeur supprimé avec succés!";
header("location:GererProfesseurs.php");
?>