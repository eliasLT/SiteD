<?php
function getSessionKey($id, $username){
    return generateRandomString(8);
}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function passwordIsOK($password){
    if (strlen($password) == 0) return 'Entrez un mot de passe !' ;
    if (strlen($password) < 5) return '5 caractères sont requis !' ;   
#   VERIFICATION----------
    if ( ! preg_match("~^[\w]+$~", $password) ) return "Uniquement des lettres ou des chiffres !" ;    
    if ( ! preg_match("~[A-Z]~", $password) ) return "Au moins une Majuscule !" ;
    if ( ! preg_match("~[0-9]~", $password) ) return "Au moins un chiffre !" ;
#   OK----------
    return ' ';
}




?>