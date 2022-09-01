<?php
session_start();
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
</head>
<body>
    <header>
        <?php
        include_once($routeController->getRoute("menu"));
        ?>
    </header>
</body>
</html>