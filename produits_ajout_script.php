<!DOCTYPE html>	
<html lang="fr">	
<head>	
<meta charset="UTF-8">	
<meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Atelier PHP N°4 - récuperation données formulaire</title>	
</head>	
<body> 	
<div class="container">	
<div class="row">
   <div class="col-3">
        <img src="jarditou_photos//logo2.jpg" class="img-fluid rounded float-left " alt="logo">
    </div>
    <div class="col-3">
   
    </div>
    <div class="col-6">
      <img src="jarditou_photos//prom.jpg" class="img-fluid max-width: 100%  " alt="promotion">
    </div>

</div>
<div class="menu">
  <nav id="navbar" class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Toggler/collapsibe Button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="liste.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="produits_ajout.php">Mon compte</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">contact </a>
              </li>
          </ul>
      </div> 
  </nav>
</div>
<?php	
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions	

$pro_ref=valid_donnees($_POST["pro_ref"]);
$pro_cat_id=valid_donnees($_POST["pro_cat_id"]);
$pro_libelle=valid_donnees($_POST["pro_libelle"]);
$pro_description=valid_donnees($_POST["pro_description"]);
$pro_prix=valid_donnees($_POST["pro_prix"]);
$pro_stock=valid_donnees($_POST["pro_stock"]);
$pro_couleur=valid_donnees($_POST["pro_couleur"]);
$pro_photo=valid_donnees($_POST["pro_photo"]);
$pro_d_ajout=date("Y-m-d");
$bloque=valid_donnees($_POST["bloque"]);
 // On met les types autorisés dans un tableau (ici pour une image)
  $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

 // On extrait le type du fichier via l'extension FILE_INFO 
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mimetype = finfo_file($finfo, $_FILES["photo"]["tmp_name"]);
  finfo_close($finfo);


  if(isset($pro_ref)
      && preg_match("/^[a-z0-9]{1,10}$/i",$pro_ref)
      && isset($pro_cat_id)
      && isset($pro_libelle)
      && isset($_FILES["photo"])
      && in_array($mimetype, $aMimeTypes)
      && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -]{1,200}$/i",$pro_libelle)
      && isset($pro_description)
      && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -',]{0,1000}$/i",$pro_description)
      && isset($pro_prix)
      && preg_match("/^[0-9.]{1,6}$/",$pro_prix)
      && isset($pro_stock)
      && preg_match("/^[0-9]{1,11}$/",$pro_stock)
      && isset($pro_couleur)
      && preg_match("/^[a-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ-_' ]{1,30}$/i",$pro_couleur)
      && isset($pro_photo)
      && preg_match("/^[a-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ-_ ]{3,10}$/i",$pro_photo)
      && isset($bloque)){
        try {
        $db = connexionBase();
          
            $sth=$db->prepare("INSERT INTO produits(pro_ref, pro_cat_id, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_photo, pro_d_ajout) 
            VALUES(:pro_ref, :pro_cat_id, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, :pro_d_ajout) ");
            $sth->bindParam(':pro_ref',$pro_ref);
            $sth->bindParam(':pro_cat_id',$pro_cat_id);
            $sth->bindParam(':pro_libelle',$pro_libelle);
            $sth->bindParam(':pro_description',$pro_description);
            $sth->bindParam(':pro_prix',$pro_prix);
            $sth->bindParam(':pro_stock',$pro_stock);
            $sth->bindParam(':pro_couleur',$pro_couleur);
            $sth->bindParam(':pro_photo',$pro_photo);
            $sth->bindParam(':pro_d_ajout',$pro_d_ajout);
          
            $sth->execute();
          
            move_uploaded_file($_FILES['photo']['tmp_name'], 'jarditou_photos/' . $db->lastInsertId().$pro_photo);
            
            header("location:liste.php");
          }
      catch(PDOException $e){
          echo " Erreur :".$e->getMessage();
      }
      }else{
        
  echo "<form action=\"produits_ajout_script.php\" method=\"post\" enctype=\"multipart/form-data\">";
 // référence
  if(isset($pro_ref)&& preg_match("/^[a-z0-9]{1,10}$/i",$pro_ref)){
    echo "<div class=\"form-group\"> 
    <label for=\"pro_ref\"> Référence</label>
    <input class=\"form-control\" type=\"text\"  name=\"pro_ref\" value=$pro_ref>
</div>";
  }elseif(isset($pro_ref)&& !preg_match("/^[a-z0-9]{1,10}$/i",$pro_ref)){
  echo "<div class=\"form-group\"> 
  <label for=\"pro_ref\"> Référence</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_ref\" value=$pro_ref>
  <p class=\"text-danger\">La référence doit s'écrire en 10 lettres ou chiffres  max</p>
</div>";
  }else {
  echo "<div class=\"form-group\"> 
  <label for=\"pro_ref\"> Référence</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_ref\" value=$pro_ref>
  <p class=\"text-danger\">Saisissez la référence du produit</p>
</div>";
  }
// libellé
if(isset($pro_libelle)&& preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -]{1,200}$/i",$pro_libelle)){
  echo "<div class=\"form-group\"> 
  <label for=\"pro_ref\"> Libellé</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_libelle\" value=$pro_libelle>
</div>";
}elseif(isset($pro_libelle)&& !preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -]{1,200}$/i",$pro_libelle)){
  echo "<div class=\"form-group\"> 
  <label for=\"pro_ref\"> Libellé</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_libelle\" value=$pro_libelle>
  <p class=\"text-danger\">Le libellé doit s'écrire en 200 lettres ou chiffres  max</p>
</div>";
}else {
  echo "<div class=\"form-group\"> 
  <label for=\"pro_ref\"> Libellé</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_libelle\" value=$pro_libelle>
  <p class=\"text-danger\">Saisissez le libellé du produit</p>
</div>";
}
// catégorie
if (isset($pro_cat_id)){
  echo "<div class=\"form-group\"> 
  <label for=\"pro_cat_id\"> Categorie</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_cat_id\" value=$pro_cat_id>
</div>";
}else{
echo "<div class=\"form-group\">
<label for=\"pro_cat_id\"> Catégorie</label>";

$db = connexionBase(); 
$requete = "SELECT cat_id , cat_nom 
FROM categories 
ORDER BY cat_nom ";	
$result = $db->query($requete);	
if (!$result) 	
{
$tableauErreurs = $db->errorInfo();
echo $tableauErreurs[2]; 
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
echo " </select>
<p class=\"text-danger\">Selectionnez la catégorie du produit</p>
</div>";

}
// photo
if (isset($_FILES["photo"]) && in_array($mimetype, $aMimeTypes)){
  echo "<div class=\"form-group\"> 
  <label for=\"photo\"> Photo</label>
  <input class=\"form-control\" type=\"file\"  name=\"photo\" value=".$_FILES["photo"].">
</div>";
}else{
  echo  "<div class=\"form-group\"> 
    <label for=\"photo\"> Photo</label>
    <input class=\"form-control\" type=\"file\"  name=\"photo\">
    <p class=\"text-danger\">chargez la photo du produit! Formats acceptés:pjpeg,jpeg,png,gif,x-png </p>
</div>";
}
// description
if (isset($pro_description) && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -]{0,1000}$/i",$pro_description)){
  echo "<div class=\"form-group overflow: hidden\">
  <label for=\"pro_description\"> Description</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_description\" value=".$_POST["pro_description"].">
</div>";
}else{
  echo "<div class=\"form-group overflow: hidden\">
  <label for=\"pro_description\"> Description</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_description\" >
</div>";
}
//prix
if (isset($pro_prix) && preg_match("/^[0-9.]{1,6}$/",$pro_prix)){
  echo "<div class=\"form-group\">
  <label for=\"pro_prix\"> Prix</label>
  <input class=\"form-control\" type=\"decimal\"  name=\"pro_prix\" value=".$_POST["pro_prix"].">
</div>";
}else{
  echo "<div class=\"form-group\">
    <label for=\"pro_prix\"> Prix</label>
    <input class=\"form-control\" type=\"decimal\"  name=\"pro_prix\">
    <p class=\"text-danger\">Indiquez le prix du produit </p>
</div>";
}

