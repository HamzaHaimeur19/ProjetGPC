
<?php
 session_start();

 if (isset($_POST['btnConnecter'])) {
     $connect = new PDO("mysql:host=localhost; dbname=siteprof", "root", "");  

     $username = $_POST['email'];
     $password = $_POST['mdp'];
 
     $q = $connect->prepare('SELECT * FROM utilisateur WHERE email = ?');
     $q->execute(array($username));
 
     if ($q->rowCount() > 0){
 
         error_log((string) ($q->rowCount()));
 
         $result = $q -> fetch(PDO::FETCH_ASSOC);
         $hash_pwd = $result['mdp'];
         $hash = password_verify($password, $hash_pwd);

  
 
         error_log($hash_pwd);
         error_log($hash);
         error_log((int) $hash);
         
 
         if ($hash == 0) {
          $_SESSION["e"]="Email ou mot de passe erronés!";
          header("location:Login.php");    
         }  
         else {
 
             $_SESSION['email'] = $username;
             $_SESSION["status"]="Connexion avec succés!";
             header("location:pagePrincipale.php");
         } 
     }
 }
 ?>