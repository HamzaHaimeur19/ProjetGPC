<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style3.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Gerer des cours</title>
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

<style>
      /*Ajouter Alert*/
        .alert {
      padding: 20px;
      background-color: green;
      color: white;
    }
    
    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn:hover {
      color: black;
    }

/*Supprimer alert*/
    .alert2 {
      padding: 20px;
      background-color: red;
      color: white;
    }
    
    .closebtn2 {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn2:hover {
      color: black;
    }

    /*Ajouter Alert*/
    .alert3 {
      padding: 20px;
      background-color: green;
      color: white;
    }
    
    .closebtn3 {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn3:hover {
      color: black;
    }
    </style>
  </head>
  <body>

  <?php
    //Gerer notification du formulaire d'ajout
	if(isset($_SESSION["AjoutC"])){ ?>
<div class="alert3">
  <span class="closebtn3" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo $_SESSION["AjoutC"]; ?></strong>
</div>
<?php
    header("Refresh:1.5; url=GererCours.php");
    unset($_SESSION["AjoutC"]);
  }
    ?>


<?php
//Gerer notification du formulaire d'aaffectation
if(isset($_SESSION["AffecterC"])){ ?>
<div class="alert3">
<span class="closebtn3" onclick="this.parentElement.style.display='none';">&times;</span> 
<strong><?php echo $_SESSION["AffecterC"]; ?></strong>
</div>
<?php
header("Refresh:1.5; url=GererCours.php");
unset($_SESSION["AffecterC"]);
}
?>

<?php
    //Gerer notification du formulaire de modification
	if(isset($_SESSION["ModifCours"])){ ?>
<div class="alert3">
  <span class="closebtn3" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo $_SESSION["ModifCours"]; ?></strong>
</div>
<?php
header("Refresh:1.5; url=GererCours.php");
unset($_SESSION["ModifCours"]);
  }
    ?>

<?php
//Gerer notification du formulaire de suppression
	if(isset($_SESSION["SuppC"])){ ?>
<div class="alert2">
  <span class="closebtn2" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo $_SESSION["SuppC"]; ?></strong>
</div>
<?php
    header("Refresh:1.5; url=GererCours.php");
    unset($_SESSION["SuppC"]);
  }
    ?>

  <nav class="navbar navbar-dark bg-dark" style="background-color:yellow ;">
        <div class="container-fluid">
        <?php
        //recuperation des informations de l'utilisateur à l'aide de la boucle foreach
         foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) { ?>
          <a class="navbar-brand" href="#">Vous pouvez bien gérer les cours à partir de ce tableau<?php echo ' '.$row['nom'].' '.$row['prenom']; }  ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="pagePrincipale.php">Accueil</a>
              <a class="nav-link" href="GererDepartements.php">Gérer les departements</a>
              <a class="nav-link" href="GererProfesseurs.php">Gérer les professeurs</a>
            </div>
          </div>
        </div>
      </nav>
      <?php
       //requette de selection des informations des professeurs de la BD
       $stm=$pdo->prepare('select id_cours, intitule from cours');
       //execution de la requette de selection des professeurs
       $stm->execute();
       ?>
       <form method="GET">
  <table class="table table-dark table-striped" style="height: 90px;">
  <thead>
    <tr>
      <th style="text-align:center;" scope="col">Id cours</th>
      <th scope="col">Intitulé</th>
      <th scope="col">Afficher professeurs</th>
      <th scope="col">Modification</th>
      <th scope="col">Suppression</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  //Parcourir les valeurs de la table professeur
  foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $r) {  ?>
      <tr>
      <td style="text-align:center;"><?php echo $r["id_cours"];?></td>
      <td><?php echo $r["intitule"];?></td>
      <td><button type="button" class="btn btn-info"><a style="text-decoration:none; color:white;" <?php echo" href=\"affCP.php?id=".$r['id_cours']."\">Afficher</a></button></td>;"?>
      <td><button type="button" class="btn btn-success"><a style="text-decoration:none; color:white;" <?php echo" href=\"editerCours.php?id=".$r['id_cours']."\">Editer</a></button></td>;"?>
      <td><button type="button" class="btn btn-danger"><a style="text-decoration:none; color:white;" <?php echo" href=\"suppC.php?id=".$r['id_cours']."\">Supprimer</a></button></td>;"?>
    </tr> 
    <?php } ?>
  </tbody>
</table>
  </form>
<button type="button"  class="btn btn-dark" style=" margin-left: 300px;"><a style="text-decoration:none; color:white;" href="AjouterCours.php">Ajouter Cours</a></button>
<button type="button"  class="btn btn-dark" style=" margin-left: 300px;"><a style="text-decoration:none; color:white;" href="AffecterCours.php">Affecter Cours à un professeur</a></button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>

</html>