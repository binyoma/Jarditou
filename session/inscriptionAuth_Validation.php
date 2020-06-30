<?php
include('fonctions.php');
try{
    $base= new PDO('mysql:host=localhost;port=3308 ;charset=utf8; dbname=Jarditou', 'root', 'password');
    $base -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $sql="SELECT * FROM users WHERE  user_login = :user_login ";
    //préparation de la requête avec les marqueurs
    $resultat=$base ->prepare($sql);
    $login=valid_donnees($_POST["login"]);
    $password=valid_donnees($_POST["password"]);
    $resultat->bindValue(':user_login',$login);
    $resultat->execute();
    $nombre_ligne=$resultat->rowCount(); // methode retournant le nombre de ligne
    // s'il y a une ligne, c'est que la personne existe en base de données 
    $row = $resultat->fetch(PDO::FETCH_OBJ);	
    $hash=$row->user_mdp;

     if(($nombre_ligne!=0) && (password_verify($password,$hash))){
        echo "Login correct et Mot de passe corrects";
    }else{
        header("location:inscriptionAuth.php?message=1");
    }
    //$resultat->closeCursor();
}
catch(Exception $e){
    die('Erreur :'.$e ->getMessage());
}
finally {
    $base=null; // fermeture de la connexion
}