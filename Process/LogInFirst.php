<?php

    function loginAccFirst($msg)
    {
        if(!isset($_SESSION['USER_INFO']))
        {
            header('Location: Login.php?'.$msg);
            exit();
        }
    }

    function homeLogOut()
    {
        if(!isset($_SESSION['USER_INFO']))
        {
            $_SESSION = array();

            session_destroy();

           
        }
    }

?>