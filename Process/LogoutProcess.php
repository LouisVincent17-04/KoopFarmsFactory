<?php
    session_start();
    session_destroy();

    header('Location: ../Pages/home.php?success_overlay=show&success_msg=Logged%20Out%20Successfully');
    exit();
?>

