<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:./login.php");
    die();
}
if(isset($_POST["Ajouter"])){
    $pdo=NEW PDO('mysql:host=localhost;dbname=siteprof', 'root', '');
    //declaration des variables
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $cin=$_POST["cin"];
    $adresse=$_POST["adresse"];
    $telephone=$_POST["telephone"];
    $email=$_POST["email"];
    $date_recrutement=$_POST["date_recrutement"];
    $id_department=$_POST["id_department"];

    //preparation de la requette
    $stm=$pdo->prepare("insert into professeur(nom, prenom, cin, adresse, telephone, email, date_recrutement, id_department)values(?,?,?,?,?,?,?,?)"); 
    $stm->execute(array($nom, $prenom, $cin, $adresse, $telephone, $email, $date_recrutement,$id_department));
    $_SESSION["AjoutProf"]="Professeur ajouté avec succés!";
    header("location:GererProfesseurs.php"); 
}else{
    $_SESSION["ErrProf"]="Erreur est survenue!";
}
?>

