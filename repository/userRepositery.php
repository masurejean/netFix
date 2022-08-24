<?php
require_once("../inc/ConnectDB.php");

class UserRepository {
    
    public function insertUser($data){
        $pdo = new ConnectDB;
        var_dump($pdo->connect());

        $sql = "INSERT INTO user (login, pw, email, pref, role) VALUES (:login,:pw,:email,:pref,:role)";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(':login', $data->get_Login(), PDO::PARAM_STR);
        $query->bindValue(':pw', $data->get_Pw(), PDO::PARAM_STR);
        $query->bindValue(':email', $data->get_Email(), PDO::PARAM_STR);
        $query->bindValue(':pref', serialize($data->get_Pref()), PDO::PARAM_STR);
        $query->bindValue(':role', serialize($data->get_Role()), PDO::PARAM_STR);
        $query->execute();
    }

    public function selectOnBy($value,$table,$field,$select){
        
        $pdo = new ConnectDB;
        
        $sql ="SELECT $select FROM $table WHERE $field = :alias";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(':alias',$value, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch();

    }

    
}

?>