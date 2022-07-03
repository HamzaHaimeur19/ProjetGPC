<html>
<head>
<meta charset="UTF-8"/>
<link rel="stylesheet"  href="style.css"/>
<title>Modifier professeur</title>
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
          <a class="navbar-brand" href="#">Vous pouvez bien modifier un professeur à partir de ce formulaire<?php echo ' '.$row['nom'].' '.$row['prenom']; }  ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="GererProfesseurs.php">Page précèdente</a>
            </div>
          </div>
        </div>
      </nav>
      <br><br><br>
	<div style="height:470px; margin-top:90px;" id="container">
		<h2>Modifier Professeur</h2>
		<p>(Effectuer les modifications!)</p>
    <?php 
     $stm=$pdo->prepare("select * from professeur where Id_prof=:userid");
     $idm=$_GET["id"];
     $stm->bindParam(':userid', $idm);
     $stm->execute();
     for($i=0; $row = $stm->fetch(); $i++){?>
		<form action="Mprof.php" method="POST">
      <input hidden  type="text" id="id_prof" name="id_prof" value="<?php echo $row["Id_prof"]; ?>"/>
      <input type="text" id="nom" name="nom"  value="<?php echo $row["nom"]; ?>"/>
	    <input type="text" id="prenom" name="prenom"  value="<?php echo $row["prenom"]; ?>"/>
      <input type="text" id="cin" name="cin" value="<?php echo $row["cin"]; ?>"/>
      <input type="text" id="adresse" name="adresse"  value="<?php echo $row["adresse"]; ?>"/>
      <input type="text" id="telephone" name="telephone"  value="<?php echo $row["telephone"]; ?>"/>
      <input type="email" id="email" name="email"  value="<?php echo $row["email"]; ?>"/>
      <input type="text" id="date_recrutement" name="date_recrutement"  value="<?php echo $row["date_recrutement"]; } ?>"/>
       <select name="id_department">
        <?php

       //requette de selection des informations des departements de la BD
       $stm=$pdo->prepare('select id_department, nom_department from department');
       $stm->execute();
       //execution de la requette de selection des professeurs
      
        ?>
        <option disabled selected value="choisir dept">Choisir Dept</option>
        <?php
          $data = $stm->fetchAll();
          foreach ($data as $row){   ?>
      <option value="<?php echo $row["id_department"];?>"><?php echo $row["nom_department"]; }?></option>
       </select>
        <br>
      <button style="margin-top:8px;" id="modifier" name="modifier">Modifier</button></br>
		</form>
	  </div>

    <?php
    //Gerer erreur du formulaire de modif
	if(isset($_SESSION["MProf"])){ ?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo($_SESSION["MProf"]); ?></strong>
</div>
<?php
    unset($_SESSION["MProf"]);
  }
    ?>
</body>
</html>