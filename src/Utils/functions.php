<?php

/**
 * Fonction échappant les caractères html dans $message
 * @param string $message chaîne à échapper
 * @return string chaîne échappée
 */
function e($message)
{
    return htmlspecialchars($message, ENT_QUOTES);
}

function encrypt_pass(string $pass)
{
    return password_hash($pass, PASSWORD_ARGON2ID);
}
