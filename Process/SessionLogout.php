<?php
    session_start();
    session_destroy();

    header('Location: home.php?success_overlay=show&success_msg=Logged%20Out%20Due%20To%20Inactivity');
    exit();
?>
