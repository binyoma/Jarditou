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
$pro_id=valid_donnees($_POST["pro_id"]);

$pro_ref=valid_donnees($_POST["pro_ref"]);
$pro_cat_id=valid_donnees($_POST["pro_cat_id"]);
$pro_libelle=valid_donnees($_POST["pro_libelle"]);
$pro_description=valid_donnees($_POST["pro_description"]);
$pro_prix=valid_donnees($_POST["pro_prix"]);
$pro_stock=valid_donnees($_POST["pro_stock"]);
$pro_couleur=valid_donnees($_POST["pro_couleur"]);
$pro_photo=valid_donnees($_POST["pro_photo"]);
$datetime=new DateTime();
$pro_d_modif=$datetime->format('Y-m-d h:i');
$bloque=valid_donnees($_POST["bloque"]);



if(isset($pro_ref)
    && preg_match("/^[a-z0-9]{1,10}$/i",$pro_ref)
    && isset($pro_cat_id)
    && preg_match("/^[0-9]{1,10}$/",$pro_cat_id)
    && isset($pro_libelle)
    && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -]{1,200}$/i",$pro_libelle)
    && isset($pro_description)
    && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -]{0,1000}$/i",$pro_description)
    && isset($pro_prix)
    && preg_match("/^[0-9.]{1,6}$/",$pro_prix)
    && isset($pro_stock)
    && preg_match("/^[0-9]{1,11}$/",$pro_stock)
    && isset($pro_couleur)
    && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ ]{1,30}$/i",$pro_couleur)
    && isset($pro_photo)
    && preg_match("/^[a-z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ ]{1,4}$/i",$pro_photo)){
      try {
          $db= connexionBase(); 
          $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          
          $sql="UPDATE produits 
            SET pro_ref=:pro_ref, pro_cat_id=:pro_cat_id, pro_libelle=:pro_libelle,
            pro_description=:pro_description, pro_prix=:pro_prix,pro_stock=:pro_stock,
            pro_couleur=:pro_couleur, pro_photo=:pro_photo, pro_d_modif=:pro_d_modif
            WHERE pro_id=:pro_id";

          $stmt=$db->prepare($sql);
          $stmt->execute(array(
            'pro_ref'=>$pro_ref,
            'pro_cat_id'=>$pro_cat_id,
            'pro_libelle'=>$pro_libelle,
            'pro_description'=>$pro_description,
            'pro_prix'=>$pro_prix,
            'pro_stock'=>$pro_stock,
            'pro_couleur'=>$pro_couleur,
            'pro_photo'=>$pro_photo,
            'pro_d_modif'=>$pro_d_modif,
            'pro_id'=>$pro_id
            ));
           // On met les types autorisés dans un tableau (ici pour une image)
            $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

          // On extrait le type du fichier via l'extension FILE_INFO 
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimetype = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);
            finfo_close($finfo);

          if (in_array($mimetype, $aMimeTypes))
              {
    
            move_uploaded_file($_FILES['fichier']['tmp_name'], 'jarditou_photos/' . $db->lastInserId());
            } 
          else 
            {
           // Le type n'est pas autorisé, donc ERREUR

            echo "Type de fichier non autorisé";    
              exit;
            }    

            header("location:liste.php");
          }
      catch(PDOException $e){
          echo " Erreur :".$e->getMessage();
      }
     }else{
        header("location:formulaire_modif.php");
     }
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>	
</html> 