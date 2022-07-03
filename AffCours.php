<?php
session_start();
   //Création de session de l'utilisateur
   if (!isset($_SESSION['email'])) {
    header("location:./login.php");
    die();
}
if(isset($_POST["Ajouter"])){
    $pdo=NEW PDO('mysql:host=localhost;dbname=siteprof', 'root', '');
    //declaration des variables
    $id_prof=$_POST["id_prof"];
    $id_cours=$_POST["id_cours"];
    
    //preparation de la requette
   
    $stm=$pdo->prepare("insert into prof_c(id_prof, id_cours)values(?,?)");
    $stm->execute(array($id_prof,$id_cours));
    $_SESSION["AffecterC"]="Cours affecté avec succés!";
    header("location:GererCours.php"); 
}else{
    $_SESSION["ErrAff"]="Erreur est survenue!";
    header("location:AffecterCours.php"); 
}


?>
