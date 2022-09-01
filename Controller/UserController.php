<?php
require_once("../Modele/User.php");
require_once("../Controller/FormVerif.php");
require_once("../repository/UserRepository.php");
require_once("../Controller/SessionController.php");
require_once("../Controller/RouteController.php");
class UserController extends FormVerif
{
    public $errors = [];
    public $post;
    public function verifOneExist($value,$name,$errors){
        $userRepository = new UserRepository;
        $result = $userRepository->selectOneBy($value,'user',$name,$name);
        if(is_array($result)){
            $errors[$name] = "Cet $name existe déjà!";
        }
        return $errors;
    }
    public function verifLogin($valueLogin,$valuePwd,$errors){
        $userRepository = new UserRepository;
        $resultLogin = $userRepository->selectOneBy($valueLogin,'user','login','login,pwd');
        $resultEmail = $userRepository->selectOneBy($valueLogin,'user','email','email,pwd');
        if(is_array($resultLogin) || is_array($resultEmail)){
            if(is_array($resultLogin)){
                $pwd = $resultLogin['pwd'];
            }
            elseif (is_array($resultEmail)){
                $pwd = $resultEmail['pwd'];
            }
            if(password_verify($valuePwd,$pwd)){
                echo "vous êtes maintenant connectés";
            } else {
                $errors['pwd'] = "Le mot de passe esr incorrect!";
            }
        } else {
            $errors['login'] = "Votre identifiant est incorrect!";
        }
        return $errors;
    }
    public function register($post)
    {
        if (isset($post['submited']) && !empty($post['submited'])) {
            // toutes les methodes utilisées ici viennent de l'heritage de la class FormVerif
            // et pourront être réutilisées dans n'importe quel controller de formulaire
            $post = $this->stripTagsArray($post);
            $this->errors = $this->emptyField( $post['login'],'login',$this->errors);
            $this->errors = $this->emptyField( $post['email'],'email',$this->errors);
            $this->errors = $this->emptyField( $post['pwd'],'pwd',$this->errors);
            $this->errors = $this->emptyField( $post['confirmPwd'],'confirmPwd',$this->errors);
            $this->errors = $this->verifEmail( $post['email'],'email',$this->errors);
            $this->errors = $this->identicField( $post['pwd'],$post['confirmPwd'],'pwd',$this->errors);
            //$this->errors = $this->verifPwd( $post['pwd'],'pwd',$this->errors);
            $this->errors = $this->verifOneExist($post['email'],'email',$this->errors);
            $this->errors = $this->verifOneExist($post['login'],'login',$this->errors);
            if(count($this->errors) === 0){
                // les données de mon formulaire sont valide je peux implémenter un nouveau User
                // et l'insert dans ma base
                $post['pref'] = ['void'];
                $post['role'] = ['ROLE_USER'];
                $post['pwd'] = $this->pwdHash($post['pwd']);
                $user = new User($post['email'],$post['login'],$post['pwd'],$post['pref'],$post['role']);
                // insert
                $user->insertUser($user);
                $userRepository = new UserRepository;
                $data = $userRepository->selectOneBy($post['login'],'user','login','*');
                SessionController::newSession([],$data);
                $routeController = new RouteController($_SERVER);
                header("Location: ".$routeController->getRoute("index"));
            }
            
        }
    }
    public function login($post,$session){
        if (isset($post['submited']) && !empty($post['submited'])) {
            $post = $this->stripTagsArray($post);
            $this->errors = $this->emptyField( $post['login'],'login',$this->errors);
            $this->errors = $this->emptyField( $post['pwd'],'pwd',$this->errors);
            $this->errors = $this->verifLogin($post['login'],$post['pwd'],$this->errors);
            
            if(count($this->errors) === 0){
                $userRepository = new UserRepository;
                $data1 = $userRepository->selectOneBy($post['login'],'user','login','*');
                $data2 = $userRepository->selectOneBy($post['login'],'user','email','*');
                if(is_array($data1)){
                    $data = $data1;
                }
                if(is_array($data2)){
                    $data = $data2;
                }
                SessionController::newSession($session,$data);
                $routeController = new RouteController($_SERVER);
                header("Location: ".$routeController->getRoute("index"));
            }
        }
    }
    public static function addPref($id_movie){
        $userRepository = new UserRepository;
        $id_user = $_SESSION['user']['id_user'];
        $current_pref = unserialize($_SESSION['user']['pref']);
        if($current_pref[0]==="void"){
            $current_pref = [];  
        }
        array_push($current_pref,$id_movie);
        $userRepository->insertPref($id_user,serialize($current_pref));

    }
}
