<?php

try{
    $base= new PDO('mysql:host=localhost;port=3308 ;charset=utf8; dbname=session', 'root', 'password');
    $base -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $sql="SELECT * FROM login_password WHERE  login = :login AND password = :password";
    //préparation de la requête avec les marqueurs
    $resultat=$base ->prepare($sql);
    $login=htmlentities(addslashes($_POST["login"]));
    $password=htmlentities(addslashes($_POST["password"]));
    $resultat->bindValue(':login',$login);
    $resultat->bindValue(':password',$password);
    $resultat->execute();
    $nombre_ligne=$resultat->rowCount(); // methode retournant le nombre de ligne
    // s'il y a une ligne, c'est que la personne existe en base de données
    if($nombre_ligne!=0){
        echo "<h2>Login correct<h2>";
    }else{
        header("location:login.php?message=1");
    }
    $resultat->closeCursor();
}
catch(Exception $e){
    die('Erreur :'.$e ->getMessage());
}
finally {
    $base=null; // fermeture de la connexion
}