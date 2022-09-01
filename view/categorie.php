<?php
session_start();
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getController("FilmController"));
$url = $routeController->getRoute("singleFilm");
$nbpage = FilmController::getNbPage($_GET['genre']);
$activePrev = false;
$activeNext = false;
$activePage= 1;
$currentPage = 1;
//var_dump($nbpage);
if (isset($_GET['currentPage'])&& !empty($_GET['currentPage'])) {
    $currentPage = strip_tags($_GET['currentPage']);
    if(!strpos($currentPage, ",")) {
        $currentPage =intval($currentPage);
    }

    if(!is_numeric($currentPage)) {
        $tmpCurrentPage = explode(",", $currentPage);
        if (explode(",", $currentPage)[0] == "prev") {
            $currentPage = intval($tmpCurrentPage[1])-1;
            $activePage =$currentPage;
            if($currentPage == 2){
                $currentPage = 1;
            }
            $activePage =$currentPage;
            $activePrev =true;
        } else {
            $currentPage = intval($tmpCurrentPage[1])+1;
            if($currentPage == $nbpage ){
                $currentPage = $nbpage-1;
                $activeNext = true;
            }
            $activePage =$currentPage;
        }
    }
} else {
    $activePage =$currentPage;
}

$films = FilmController::getFilmsByGenre($_GET['genre'], $currentPage);
$films = json_encode($films);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorie : <?= $_GET['genre'] ?></title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $routeController->getAssets() ?>css/card.css">
    <script>
        const films = <?= $films ?>;
        const dCard = true;
        const url = '<?= $url ?>';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= $routeController->getAssets() ?>js/card.js" type="text/babel" defer></script>
</head>

<body>
    <header>
        <?php include_once($routeController->getRoute("menu")); ?>
    </header>
    <main>
        <?php include($routeController->getInc("pagination")); ?>

        <div id="cardsFrame"></div>
        <?php include($routeController->getInc("pagination")); ?>
        
    </main>



</body>

</html>