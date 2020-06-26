<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier PHP N°4 - page de suppression</title>
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
    <script type="text/javascript">
    if (confirm("Voulez-vous supprimer le produit?")){
       <?php 
       try {
        
        $db = connexionBase();
        $sql="DELETE FROM produits WHERE pro_id=".$pro_id;

        $sth=$db->prepare($sql);
        $sth->execute();

        header("location:liste.php");
       }
   catch(PDOException $e){
       echo " Erreur :".$e->getMessage();
   }
       ?>
    }else{
    <?php
     header("location:liste.php");
    ?>
    }
    <script>
</body>
</html>