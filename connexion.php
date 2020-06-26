<?php

try 
{
   $db = new PDO('mysql:host=localhost;port=3308 ;charset=utf8; dbname=jarditou', 'root', 'password');

   // Ajout d'une option PDO pour gérer les exceptions
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die('Fin du script');
}