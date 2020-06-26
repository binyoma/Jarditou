
<?php
//1. Affichez la date du jour au format mardi 2 juillet 2019. 
include('classDateTimeFrench.php');
$d=new DateTimeFrench();
echo "Nous sommes :". $d->format("l d F Y");

//2.Trouvez le numéro de semaine de la date suivante : 14/07/2019

$a=new DateTime("2019-07-14");
echo "<br>le 14/07/2019 c'était la ". $a->format("W")."ème semaine";


//3.Combien reste-t-il de jours avant la fin de votre formation.

echo "<br> la formation se termine le 19 novembre 2020, il nous reste ";
$datetime1 = new DateTime();
$datetime2 = new DateTime('2020-11-19');
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a jours');

//4. Reprenez l'exercice 3, mais traitez le problème avec les fonctions de gestion du timestamp, time() et mktime(). 


echo "<br> la formation se termine le 19 novembre 2020, il nous reste ";
$datetime1 = time();
$datetime2 = mktime(0,0,0,11,19,2020);
$interval =$datetime2-$datetime1;
echo round( $interval/(60*60*24)) ." jours";

//5. Quelle sera la prochaine année bissextile ? 

$t=new DateTime();
$i=$t->format("Y");
while((((($i++) % 4) == 0) && (((($i++) % 100) != 0) || ((($i++) %400) == 0)))){
 $i++;
};
echo "<br>la prochaine année bissextile est ".$i;


//6.Montrez que la date du 17/17/2019 est erronée. 

$date = "17/17/2019";

list($dd, $mm, $yyyy) = explode('/', $date);
$dd = (int) $dd;
$mm = (int) $mm;
    $yyyy = (int) $yyyy;

    if (!checkdate($mm, $dd, $yyyy))
    {         
        echo"<br>Date ".$date." est erronée.";
    }

//7. Affichez l'heure courante sous cette forme : 11h25.
echo "<br>Il est ";
$h= new DateTime();
$h->setTimezone(new DateTimeZone('Europe/Paris'));
echo $h->format('H:i') . "<br>";

// 8. Ajoutez 1 mois à la date courante.

$mois = new DateTime();
$interval = new DateInterval('P1M');

$mois->add($interval);
echo "<br>".$mois->format('Y-m-d') . "\n";



?>
