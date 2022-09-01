<?php
require_once("../inc/ConnectDB.php");
// les class repository seront les class utilisées pour passer nos requetes
class UserRepository
{

    public function insertUser($data)
    {
        $pdo = new ConnectDB;
        $sql = "INSERT INTO user (login, pwd, email, pref, role) VALUES (:login,:pwd,:email,:pref,:role)";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(':login', $data->getLogin(), PDO::PARAM_STR);
        $query->bindValue(':pwd', $data->getPwd(), PDO::PARAM_STR);
        $query->bindValue(':email', $data->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':pref', serialize($data->getPref()), PDO::PARAM_STR);
        $query->bindValue(':role', serialize($data->getRole()), PDO::PARAM_STR);
        $query->execute();
    }
    public function selectOneBy($value,$table,$field,$select)
    {
        $pdo = new ConnectDB;
        $sql = "SELECT $select FROM $table WHERE $field = :alias";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(':alias', $value, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch();
    }

    public function insertPref($id_user , $genre)
    {
        $pdo =new ConnectDB;
        $sql ="INSERT INTO user (pref) VALUES (:pref) WHERE id_user = :id_user";
        $query = $pdo -> connect() ->prepare($sql);
        $query->bindValue(":id_user" ,$id_user,PDO::PARAM_STR);
        $query->bindValue(':pref', $genre, PDO::PARAM_STR);
        $query->execute();

    }

    
}
