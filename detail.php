<!DOCTYPE html>
    <html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Atelier PHP N°4 - page de détail</title>
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
<div class="row">
   <div class="col-3">
        <img src="jarditou_photos//logo2.jpg" class="img-fluid rounded float-left " alt="logo">
    </div>
    <div class="col-3">
    <?php echo "<a href=\"formulaire_modif.php?pro_id=$produit->pro_id \" title=\"Modifier\">Modifier </a><br> <br>
    
     <a href=\"delete.php?pro_id=$produit->pro_id \" title=\"Supprimer\">Supprimer</a>";?>
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
                <a class="nav-link" href="Formulaire.html">Mon compte</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="Horaires.html">contact </a>
                </li>
            </ul>
      </div> 
  </nav>
</div>
<form>
<div class="form-group">
    <label for="id"> ID</label>
    <div class="form-control">
    <?php echo $produit->pro_id;
    ?>
    </div>
</div>
<div class="form-group">
    <label for="ref"> Référence</label>
    <div class="form-control">
    <?php echo $produit->pro_ref;
    ?>
    </div>
</div>
<div class="form-group">
    <label for="categorie"> Catégorie</label>
    <div class="form-control">
    <?php echo $produit->pro_cat_id;
    ?>
    </div>
</div>
<div class="form-group">
    <label for="libelle"> Libellé</label>
    <div class="form-control">
    <?php echo $produit->pro_libelle;
    ?>
    </div>
</div>
<div class="form-group  overflow: hidden">
    <label for="Description"> Description</label>
    <div class="form-control text-justify overflow-auto ">
    <?php echo $produit->pro_description;
    ?>
    </div>
</div>
<div class="form-group">
    <label for="prix"> Prix</label>
    <div class="form-control">
    <?php echo $produit->pro_prix;
    ?>
    </div>
</div>
<div class="form-group">
    <label for="stock"> Stock</label>
    <div class="form-control">
    <?php echo $produit->pro_stock;
    ?>
    </div>
</div>
<div class="form-group">
    <label for="couleur"> Couleur</label>
    <div class="form-control">
    <?php echo $produit->pro_couleur;
    ?>
    </div>
</div>
<div class="form-group">
  <?php   
    if ($produit->pro_bloque){
        echo "Produit bloqué: ". "<div class=\"form-check form-check-inline\">
        <input class=\"form-check-input\" type=\"radio\" name=\"bloque\" id=\"oui\" value=\"oui\" checked>
        <label class=\"form-check-label\" for=\"oui\">Oui</label>
    </div>
    <div class=\"form-check form-check-inline\">
        <input class=\"form-check-input\" type=\"radio\" name=\"sexe\" id=\"non\" value=\"non\" >
        <label class=\"form-check-label\" for=\"non\">Non</label>
    </div><br>";
    }else{
        echo "Produit bloqué: ". "<div class=\"form-check form-check-inline\">
        <input class=\"form-check-input\" type=\"radio\" name=\"bloque\" id=\"oui\" value=\"oui\" >
        <label class=\"form-check-label\" for=\"oui\">Oui</label>
    </div>
    <div class=\"form-check form-check-inline\">
        <input class=\"form-check-input\" type=\"radio\" name=\"sexe\" id=\"non\" value=\"non\"checked >
        <label class=\"form-check-label\" for=\"non\">Non</label>
    </div> <br>"; 
    }
    echo "Date d'ajout : ".date("d/m/Y",strtotime($produit->pro_d_ajout))."<br>";
    
    if ($produit->pro_d_modif){
        $date=$produit->pro_d_modif;
    
        $datetime=new DateTime($date);
        
        echo "Date de modification  : ".$datetime->format('d/m/Y H\hi');
    }else {
        echo "Date de modification  : pas encore";
    }
    
   ?> 
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>