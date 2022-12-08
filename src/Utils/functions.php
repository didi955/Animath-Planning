<?php

/**
 * Méthode échappant les caractères html dans $message
 * @param string $message chaîne à échapper
 * @return string chaîne échappée
 */
function e($message)
{
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
