<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Atelier 3</title>
  <?php
      include("connexion.php");
    ?>
</head>
<body>
    <?php
      $requete = "SELECT * FROM produits WHERE pro_id =".$_GET["pro_id"];
      $result = $db->query($requete);
      $produit = $result->fetch(PDO::FETCH_OBJ);
      $result->closeCursor();

       echo $produit->pro_id.'<br>'; 
 
  echo $produit->pro_cat_id.'<br>'; 
 
  echo $produit->pro_ref.'<br>'; 
 
  echo $produit->pro_libelle.'<br>'; 
 
  echo $produit->pro_description.'<br>'; 
 
  echo $produit->pro_prix.'<br>'; 
  
  echo $produit->pro_stock.'<br>'; 
 
  echo $produit->pro_couleur.'<br>'; 
 
  echo $produit->pro_photo.'<br>'; 
  
  echo $produit->pro_d_ajout.'<br>'; 
  
  echo $produit->pro_d_modif.'<br>'; 
  
  echo $produit->pro_bloque.'<br>'; 
    ?>
</body>
</html>