<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0,shrink-to-fit=no'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Session Exercice 1</title>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
</head>
<body>
<div class='container'> 
    <div class="row">
    <div class="col-3">
        <img src="../jarditou_photos//jarditou_logo.jpg" class="img-fluid rounded float-left " alt="logo">
    </div>
    <div class="col-3">
    
    </div>
    <div class="col-6">
        <img src="../jarditou_photos//promotion.jpg" class="img-fluid max-width: 100%  " alt="promotion">
    </div>

</div>
    <div class='menu'>
    <nav id='navbar' class='navbar navbar-expand-sm bg-dark navbar-dark'>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#collapsibleNavbar'>
        <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='collapsibleNavbar'>
            <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class='nav-link' href=''>Accueil</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href=''>compte</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href=''>contact </a>
                </li>
            </ul>
        </div> 
    </nav>
    </div>
    <div class='row'>
        <form role='form'   action='inscriptionAuth_Validation.php'  method='POST' class='needs-validation' novalidate>
        <br>
        <div class='form-group row'>
                <label for='login' class='col-sm-4 col-form-label'>Login</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' id='login' name='login'>
                </div>
            </div>
            <div class='form-group row'>
                <label for='password' class='col-sm-4 col-form-label'>Mot de Passe </label>
                <div class='col-sm-8'>
                    <input type='password' class='form-control' id='password' name='password'>
                </div>
            </div>
            <div class='row'>
            
            <button type='submit' id='envoi' class='btn btn-primary' >Envoyer</button>
                </div>
    <?php
    if (isset($_GET["message"])&&($_GET["message"]==1)){
        echo "<span style='color:ff0000'>Login ou Mot de passe incorrect</span>";
    }
    ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>