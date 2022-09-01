<?php
class RouteController {
    public function __construct($server){
        // pour passer des parametres à une class je doit impérativement utiliser
        // une fonction __construct($param1,$param2,etc...)
        $this->server = $server;
        if( $server['PHP_SELF'] === '/POO/netflix/index.php'){
            $this->workDir = ".";
        } else {$this->workDir = '..';}
    }
    private $server;
    // remplacez si besoin les $viewDir, $controlDir, etc
    // en fonction de vos noms de dossier
    private $workDir;//nom de vos dossiers dans /wamp64/www
    private $viewDir = "/View/";
    private $controlDir = "/Controller/";
    private $modeleDir = "/Modele/";
    private $repositoryDir = "/repository/";
    private $incDir = "/inc/";
    private $ext = ".php";

    public function getRoute($route){
        if($route === "index"){
            return $this->workDir;
        } else {
            return $this->workDir.$this->viewDir.$route.$this->ext;
        }
    }
    public function getController($route){
        return $this->workDir.$this->controlDir.$route.$this->ext;
    }
    public function getModele($route){
        return $this->workDir.$this->modeleDir.$route.$this->ext;
    }
    public function getRepository($route){
        return $this->workDir.$this->repositoryDir.$route.$this->ext;
    }
    public function getInc($route){
        return $this->workDir.$this->incDir.$route.$this->ext;
    }
    public function getAssets(){
        return $this->workDir.'/assets/';
    }
}