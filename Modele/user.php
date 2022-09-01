
<?php
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {
    $pref = '../';
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getRepository("UserRepository"));
class User extends UserRepository
{
    public function __construct($email,$login,$pwd, $pref,$role)
    {
        $this->setEmail($email);
        $this->setLogin($login);
        $this->setPwd($pwd);
        $this->setPref($pref);
        $this->setRole($role);
    }
    // propriétés de ma class
    private $id_user;
    private $email;
    private $login;
    private $pwd;
    private $pref;
    private $role;
    // methodes (fonctions) de ma class
    /**
     * Fonction de verification de valeurs transmises à mes setters
     *
     * @param [type] $valeur // valeur transmise à mon setter
     * @param [string] $champ // nom du champ(colonne) de la table de ma BDD
     * @param [type] $propriete // propriété de la class effectée
     * @param [type] $type // type de la valeur acceptée : int,string,bool,array
     * @param [type] $empty // true = la valeur ne peut être null
     * @return void
     */
    public function controlSetter($valeur, $champ, $type, $empty)
    { // parametres de ma methode (fonction)
        if ($empty && !empty($valeur) && $empty !== "") {
            //je laisse pisser
            if ($type === "int" && is_int($valeur)) {
                return $valeur;
            } elseif ($type === "string" && is_string($valeur)) {
                return $valeur;
            } elseif ($type === "bool" && is_bool($valeur)) {
                return $valeur;
            } elseif ($type === "array" && is_array($valeur)) {
                return serialize($valeur);
            } else {
                throw new Exception("$champ doit êrte de type $type!");
            }
        } else {
            throw new Exception("$champ ne doit pas être vide!");
        }
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function setId_user($id_user){
        $this->controlSetter($id_user,"id_user",'int',true);
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $this->controlSetter($email,"email",'string',true);
    }
    public function getLogin(){
        return $this->login;
    }
    public function setLogin($login){
        $this->login = $this->controlSetter($login,"login",'string',true);
    }
    public function getPwd(){
        return $this->pwd;
    }
    public function setPwd($pwd){
        $this->pwd = $this->controlSetter($pwd,"pwd",'string',true);
    }
    public function getPref(){
        return unserialize($this->pref);
    }
    public function setPref($pref){
        $this->pref = $this->controlSetter($pref,"pref",'array',true);
    }
    public function getRole(){
        $role = unserialize($this->role);
        return $role;
    }
    public function setRole($role){
        $this->role = $this->controlSetter($role,"role",'array',true);
    }
}
