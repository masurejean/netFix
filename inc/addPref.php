<?php
    if(isset($_GET['id_movie']) && !empty($_GET['id_movie'])){
        $id_movie = strip_tags(isset($_GET['id_movie']));
        require_once ("../Controller/UserController.php");
        UserController::addPref($id_movie,$id_user);
     }