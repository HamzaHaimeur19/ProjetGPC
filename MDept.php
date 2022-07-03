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

$id=$_POST["id_dept"];
$nom=$_POST["nom"];

//preparation de la requette
$stm=$pdo->prepare("update department set nom_department=? where id_department=?");

//execution de requette
$stm->execute(array($nom, $id));

$_SESSION["ModifDept"]="Departement modifié avec succés!";
header("location:GererDepartements.php");
}else{
    header("location:editerD.php");

}
?>
