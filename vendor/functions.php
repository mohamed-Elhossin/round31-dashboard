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



function auth()
{
    if (!$_SESSION['auth']) {
        header("location:login.php");
    }
}
