<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style3.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Liste des professeur(s)</title>
    <head>
   <?php
   //Création de session de l'utilisateur
   session_start();
   if (!isset($_SESSION['email'])) {
    header("location:./login.php");
    die();
}
   //Stockage de la session de l'email connecté dans une variable username
   $username = $_SESSION['email'];
   //Connexion à la base de données
   $pdo = new PDO('mysql:host=localhost;dbname=siteprof', 'root', '');
   //requette de selection des informations de l'utilisateur connecté
   $query = $pdo->prepare('SELECT * FROM utilisateur WHERE email = "'.$username.'"');
   //execution de la requette select de l'utilisateur
   $query->execute();
   ?>
  </head>
  <body>
  <nav class="navbar navbar-dark bg-dark" style="background-color:yellow ;">
        <div class="container-fluid">
        <?php
        //recuperation des informations de l'utilisateur à l'aide de la boucle foreach
         foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) { ?>
          <a class="navbar-brand" href="#">Vous pouvez bien consulter les professeurs ayant ce cours<?php echo ' '.$row['nom'].' '.$row['prenom']; }  ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="pagePrincipale.php">Accueil</a>
              <a class="nav-link" href="GererDepartements.php">Gérer les departements</a>
              <a class="nav-link" href="GererCours.php">Gérer les cours</a>
            </div>
          </div>
        </div>
      </nav>
      <br><br><br>
       <form method="GET">
  <table class="table table-dark table-striped" style="height: 90px;">
  <thead>
    <tr>
      <th scope="col">Id professeur</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Cin</th>
      <th scope="col">Adresse</th>
      <th scope="col">Telephone</th>
      <th scope="col">Email</th>
      <th scope="col">Date de recrutement</th>
      <th scope="col">Cours</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     $stm=$pdo->prepare("select p.Id_prof, p.nom, p.prenom, p.cin, p.adresse, p.telephone, p.email, p.date_recrutement, c.intitule from cours c, professeur p, prof_c pc  where pc.id_cours=c.id_cours and p.Id_prof=pc.id_prof and c.id_cours=:userid");
     $idm=$_GET["id"];
     $stm->bindParam(':userid', $idm);
     $stm->execute();
     for($i=0; $row = $stm->fetch(); $i++){?>
      <tr>
      <td><?php echo $row["Id_prof"];?></td>
      <td><?php echo $row["nom"];?></td>
      <td><?php echo $row["prenom"];?></td>
      <td><?php echo $row["cin"];?></td>
      <td><?php echo $row["adresse"];?></td>
      <td><?php echo $row["telephone"];?></td>
      <td><?php echo $row["email"];?></td>
      <td><?php echo $row["date_recrutement"];?></td>
      <td><?php echo $row["intitule"];?></td>
    </tr> 
    <?php } ?> v
  </tbody>
</table>
  </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>