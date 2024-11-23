<?php
$inactivity_limit = 6000; 


if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $inactivity_limit) {
        include 'SessionLogout.php';
    }
}   

$_SESSION['last_activity'] = time();    

?>