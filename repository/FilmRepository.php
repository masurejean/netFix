<?php
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getInc("ConnectDB"));
class FilmRepository
{
    public function selectFilmById($id)
    {
        $pdo = new ConnectDB;
        $rq = "SELECT * FROM movies_full WHERE id_movie = :id";
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();
        return  $requete->fetch();
        
        
    }
    public function selectFilmsR($nbFilm)
    {
        $pdo = new ConnectDB;
        $rq = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT $nbFilm";
        $requete = $pdo->connect()->prepare($rq);
        $requete->execute();
        return $requete->fetchall();
    }
    public function selectGenres()
    {
        $pdo = new ConnectDB;
        $rq = "SELECT
            substring_index(genres, ',', 1) 
            AS genre
            FROM movies_full GROUP BY genre
            ";
        $requete = $pdo->connect()->prepare($rq);
        $requete->execute();
        return $requete->fetchall();
    }
    public function selectFilmsByGenre($genre,$index,$nbFilms){
        $pdo = new ConnectDB;
        $rq = "SELECT * FROM movies_full WHERE genres LIKE :genre LIMIT $index,$nbFilms";
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(":genre", '%'.$genre.'%', PDO::PARAM_STR);
        $requete->execute();
        return $requete->fetchall();
    }

    public function pageByGenre($genre){
        $pdo = new ConnectDB;
        $rq = "SELECT  id_movie FROM movies_full WHERE genres LIKE :genre ";
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(":genre", '%'.$genre.'%', PDO::PARAM_STR);
        $requete->execute();
        return $requete->rowCount();

    }

    public function selectSearch($search){
        $pdo = new ConnectDB;
        $rq = "SELECT  * FROM movies_full WHERE cast LIKE :search OR title LIKE :search OR directors  like :search LIMIT 0,20";
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(":search", '%'.$search.'%', PDO::PARAM_STR);
        $requete->execute();
        return $requete->fetchall();
    }
}