// Stock
if (isset($pro_stock) && preg_match("/^[0-9]{1,11}$/",$pro_stock)){
  echo "<div class=\"form-group\">
  <label for=\"pro_stock\"> Stock</label>
  <input class=\"form-control\" type=\"number\"  name=\"pro_stock\" value=".$_POST["pro_stock"].">
</div>";
}else{
  echo "<div class=\"form-group\">
    <label for=\"pro_stock\"> Stock</label>
    <input class=\"form-control\" type=\"number\"  name=\"pro_stock\">
    <p class=\"text-danger\">Indiquez le stock du produit </p>
</div>";
}
// couleur
if (isset($pro_couleur) && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ ]{1,30}$/i",$pro_couleur)){
  echo "<div class=\"form-group\">
  <label for=\"pro_couleur\"> Couleur</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_couleur\" value=".$_POST["pro_couleur"].">
</div>";
}else{
  echo "<div class=\"form-group\">
    <label for=\"pro_couleur\"> Couleur</label>
    <input class=\"form-control\" type=\"text\"  name=\"pro_couleur\">
    <p class=\"text-danger\">Indiquez la couleur du produit </p>
</div>";
}
if (isset($pro_photo) && preg_match("/^[a-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ-_ ]{3,10}$/i",$pro_photo)){
  echo "<div class=\"form-group\">
  <label for=\"pro_photo\"> Extension de la photo</label>
  <input class=\"form-control\" type=\"text\"  name=\"pro_photo\" value=".$_POST["pro_photo"].">
</div>";
}else{
  echo "<div class=\"form-group\">
    <label for=\"pro_photo\"> Extension de la photo</label>
    <input class=\"form-control\" type=\"text\"  name=\"pro_photo\">
    <p class=\"text-danger\">Indiquez l'extenstion de la photo du produit </p>
</div>";
}

echo "<div class=\"form-group\">
    <label for=\"bloque\"> Bloquer le produit  :</label>
    <div class=\"form-check form-check-inline\">
        <input class=\"form-check-input\" type=\"radio\" name=\"bloque\" id=\"oui\" value=\"oui\" >
        <label class=\"form-check-label\" for=\"oui\">Oui</label>
    </div>
    <div class=\"form-check form-check-inline\">
        <input class=\"form-check-input\" type=\"radio\" name=\"bloque\" id=\"non\" value=\"non\" >
        <label class=\"form-check-label\" for=\"non\">Non</label>
    </div>
</div>
<div class=\"row\">
                
<button type=\"submit\" id=\"envoi\" class=\"btn btn-primary\" required >Envoyer</button>
</div>
</form>";
      }
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>	
</html> 