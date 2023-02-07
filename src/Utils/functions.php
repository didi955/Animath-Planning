<?php

/**
 * Méthode échappant les caractères html dans $message
 * @param string $message chaîne à échapper
 * @return string chaîne échappée
 */
function e($message)
{
    if($message === null)
        return htmlspecialchars("NULL", ENT_QUOTES);
    return htmlspecialchars($message, ENT_QUOTES);
}

/**
 * Méthode permettant de hasher un mot de passe avec l'algorithme ARGON2ID
 * @param string $pass mot de passe à hasher
 * @return string chaîne hashée
 */
function hash_pass(string $pass)
{
    return password_hash($pass, PASSWORD_ARGON2ID);
}

function is_valid_email(string $email)
{
    if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", strtolower($email))){
        return true;
    }
    return false;
}

function is_valid_name(string $name)
{
    if(preg_match("/^([a-zA-Z]+)$/", strtolower($name))){
        return true;
    }
    return false;
}


function is_valid_phone(string $phone)
{
    if(preg_match("/^((\+)33|0)[1-9](\d{2}){4}$/", $phone)){
        return true;
    }
    return false;
}

function parseDate(string $date){
    $tab = explode(":",$date);
    $res = [];
    foreach ($tab as $i){
        $res[] = (int)$i;
    }
    return $res;
}

function getJson($file){
    return json_decode(file_get_contents($file), true);
}
