<?php
class FormVerif
{
    public function stripTagsArray($postArray)
    {
        foreach ($postArray as $key => $value) {
            $postArray[$key] = strip_tags($value);
        }
        return $postArray;
    }
    public function htmlCharsArray($postArray)
    {
        foreach ($postArray as $key => $value) {
            $postArray[$key] = htmlspecialchars($value);
        }
        return $postArray;
    }
    public function emptyField($value, $fieldName, $errors)
    {
        if (empty($value) || $value === "") {
            $errors[$fieldName] = "Le champ $fieldName est vide!";
        }
        return $errors;
    }
    public function verifEmail($value, $fieldName, $errors)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$fieldName] = "Le champ $fieldName n'est pas valide!";
        }
        return $errors;
    }
    public function identicField($value, $value2, $fieldName, $errors)
    {
        if ($value !== $value2) {
            $errors[$fieldName] = "Les champs $fieldName ne sont pas identiques!";
        }
        return $errors;
    }
    public function verifPwd($value, $fieldName, $errors)
    {
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/", $value)) {
            $errors[$fieldName] = "Le mot de passe doit comporter au moins une majuscule, un caractère spécial et entre 8 à 12 caractères!";
        }
        return $errors;
    }
    public function pwdHash($value){
        return password_hash($value,PASSWORD_ARGON2ID);
    }
}
