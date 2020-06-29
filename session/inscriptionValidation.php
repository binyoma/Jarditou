<?php
    include("fonctions.php");
    $vPass="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/"; 
    $vLogin="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/"; 
    $vLettres="/^[a-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ._ -]{1,30}$/i";
    $prenom=valid_donnees($_POST['prenom']);
    $nom=valid_donnees($_POST['nom']);
    $mail=valid_donnees($_POST['mail']);
    $login=valid_donnees($_POST['login']);
    $pass=valid_donnees($_POST['password']);
    $pass1=valid_donnees($_POST['password1']);
    $inscription=new DateTime();
    $dateInscription=$inscription->format('Y-m-d');
    if (isset($prenom)
        && preg_match($vLettres,$prenom)
        && isset($nom)
        && preg_match($vLettres,$nom)
        && isset($login)
        && preg_match($vLogin,$login)
        && isset($mail)
        && filter_var($mail,FILTER_VALIDATE_EMAIL)
        && isset($pass)
        && preg_match($vPass,$pass)
        && isset($pass1)
        && preg_match($vPass,$pass1)
        && $pass ===$pass1) {
            try{
                $dbco=new PDO ('mysql:host=localhost;port=3308 ;charset=utf8; dbname=jarditou', 'root', 'password');
                $pass_hash=password_hash($pass, PASSWORD_DEFAULT);
        
                $sth=$dbco->prepare("INSERT INTO users(user_nom,user_prenom,user_mail,user_login,user_mdp,user_inscription) 
                                        VALUES(:user_nom,:user_prenom,:user_mail,:user_login,:user_mdp,:user_inscription) ");
                $sth->bindParam(':user_nom',$nom);
                $sth->bindParam('user_prenom',$prenom);
                $sth->bindParam(':user_mail',$mail);
                $sth->bindParam(':user_login',$login);
                $sth->bindParam(':user_mdp',$pass_hash);
                $sth->bindParam('user_inscription',$dateInscription);
                $sth->execute();
                header("location:../liste.php");
            }    
            catch(PDOException $e){
                echo " Erreur :".$e->getMessage();
            } 
        }
    else {
 echo"       
<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0,shrink-to-fit=no\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>session</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">
</head>
<body>
    <div class=\"container\">
    <div class=\"row\">
   <div class=\"col-3\">
        <img src=\"../jarditou_photos//jarditou_logo.jpg\" class=\"img-fluid rounded float-left \" alt=\"logo\">
    </div>
    <div class=\"col-3\">
    
    </div>
    <div class=\"col-6\">
      <img src=\"../jarditou_photos//promotion.jpg\" class=\"img-fluid max-width: 100%  \" alt=\"promotion\">
    </div>

</div>
    <div class=\"menu\">
    <nav id=\"navbar\" class=\"navbar navbar-expand-sm bg-dark navbar-dark\">
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapsibleNavbar\">
        <span class=\"navbar-toggler-icon\"></span>
        </button>
        <div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">
            <ul class=\"navbar-nav\">
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"#\">Accueil</a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"\">Nos produits</a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"\">Heures d'ouvertures </a>
                </li>
            </ul>
        </div> 
    </nav>
    </div>
    <div class=\"row\">
        <form role=\"form\"   action=\"inscriptionValidation.php\"  method=\"POST\" class=\"needs-validation\" novalidate>";
        
                if(isset($prenom) && preg_match($vLettres,$prenom)){
                    echo "<div class='form-group row'>
                <label for='prenom' class='col-sm-2 col-form-label'>Prénom</label>
                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='prenom' name='prenom' value=".$prenom.">
                </div>
            </div>";
                }else if (isset($prenom) && !preg_match($vLettres,$prenom)){
                    echo"<div class='form-group row'>
                    <label for='prenom' class='col-sm-2 col-form-label'>Prénom</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='prenom' name='prenom'>
                        <p class=\"text-danger\">Votre prénom doit s'écrire seulement avec des lettres et au max 30 caratères</p>
                    </div>
                </div>";
                }else{
                    echo"<div class='form-group row'>
                    <label for='prenom' class='col-sm-2 col-form-label'>Prénom</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='prenom' name='prenom'>
                        <p class=\"text-danger\">Indiquez votre prénom. Il doit s'écrire seulement avec des lettres et au max 30 caratères</p>
                    </div>
                </div>";
                }
                //NOM 
                if(isset($nom) && preg_match($vLettres,$nom)){
                    echo "<div class='form-group row'>
                <label for='nom' class='col-sm-2 col-form-label'>Nom</label>
                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='nom' name='nom' value=$nom>
                </div>
            </div>";
                }else if (isset($nom) && !preg_match($vLettres,$nom)){
                    echo"<div class='form-group row'>
                    <label for='nom' class='col-sm-2 col-form-label'>Nom</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='nom' name='nom'>
                        <p class=\"text-danger\">Votre Nom doit s'écrire seulement avec des lettres et au max 30 caratères</p>
                    </div>
                </div>";
                }else{
                    echo"<div class='form-group row'>
                    <label for='nom' class='col-sm-2 col-form-label'>Nom</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='nom' name='nom'>
                        <p class=\"text-danger\">Indiquez votre Nom. Il doit s'écrire seulement avec des lettres et au max 30 caratères</p>
                    </div>
                </div>";
                }

                if(isset($mail) && filter_var($mail,FILTER_VALIDATE_EMAIL)){
                    echo "<div class='form-group row'>
                <label for='mail' class='col-sm-2 col-form-label'>Email</label>
                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='mail' name='mail' value=$mail>
                </div>
            </div>";
                }else if (isset($mail) && !filter_var($mail,FILTER_VALIDATE_EMAIL)){
                    echo"<div class='form-group row'>
                    <label for='mail' class='col-sm-2 col-form-label'>Email</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='mail' name='mail'>
                        <p class=\"text-danger\">Votre mail doit être valide</p>
                    </div>
                </div>";
                }else{
                    echo"<div class='form-group row'>
                    <label for='mail' class='col-sm-2 col-form-label'>Email</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='mail' name='mail'>
                        <p class=\"text-danger\">Indiquez votre mail. </p>
                    </div>
                </div>";
                }
                if(isset($login) && preg_match($vLogin,$login)){
                    echo "<div class='form-group row'>
                <label for='login' class='col-sm-2 col-form-label'>Login</label>
                <div class='col-sm-10'>
                    <input type='text' class='form-control' id='login' name='login' value=$login>
                </div>
            </div>";
                }else if (isset($login) && !preg_match($vLogin,$login)){
                    echo"<div class='form-group row'>
                    <label for='login' class='col-sm-2 col-form-label'>Login</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='login' name='login'>
                        <p class=\"text-danger\">Votre login doit possèder au moins 6 caractères dont au moins une majuscule,une minuscule
                        et un chiffre</p>
                    </div>
                </div>";
                }else{
                    echo"<div class='form-group row'>
                    <label for='login' class='col-sm-2 col-form-label'>Login</label>
                    <div class='col-sm-10'>
                        <input type='text' class='form-control' id='login' name='login'>
                        <p class=\"text-danger\">Indiquez votre login. Votre login doit possèder au moins 6 caractères dont au moins une majuscule,une minuscule
                        et un chiffre</p>
                    </div>
                </div>";
                }
                
                if (isset($pass) && !preg_match($vPass,$pass)){
                    echo "<div class='form-group row'>
                    <label for='password' class='col-sm-2 col-form-label'> Mot de passe </label>
                    <div class='col-sm-10'>
                        <input type='password' class='form-control' id='password' name='password'>
                    </div>
                </div>
                <div class='form-group row'>
                    <label for='password' class='col-sm-2 col-form-label'> Confirmer le mot de passe </label>
                    <div class='col-sm-10'>
                        <input type='password' class='form-control' id='password1' name='password1'>
                        <p class=\"text-danger\"> Le mot de passe doit possèder au moins 8 caractères dont au moins une majuscule,une minuscule
                        un chiffre et un caractère spécial </p>
                    </div>
                </div>";
                }else {
                    echo "<div class='form-group row'>
                    <label for='password' class='col-sm-2 col-form-label'> Mot de passe </label>
                    <div class='col-sm-10'>
                        <input type='password' class='form-control' id='password' name='password'>
                        <small id='lastnameHelpBlock' class='form-text text-muted'>
                        Le mot de passe doit possèder au moins 8 caractères dont au moins une majuscule,une minuscule
                        un chiffre et un caractère spécial
                        </small>
                    </div>
                    </div>
                    <div class='form-group row'>
                    <label for='password' class='col-sm-2 col-form-label'> Confirmer le mot de passe </label>
                    <div class='col-sm-10'>
                        <input type='password' class='form-control' id='password1' name='password1'>
                    </div>
                    </div>" ;
                }
                echo "<div class='row'>
            
                <button type='submit' id='envoi' class='btn btn-primary' >Envoyer</button>
                    </div>
                
                </div>
                
        </form>
        
    </div>

<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\" integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\"></script>
</body>
</html>";
    }
  ?>      