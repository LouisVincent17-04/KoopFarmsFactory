<?php

    session_start();
    if(isset($_SESSION['USER_INFO']['user_id']))
    {
        if($_SESSION['USER_INFO']['user_id'] != 2 && isset($_GET['processed_by_filter']))
        {

            // $key = "041704"; // Secret key
            // $data = $_GET['processed_by_filter']; // Original data

            // // Encrypt
            // $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv = random_bytes(16));

            // // Decrypt
            // $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);
            // echo $encrypted; 
            // echo $decrypted;

            header('Location:../Pages/AdminListOfProcessedOrder.php?processed_by_filter='.$_GET['processed_by_filter']);    
        }
        else
        header('Location:../Pages/AdminListOfProcessedOrder.php');  

    }

?>