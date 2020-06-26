<?php
	
function connexionBase()	
{
   
   try 
   {
    
        $db = new PDO('mysql:host=localhost;port=3308 ;charset=utf8; dbname=jarditou', 'root', 'password');
        return $db;
    } 
    catch (Exception $e) 
    {
        echo 'Erreur : ' . $e->getMessage() . '<br>';
        echo 'N° : ' . $e->getCode() . '<br>';
        die('Connexion au serveur impossible.');
    } 
}
// nettoyage, un peu sécurisation des données récues
function valid_donnees($donnees){
    $donnees=trim($donnees);
    $donnees=stripcslashes($donnees);
    $donnees=htmlspecialchars($donnees);
    return $donnees;
}
	
?>