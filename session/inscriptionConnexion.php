<?php 
session_start();
include("fonctions.php");
?>

    <form action="seConnecter.php" method="POST">
    Déjà inscrit(e)? <a style="text-decoration:none" href=login.php > Se connecter </a><br>
    <p>
    <label for="mail" >Email</label>
    <input type="email"  name="mail" required >
   </p>
    <label for="password" >Mot de passe</label>
    <input type="password"  name="password" required >
    <p> Note: Le mot de passe doit possèder au moins 8 caractères dont au moins une majuscule,une minuscule
 un chiffre et un caractère spécial</p>
    <?php
    
    $v="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/"; 
    if (isset($mail)&&isset($pass)){
        if ((filter_var($mail,FILTER_VALIDATE_EMAIL))&&(preg_match($v,$pass))) {
            $mail=valid_donnees($_POST['mail']);
            $pass=valid_donnees($_POST['password']);
            $dbco=new PDO ('mysql:host=localhost;port=3308 ;charset=utf8; dbname=session', 'root', 'password');
            $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sth=$dbco->prepare("INSERT INTO login_password(pass_login, pass_word) 
                                        VALUES(:pass_login, :pass_word) ");
            $sth->bindParam(':pass_login',$mail);
            $sth->bindParam(':pass_word',$pass);
            $sth->execute();
            header("location:login.php");
                }
        else{
            header("location:seConnecter.php?message=1");
                }
            }
     if (isset($_GET["message"])&&($_GET["message"]==1)){
        echo "<span style='color:ff0000'>Email invalide ou mot de passe incorrect</span>";
        }
    echo "<button type='submit' id='envoi'  >Envoyer</button> </form>";
    ?>
</body>
</html>