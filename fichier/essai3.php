<?php
// Ouverture en lecture seule  
$fp = fopen("ListeLiens.txt", "r"); 

// Boucle jusqu'à la fin du fichier
while (!feof($fp)) 
{ 
    // Lecture d'une ligne, le contenu de la ligne est affecté à la variable $ligne  
    $ligne = fgets($fp, 4096); 
    echo "<a style=\"text-decoration:none\" href=$ligne >$ligne </a><br>" ;
} 
?>