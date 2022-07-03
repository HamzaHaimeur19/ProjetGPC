<!doctype html>
<html lang="en">
  <head>
    <?php
   session_start();
   if (!isset($_SESSION['email'])) {
    header("location:./login.php");
    die();
}
   $username = $_SESSION['email'];
   $pdo = new PDO('mysql:host=localhost;dbname=siteprof', 'root', '');
   $query = $pdo->prepare('SELECT * FROM utilisateur WHERE email = "'.$username.'"');
   $query->execute();
   ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style3.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    </style>

    <title>Accueil</title>
  </head>
  <body>
  <?php
	if(isset($_SESSION["status"])){ ?>
<div class="alert3">
  <span class="closebtn2" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo($_SESSION["status"]); ?></strong>
</div>
<?php
    //refresh après 1.5 secondes
    header("Refresh:1.5; url=pagePrincipale.php");
    unset($_SESSION["status"]);
  }
    ?>

<?php
    //Gerer si aucun prof n'a été trouvé
	if(isset($_SESSION["erreur"])){ ?>
<div class="alert2">
  <span class="closebtn2" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo $_SESSION["erreur"]; ?></strong>
</div>
<?php
header("Refresh:1.5; url=pagePrincipale.php");
unset($_SESSION["erreur"]);
  }
    ?>
    <nav class="navbar navbar-dark bg-dark" style="background-color:yellow ;">
        <div class="container-fluid">
        <?php foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) { ?>
          <a class="navbar-brand" href="#">Bienvenue à la page d'accueil<?php echo ' '.$row['nom'].' '.$row['prenom'].' '.'votre Id est:' .' '.$row['id_utilisateur'] ; }  ?></a>
         
          <form method="post" action="rechercheProfesseur.php" class="d-flex">
        <input width="500" name="rech" class="form-control me-2" id="selector" type="search" placeholder="Nom professeur" aria-label="Search">
        <script>
        </script>
        <button name="search" class="btn btn-outline-success" type="submit">Rechercher</button>
      </form>


          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="GererProfesseurs.php">Gérer les professeurs</a>
              <a class="nav-link" href="GererDepartements.php">Gérer les departements</a>
              <a class="nav-link" href="GererCours.php">Gérer les cours</a>
              <a class="nav-link" href="Logout.php">Se deconnecter</a>
            </div>
          </div>
        </div>
      </nav>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>

</html>