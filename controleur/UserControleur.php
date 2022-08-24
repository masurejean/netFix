<?php

require_once("../Modele/user.php");
require_once("../controleur/FromVerif.php");
require_once("../repository/userRepositery.php");
require_once("../controleur/ControlerSession.php");

class UserController extends FormVerif
{
    public $errors = [];
    public $post;
    public $session =[];


    public function verifOneExist($value, $name, $errors)
    {
        $userRepository = new UserRepository();
        $result = $userRepository->selectOnBy($value, 'user', $name, $name);
        if (is_array($result)) {
            $errors[$name] = "cet $name est  deja dans la base";
        }
        return $errors;
    }

    public function login($post)
    {
        $userRepository = new UserRepository();
        if (isset($post['submited']) && !empty($post['submited'])) {
            echo "j ai bien recu les données de mon  formulaire!";
            $post = $this->stripTagsArray($post);

            $this -> errors = $this->emptyFied($post['login'], 'login', $this->errors);
            $this -> errors = $this->emptyFied($post['pwd'], 'pwd', $this->errors);

            $resultLogin = $userRepository->selectOnBy($post['login'],'user','login','pw');
            $resultmail = $userRepository->selectOnBy($post['login'],'user','email','pw');
            
            

            $this->errors['password'] ="";


            if(is_array($resultLogin) && password_verify($post['pwd'],$resultLogin['pw'])){
                var_dump("password ok");
                $session =[];
                if(count($this->errors)=== 0){
                    SessionController::newSession($session,['essse']);
                }

            }elseif(is_array($resultmail) && password_verify($post['pwd'],$resultmail['pw'])){
                var_dump("password ok");
            }else
            {
                $this->errors['password'] = " password fail";
            }
            var_dump($this->errors['password']);
            return $this->errors;




            
        }
    }

    public function register($post)
    {
        if (isset($post['submited']) && !empty($post['submited'])) {
            echo "j ai bien recu les données de mon  formulaire!";
            $post = $this->stripTagsArray($post);

            $this -> errors = $this->emptyFied($post['login'], 'login', $this->errors);
            $this -> errors = $this->emptyFied($post['email'], 'email', $this->errors);
            $this -> errors = $this->emptyFied($post['pwd'], 'pwd', $this->errors);
            $this -> errors = $this->emptyFied($post['confirmPwd'], 'confirmPwd', $this->errors);
            $this -> errors = $this->verifMail($post['email'], 'email', $this->errors);
            $this -> errors = $this->identicFiel($post['pwd'], $post['confirmPwd'], 'pwd', $this->errors);
            $this -> errors = $this->verifPwd($post['pwd'], 'pwd', $this->errors);
            $this-> errors = $this->verifOneExist($post['email'], 'email', $this->errors);
            $this-> errors = $this->verifOneExist($post['login'], 'login', $this->errors);
            if (count($this-> errors)=== 0) {
                //validation
                $post['pref']=[''];
                $post['role']=['ROLE_USER'];
                $post['pwd'] = $this -> pwdHash($post['pwd']);



                $user = new User($post['email'], $post['login'], $post['pwd'], $post['pref'], $post['role']);

                var_dump($user->get_Role());
                var_dump($user);

                $user->insertUser($user);
            }
        }
    }
}
