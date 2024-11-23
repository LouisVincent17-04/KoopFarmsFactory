<?php
session_start();
include('../Database/Database.php');

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $queryString = $_SERVER['QUERY_STRING']; 

    parse_str($queryString, $params);

    $paramValues = array_values($params);

    $firstValue = isset($paramValues[0]) ? $paramValues[0] : null;
    $secondValue = isset($paramValues[1]) ? $paramValues[1] : null;

    $firstValue = base64_decode($firstValue);
    $secondValue = base64_decode($secondValue);

    
    if($firstValue == 0)
    header('Location:../Pages/AdminAccessManagement.php');

    elseif(count(retrieveRecords($mysqli, "SELECT * FROM admin WHERE user_id = ".$secondValue.";")) > 0)
    {
        
        $stmt = $mysqli->prepare("UPDATE admin SET shop_id = ? WHERE user_id = ?");

        $stmt->bind_param("ii", $firstValue, $secondValue);
    
        if ($stmt->execute()) {
            
            header('Location:../Pages/AdminAccessManagement.php?success_overlay=show&success_msg=Updated%20Successfully&shopid='.$firstValue);
            exit();
        } else {
            header('Location:../Pages/AdminAccessManagement.php?error_overlay=show&error_msg=Updated%20Successfully');
            exit();
        } 
    }
    else
    {
        $stmt = $mysqli->prepare("INSERT INTO admin (user_id, shop_id) VALUES (?, ?)");

        $stmt->bind_param("ii", $firstValue, $secondValue);
    
        if ($stmt->execute()) {
            header('Location:../Pages/AdminAccessManagement.php?success_overlay=show&success_msg=Added%20Successfully');
            exit();
        } else {
            header('Location:../Pages/AdminAccessManagement.php?error_overlay=show&error_msg=Added%20Successfully');
            exit();
        }
    }
}



if (isset($_POST['edit-btn'])) 
{
    $user_type = (int)$_POST['user_type'];
    $user_id = (int)$_POST['user_id'];

    $sql = "UPDATE users 
    SET user_type = ?, datetime_edited = NOW()
    WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii',$user_type, $user_id);

    if ($stmt->execute()) 
    {
        $sql = "UPDATE acc_management_privileges 
        SET modified_by = ?, datetime_updated = NOW()
        WHERE user_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii',$_SESSION['USER_INFO']['user_id'], $user_id);

        if ($stmt->execute()) 
        {
            echo "hello";
            header('Location: ../Pages/AdminAccessManagement.php?success_overlay=show&success_msg=Account%20Updated%20Successfully');
            $stmt->close();
            exit();
        }
        
    } else {
    
    }
}

?>
