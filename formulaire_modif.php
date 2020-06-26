<!DOCTYPE html>
    <html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Atelier PHP N°4 - formulaire modification</title>
        <?php   
        require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
        $db = connexionBase(); // Appel de la fonction de connexion
        $pro_id = $_GET["pro_id"];
      $requete = "SELECT * FROM produits WHERE pro_id=".$pro_id;
       $result = $db->query($requete);
       // Renvoi de l'enregistrement sous forme d'un objet
       
       $produit = $result->fetch(PDO::FETCH_OBJ);
      ?>
</head>
<body> 
<div class="container">	
<div class="menu">
  <nav id="navbar" class="navbar navbar-expand-sm bg-dark navbar-dark">
    
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="liste.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Formulaire.html">Mon compte</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Horaires.html">contact </a>
              </li>
          </ul>
      </div> 
  </nav>
</div>
<form action="formulaire_modif_script.php" method="post">
<div class="form-group">
    <label for="pro_ref"> ID</label>
    <?php echo "<input class=\"form-control\" type=\"number\"  name=\"pro_id\" value=$produit->pro_id >";?>
</div>

<div class="form-group">
    <label for="pro_ref"> Référence</label>
    <?php echo "<input class=\"form-control\" type=\"text\"  name=\"pro_ref\" value=$produit->pro_ref >";?>
</div>
<div class="form-group">
    <label for="pro_cat_id"> Catégorie</label>
    <?php	

$requete = "SELECT cat_id , cat_nom 
FROM categories 
ORDER BY cat_nom ";	
$result = $db->query($requete);	
if (!$result) 	
{
    $tableauErreurs = $db->errorInfo();
    echo $tableauErreur[2]; 
    die("Erreur dans la requête");
}
if ($result->rowCount() == 0) 	
{
   // Pas d'enregistrement
   die("La table est vide");
}	
echo "	
<select id=\"pro_cat_id\"  name=\"pro_cat_id\" class=\"custom-select\"  >";
while ($row = $result->fetch(PDO::FETCH_OBJ))	
{
    
    echo" <option value=$row->cat_id >$row->cat_nom</option>";
    
} 
echo " </select>"
?>
</div>

<div class="form-group">
    <label for="pro_libelle"> Libellé</label>
    <?php echo "<input class=\"form-control\" type=\"text\"  name=\"pro_libelle\" value=$produit->pro_libelle >";?>
</div>
<div class="form-group">
    <label for="pro_description"> Description</label>
    <?php echo "<input class=\"form-control\" type=\"text\"  name=\"pro_description\" value=$produit->pro_description >";?>
</div>
<div class="form-group">
    <label for="pro_prix"> Prix</label>
    <?php echo "<input class=\"form-control\" type=\"decimal\"  name=\"pro_prix\" value=$produit->pro_prix >";?>
</div>
<div class="form-group">
    <label for="pro_stock"> Stock</label>
    <?php echo "<input class=\"form-control\" type=\"number\"  name=\"pro_stock\" value=$produit->pro_stock >";?>
</div>
<div class="form-group">
    <label for="pro_couleur"> Couleur</label>
    <?php echo "<input class=\"form-control\" type=\"text\"  name=\"pro_couleur\" value=$produit->pro_couleur >";?>
</div>
<div class="form-group">
    <label for="pro_photo"> Extension de la photo</label>
    <?php echo "<input class=\"form-control\" type=\"text\"  name=\"pro_photo\" value=$produit->pro_photo>";?>
</div>

<div class="form-group">
    <label for="bloque"> Bloquer le produit  :</label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="bloque" id="oui" value="oui" >
        <label class="form-check-label" for="oui">Oui</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="bloque" id="non" value="non" >
        <label class="form-check-label" for="non">Non</label>
    </div>
</div>
<div class="row">
                
<button type="submit" id="envoi" class="btn btn-primary" required >Envoyer</button>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>