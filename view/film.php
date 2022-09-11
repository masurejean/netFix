<?php
session_start();
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);

require_once("../Controller/FilmController.php");
require_once($routeController->getController("UserController"));

$films = FilmController::selectRandomFilms(10);
$films = json_encode($films);
$url = $routeController->getRoute("singleFilm");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <script>
        const films = <?= $films ?>;
        const dCard = true;
        const url = '<?= $url ?>';
        const xhrUrl = '<?= $xhrUrl ?>';
        const session_id = <?= $_SESSION['user']['id_user']?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/js/card.js" type="text/babel" defer></script>
</head>

<body>
    <header>
    <?php include_once($routeController->getRoute("menu")); ?>
    </header>
    <main>
        <div id="cardsFrame"></div>
    </main>



</body>

</html>