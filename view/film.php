<?php
session_start();
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once("../Controller/FilmController.php");
// $routeController->getRoute("index");
// $routeController->getRoute("logout");
/* require_once("../inc/PDO.php");
require_once("../Controller/FilmController.php");

$film = FilmController::getFilmById(4241,$pdo);
var_dump($film); */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author ---> JP MASURE">
    <title>Films</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <header>
        <?= include("./menu.php"); ?>
        <div>on est sur film</div>
    </header>

    <Main>
        <?php
            $filmsControler = new   FilmController();
                $result = $filmsControler->getArrayFilm();
        ?>
        <div class="plateauPresentation">
            <?php
            foreach($result as $film){
                
                $poster = "../asset/img/poster/". $film['id_movie'];
                //var_dump($poster);


                 echo ('<div class="card" >
                    <img class="card-img-top" src="'.$poster.'" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">Titre  : '.$film['title'].'</h4>
                        <p class="card-text"> Description  : '.$film['plot'].'</p>
                        <p class="card-text">Directors  : '.$film['directors'].'</p>
                        <p class="card-text">Directors  : '.$film['genres'].'</p>
                    </div>
                </div>');
            }

                
                
           

            ?>
        </div>
    </Main>


</body>
</html>
