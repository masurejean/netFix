<?php
require_once("../controleur/UserControleur.php");

$userController = new UserController($_POST);
var_dump($userController->errors);
var_dump($userController->post);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration form</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="fond">
    <form action="" method="post">
        <div>
            <input type="text" placeholder="login" name="login" 
            value = "<?= isset( $userController->post['login'])? $userController->post['login'] :""?>">
            <span><?=  isset($userController->errors['login']) ? $userController->errors['login']:"" ?></span>
        </div>
        <div>
            <input type="text" placeholder="email" name="email" 
            value = "<?= isset( $userController->post['email'])? $userController->post['email'] :""?>">
            <span><?=  isset($userController->errors['email']) ? $userController->errors['email']:"" ?></span>
        </div>
        <div>
            <input type="password" name="pwd" placeholder="psw" 
            value = "<?= isset( $userController->post['psw'])? $userController->post['psw'] :""?>">
            <span><?=  isset($userController->errors['psw']) ? $userController->errors['psw']:"" ?></span>
        </div>
        <div>
            <input type="password" name="confirmPwd" placeholder="psw" 
            value = "<?= isset( $userController->post['confirmPwd'])? $userController->post['confirmPwd'] :""?>">
            <span><?=  isset($userController->errors['confirmPwd']) ? $userController->errors['confirmPwd']:"" ?></span>
        </div>
        <div>
            <input type="submit" value="envoyer" name= "submited">
            
        </div>
        
    </form></div>
</body>
</html>