<?php

require_once("../controleur/filmsController.php");
require_once("../inc/ConnectDB.php");

$film= FilmController::getFilmById(4241,$pdo);
echo $film->getTitle();

?>