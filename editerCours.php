<html>
<head>
<meta charset="UTF-8"/>
<link rel="stylesheet"  href="style.css"/>
<title>Modifier Cours</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<style>
        .alert {
      padding: 20px;
      background-color: red;
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
    </style>
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
          <a class="navbar-brand" href="#">Vous pouvez bien modifier le cours à partir de ce formulaire<?php echo ' '.$row['nom'].' '.$row['prenom']; }  ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="GererCours.php">Page précèdente</a>
            </div>
          </div>
        </div>
      </nav>
      <br><br><br>
	<div style="height:240px; margin-top:180px;" id="container">
		<h2>Modifier Cours</h2>
		<p>(Effectuer les modifications!)</p>
    <?php 
     $stm=$pdo->prepare("select id_cours, intitule from cours where id_cours=:userid");
     $idm=$_GET["id"];
     $stm->bindParam(':userid', $idm);
     $stm->execute();
     for($i=0; $row = $stm->fetch(); $i++){?>
		<form action="MCours.php" method="POST">
      <input hidden type="text" id="id_cours" name="id_cours" value="<?php echo $row["id_cours"]; ?>"/>
      <input type="text" id="intitule" name="intitule"  value="<?php echo $row["intitule"]; } ?>"/>
	 <br>
      <button style="margin-top:8px;" id="modifier" name="modifier">Modifier</button></br>
		</form>
	  </div>

    <?php
    //Gerer erreur du formulaire de modif
	if(isset($_SESSION["ErrCours"])){ ?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo($_SESSION["ErrCours"]); ?></strong>
</div>
<?php
    unset($_SESSION["ErrCours"]);
  }
    ?>
</body>
</html>