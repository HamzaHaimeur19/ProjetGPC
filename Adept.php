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
    $nom=$_POST["nom"];

    //preparation de la requette
    $stm=$pdo->prepare("insert into department(nom_department)values(?)");
    $stm->execute(array($nom));
    $_SESSION["AjoutDept"]="Departement ajouté avec succés!";
    header("location:GererDepartements.php");
}else{
    $_SESSION["ErrDept"]="Departement ajouté avec succés!";
    header("location:AjouterDept.php");
}

?>

<?php
