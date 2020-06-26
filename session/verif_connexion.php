<?php
    include("fonctions.php");
    $v="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/"; 
    $mail=valid_donnees($_POST['mail']);
    $pass=valid_donnees($_POST['password']);
    if (isset($mail)&&isset($pass)){
        if ((filter_var($mail,FILTER_VALIDATE_EMAIL))&&(preg_match($v,$pass))) {
            
            $dbco=new PDO ('mysql:host=localhost;port=3308 ;charset=utf8; dbname=session', 'root', 'password');
        
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