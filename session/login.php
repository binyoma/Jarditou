<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="verif_login.php" method="POST">
    <p> veuillez saisir votr login et password <p>
    <label>Login</label>
    <input type="mail" name="login"><br>
    <label>Mot de pass<label>
    <input type="password" name="password"><br>
    <input type="submit" value="vérifier">
    <?php
    if (isset($_GET["message"])&&($_GET["message"]==1)){
        echo "<span style='color:ff0000'>Login incorrect</span>";
    }
    ?>
</body>
</html>