<?php

require_once("../Modele/user.php");
require_once("../controleur/FromVerif.php");
require_once("../repository/userRepositery.php");

class UserController extends FormVerif
{
    public function __construct($post)
    {
        $this->post =  $post;
        $this->register($post);
    }




    public $errors = [];
    public $post;


    public function verifOneExist($value,$name,$error){

        $userRepository = new UserRepository;
        $result = $userRepository->selectOnBy($value,'user','$name');
        if(count($result)>0){
            $errors[$name] = "cet email est  deja dans la base";
        }
        return $errors;
        var_dump($result);
        die;

    }

    public function register($post)
    {
        if (isset($post['submited']) && !empty($post['submited'])) {
            echo "j ai bien recu les données de mon  formulaire!";
            $post = $this->stripTagsArray($post);

            $this -> errors = $this->emptyFied($post['login'],'login',$this->errors);
            $this -> errors = $this->emptyFied($post['email'],'email',$this->errors);
            $this -> errors = $this->emptyFied($post['pwd'],'pwd',$this->errors);
            $this -> errors = $this->emptyFied($post['confirmPwd'],'confirmPwd',$this->errors);
            $this -> errors = $this->verifMail($post['email'],'email',$this->errors);
            $this -> errors = $this->identicFiel($post['pwd'],$post['confirmPwd'],'pwd',$this->errors);
            $this -> errors = $this->verifPwd($post['pwd'],'pwd',$this->errors);
            $this-> errors = $this->verifOneExist($post['email'],'email',$this->errors);
            $this-> errors = $this->verifOneExist($post['login'],'login',$this->errors);
            if(count($this-> errors )=== 0){

                //validation
                $post['pref']=[''];
                $post['role']=['ROLE_USER'];
                $post['pwd'] = $this -> pwdHash($post['pwd']);



                $user = new User($post['email'],$post['login'],$post['pwd'],$post['pref'],$post['role']);

                var_dump($user->get_Role());
                var_dump($user);
                
                $user->insertUser($user);
                

            }
            
        }
    }


}
