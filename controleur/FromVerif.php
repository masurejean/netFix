<?php

class FormVerif{

    public function stripTagsArray($postArray){
        foreach ($postArray as $key => $value) {
            $postArray[$key] = strip_tags($value);
            # code...
        }
        return $postArray;
    }
    public function htmlCharsArray($postArray){
        foreach ($postArray as $key => $value) {
            $postArray[$key] = htmlspecialchars($value);
            # code...
        }
        return $postArray;
    }
    public function emptyFied($value,$fieldName, $errors){

        if(empty($value) || $value ==="" ){

            $errors[$fieldName]="le champ $fieldName est vides!";
        }
            return $errors;
    }

    public function verifMail($email,$fieldName,$errors){

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                
                $errors[$fieldName]="le champ $fieldName est incorect!";
            }
            return $errors;
    }

    public function identicFiel($value,$value2,$fieldName, $errors){

        if($value !== $value2){
            $errors[$fieldName]="les champs $fieldName ne sont pas  indentique!";
        }
        return $errors;
    }

    public function verifPwd($value,$fieldName, $errors)
    {
        $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/";
        if(!preg_match($pattern,$value)){
            $errors[$fieldName]="le champ $fieldName est n est pas  au bon format!   au moins 8  carracteres  ";
        }
        return $errors;
    }

    public function pwdHash($value){
        return password_hash($value,PASSWORD_ARGON2ID);
    }

    }
