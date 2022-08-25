<?php
class SessionController
{
    //public $session;
    public static function newSession($session, $userData)
    {
        $_SESSION['user']['id_user'] = $userData['id_user'];
        $_SESSION['user']['login'] = $userData['login'];
        $_SESSION['user']['email'] = $userData['email'];
        $_SESSION['user']['pref'] = $userData['pref'];
        $_SESSION['user']['role'] = $userData['role'];
    }
    public static function activeSession(){
        if(isset($_SESSION['user'])){
            return true;
        } else {
            return false;
        }
    }
}
