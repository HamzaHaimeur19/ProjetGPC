<?php
if(isset($_POST["auth"])){
    $pdo=new PDO("mysql:host=localhost;dbname=siteprof","root","");
    $stm=$pdo->prepare("insert into utilisateur(NOM,PRENOM,EMAIL,DATE_NAISSANCE,MDP)
                       values(:nom,:prenom,:email,:date_naissance,:mdp)");
    $stm->execute([":nom"=>$_POST["nom"],
        ":prenom"=>$_POST["prenom"],
        ":email"=>$_POST["email"],
        ":date_naissance"=>$_POST["date_naissance"],
        ":mdp"=>password_hash($_POST["mdp"],PASSWORD_DEFAULT)]);

  header("location:Login.php");
}
?>