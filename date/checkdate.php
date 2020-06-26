<html>
<body>
<?php

$date = "32/10/2019";

    /* 
    * - On découpe la chaîne $date selon '/' avec la fonction explode() qui retourne un tableau 
    * - Les éléments du tableau sont directement afffecté à des variables ($dd, $mm, $yyyy) dans un ordre respectif grâce à la fonction list()      
    */
    list($dd, $mm, $yyyy) = explode('/', $date);

    /* Les variables $dd, $mm, $yyyy sont des chaînes, or la fonction checkdate()  
    * n'accepte que des entiers
    */
    echo gettype($dd); // indique que $dd est une chaîne

    /* On va donc 'caster' c'est-à-dire changer le type d'une variable,
    * ici on veut un entier, la syntaxe est de l'indiquer avec (int) 
    * devant la variable
    */ 
    $dd = (int) $dd;

    echo gettype($dd); // $dd est désormais bien un entier

    $mm = (int) $mm;
    $yyyy = (int) $yyyy;

    if (!checkdate($mm, $dd, $yyyy))
    {         
        echo"Date ".$date." est erronée.";
    }