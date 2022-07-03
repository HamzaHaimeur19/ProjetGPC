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

$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$cin=$_POST["cin"];
$adresse=$_POST["adresse"];
$telephone=$_POST["telephone"];
$email=$_POST["email"];
$date_recrutement=$_POST["date_recrutement"];
$id_department=$_POST["id_department"];

//preparation de la requette
$stm=$pdo->prepare("update professeur set nom=?, prenom=?, cin=?, adresse=?, telephone=?, email=?, date_recrutement=?, id_department=? where Id_prof=? ");

//execution de requette
$stm->execute(array($nom, $prenom, $cin, $adresse, $telephone, $email, $date_recrutement, $id_department, $_POST["id_prof"]));

//header("location:GererProfesseurs.php");
$_SESSION["ModifProf"]="Professeur modifié avec succés!";
header("location:GererProfesseurs.php");

}else{
    $_SESSION["MProf"]="Il y'a une erreur!";
    header("location:editer.php");

}
?>
