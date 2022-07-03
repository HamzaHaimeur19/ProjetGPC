<html>
<head>
<meta charset="UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Authentification</title>
<?php
session_start();
?>
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
</head>
<body>
	<div style="height:250px; margin-top:150px;" id="container">
		<h2>Authentification</h2>
		<p>(Veuillez se connecter!)</p>
		<form action="traitementLogin.php" method="POST">
    <input type="email" id="email" name="email" placeholder="Entrer votre email" required/>
	  <input type="password" id="mdp" name="mdp" placeholder="Entrer votre mdp" required/>
			<br>
		  <button id="btnConnecter" name="btnConnecter">Se connecter</button><br>
		  <a style="color:white; font-size: 18px;" href="Inscription.html" >Vous n'avez pas encore un compte? créer un</a>
		</form>
	  </div>
  </body>
</html>
<?php
	if(isset($_SESSION["e"])){ ?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?php echo($_SESSION["e"]); ?></strong>
</div>
<?php
header("Refresh:1.5; url=Login.php");
    unset($_SESSION["e"]);
  }
    ?>