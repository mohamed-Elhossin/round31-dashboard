<?php

define('MAIN_URL', 'http://localhost/round31');

function base_url($var = null)
{
    return MAIN_URL . $var;
}



function redirect($var = null)
{
    header("location: http://localhost/round31/$var ");
}



function auth($rule_2 = null, $rule_3 = null)
{
    if (isset($_COOKIE['auth_user'])) {

        if (
            $_SESSION['auth']['rule_id'] == 1 || $_SESSION['auth']['rule_id'] == $rule_2
            || $_SESSION['auth']['rule_id'] == $rule_3
        ) {
        } else {
            redirect("error402.php");
        }
    } else {
        redirect('login.php');
    }
}


// Filter Validation

function filterValidtion($input)
{
    $input = ltrim($input);
    $input = rtrim($input);
    $input = strip_tags($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}


//string Vaildation


function stringValidation($input, $maxlen = 20, $minlen = 3)
{
    $isEmpty = empty($input);
    $isBiggerLen = strlen($input) > $maxlen;
    $isSmallLen = strlen($input) < $minlen;

    if ($isEmpty  || $isBiggerLen  ||  $isSmallLen) {
        return true;
    } else {
        return false;
    }
}

// Email Validation

function emailValidation($input,  $maxlen = 50, $minlen = 3)
{
    $isEmpty = empty($input);
    $isBiggerLen = strlen($input) > $maxlen;
    $isSmallLen = strlen($input) < $minlen;
    $isNotEmail = !filter_var($input, FILTER_VALIDATE_EMAIL);
    if ($isEmpty ||  $isBiggerLen || $isSmallLen || $isNotEmail) {
        return true;
    } else {
        return false;
    }
}



function numberVlidation($input)
{
    $isEmpty = empty($input);
    $isNotPostive = $input < 0;
    $isNotEmail = !filter_var($input, FILTER_VALIDATE_FLOAT);
    if ($isEmpty ||  $isNotPostive || $isNotEmail) {
        return true;
    } else {
        return false;
    }
}


function sizeFileVaildation($file_size, $you_size = 2)
{
    $migaSize = ($file_size / 1024) / 1024;
    $isBiiger = $migaSize > $you_size;

    if ($isBiiger) {
        return true;
    } else {
        return false;
    }
}
