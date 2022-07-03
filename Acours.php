<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:./login.php");
    die();
}
if(isset($_POST["Ajouter"])){
    $pdo=NEW PDO('mysql:host=localhost;dbname=siteprof', 'root', '');
    //declaration des variables
    $intitule=$_POST["intitule"];

    //preparation de la requette
    $stm=$pdo->prepare("insert into cours(intitule)values(?)"); 
    $stm->execute(array($intitule));
    $_SESSION["AjoutC"]="Cours ajouté avec succés!";
    header("location:GererCours.php"); 
}else{
    $_SESSION["ErrA"]="Erreur est survenue!";
    header("location:AjouterCours.php"); 
}

?>
