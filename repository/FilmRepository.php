<?php

require_once("../inc/ConnectDB.php");

class FilmRepository
{
    public static function getFilm()
    {
        $pdo = new ConnectDB;
        $sql = "SELECT * FROM movies_full ORDER BY RAND() LIMIT 10";
        $requete = $pdo->connect() ->prepare($sql);
        //$requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetchall();
        
        return $result;
    }
}
