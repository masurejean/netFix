<?php

require_once("../repository/userRepositery.php");

class User extends UserRepository
{
    public function __construct($email, $login, $pw, $pref, $role)
    {
        $this->set_Email($email);
        $this->set_Login($login);
        $this->set_pw($pw);
        $this->set_pref($pref);
        $this->set_Role($role);
    }
    private $id_user;
    private $email;
    private $login;
    private $pw;
    private $pref;
    private $role;
    /**
     * fonction de verification des valeurs transmises  a mes setter
     *
     * @param [type] $valeur
     * @param [type] $champ
     * @param [type] $propriete
     * @param [type] $type
     * @param [type] $empty
     * @return void
     */
    public function verifControleSetter($valeur, $champ,  $type, $empty)
    {
        if ($empty && !empty($valeur) && $empty !== "") {
            /* */
            if ($type ==="int"  && is_int($valeur)) {
                return $valeur;
            } elseif ($type === "string" && is_string($valeur)) {
                return $valeur;
            } elseif ($type === "bool" && is_bool($valeur)) {
                return $valeur;
            } elseif ($type === "array" && is_array($valeur)) {
                return serialize($valeur);
            }
            else {
                throw new Exception("$champ doit etre de type $type!");
            }
        } else {
            throw new Exception("$champ ne doit pas etre vide");
        }
    }
    public function get_Id_User()
    {
        return $this->id_user;
    }
   public function set_Id_User($id_user)
   {
       $this->verifControleSetter($id_user, "id_user",  'int', true);
   }

    public function get_Email()
    {
        return $this->email;
    }
    public function set_Email($email)
    {   
        $this->email = $this->verifControleSetter($email, "email",  'string', true);
    }
    public function get_Login()
    {
        return $this->login;
    }
    public function set_Login($login)
    {
        $this->login = $this->verifControleSetter($login, "login",  'string', true);

    }

    public function get_Pw()
    {
        return $this->pw;
    }
    public function set_Pw($pw)
    {
        $this->pw = $this->verifControleSetter($pw, "pw",  'string', true);
    }
    public function get_Pref()
    {
        return [$this->pref];
    }
    public function set_Pref($pref)
    {
        $this->pref = $this->verifControleSetter($pref, "pref",  'array', true);
    }
    public function get_Role()
    {
        return [$this->role];
    }
    public function set_Role($role)
    {
        $this->role = $this->verifControleSetter($role, "role",  'array', true);
    }
}
