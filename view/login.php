<?php 
session_start();
require_once("../Controller/UserController.php");
$userController = new UserController;
$login = $userController->login($_POST,$_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div><input type="text" name="login" placeholder="Entrez votre login ou email"><span></span></div>
        <div><input type="password" name="pwd" placeholder="Entrez votre mot de passe"><span></span></div>
        <div><input type="submit" value="Envoyer" name="submited"><span></span></div>
    </form>
</body>
</html>