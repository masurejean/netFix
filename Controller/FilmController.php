<?php


require_once("../Modele/Film.php");
class FilmController
{
    public static function getFilmById($id,$pdo)
    {
        $rq = "SELECT * FROM movies_full WHERE id_movie = :id";
        $requete = $pdo->prepare($rq);
        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetch();
        $film = new Film(
            intval($result['id_movie']),
            $result['title'],
            intval($result['year']),
            $result['genres'],
            $result['plot'],
            $result['directors'],
            $result['cast']
        );
        return $film;
    }
}
