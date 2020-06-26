<?php

// nettoyage, un peu sécurisation des données récues
function valid_donnees($donnees){
    $donnees=trim($donnees);
    $donnees=stripcslashes($donnees);
    $donnees=htmlspecialchars($donnees);
    return $donnees;
}

// calcul de l'age
function age($date) { 
    $age = date('Y') - date('Y', strtotime($date));
if (date('md') < date('md', strtotime($date))) { 
   return $age - 1;
}
    return $age;

}
?>