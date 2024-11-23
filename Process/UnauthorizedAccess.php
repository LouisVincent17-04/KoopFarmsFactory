<?php
session_start();
include('../Database/config.php');

if (isset($_SESSION['USER_INFO'])) 
{
    if($_SESSION['USER_INFO']['user_type'] != 2)
    {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    }
}
else
{
    header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
}

?>