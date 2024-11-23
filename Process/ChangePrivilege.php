<?php
session_start();
include('../Database/config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = (int)$_POST['user_id'];
    $hidden_value = $_POST['hidden_value'];
    $hidden_access_value = $_POST['hidden_access_value'];
    $hidden_table_value = $_POST['hidden_table_value'];
    $final_access_value = '';

    $button_design_url = '';

    if($hidden_access_value == 'Denied')
    {
        $final_access_value = 'Granted';
    }
    elseif ($hidden_access_value == 'Granted')
    {
        $final_access_value = 'Denied';
    }

        $sql = "UPDATE $hidden_table_value 
        SET $hidden_value = ?
        WHERE admin_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('si', $final_access_value, $user_id);

        if ($stmt->execute()) {
            header('Location: AdminAccountsPrivileges.php?update_success=true');
            $stmt->close();
            exit();
            
        } else {
        
        }
    }
?>
