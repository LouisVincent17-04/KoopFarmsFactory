<?php
session_start();
include '../Database/config.php'; 
include 'UserInactivity.php';

include "LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $order_status = (int)$_POST['order_stat'];
    $order_id = (int)$_POST['order_id'];
    $change_status ='';

    if(isset($_POST['processed']) && $_POST['processed'] != $_SESSION['USER_INFO']['user_id'])
    {
        header('Location:../Pages/AdminListOfProcessedOrder.php?error_overlay=show&error_msg=Someone%20Processed%20This%20Order');
        exit();
    }

    if($order_status == 1)
    $change_status = 2;
    else if($order_status == 2)
    $change_status = 3;
    else if($order_status == 3)
    $change_status = 4;

    if(isset($_POST['del-btn']))
    {
        if($order_status == 1)
        {
            $change_status = 0;

            $sql = "UPDATE orders 
            SET order_status = ?, processed_by = ?
            WHERE order_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('iii', $change_status, $_SESSION['USER_INFO']['user_id'], $order_id);
    
            if ($stmt->execute() && $change_status == 0)
            {
                header('Location: ../Pages/AdminListOfProcessedOrder.php?success_overlay=show&success_msg=Row%20Deleted%20Successfully');
                $stmt->close();
                exit();
            }
        }
    }

    if(isset($_POST['edit-btn']))
    {
        $sql = "UPDATE orders 
        SET order_status = ?, processed_by = ?
        WHERE order_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('iii', $change_status, $_SESSION['USER_INFO']['user_id'], $order_id);

        if ($stmt->execute() && $change_status == 2)
        {
            header('Location: ../Pages/AdminListOfProcessedOrder.php?success_overlay=show&success_msg=Row%20Updated%20Successfully');
            $stmt->close();
            exit();
        }

        else if ($stmt->execute() && $change_status == 3)
        {
            header('Location: ../Pages/AdminListOfForDelivery.php?success_overlay=show&success_msg=Row%20Updated%20Successfully');
            $stmt->close();
            exit();
        }
        
        else if ($stmt->execute() && $change_status == 4)
        {
            header('Location: ../Pages/AdminListOfDelivered.php?success_overlay=show&success_msg=Row%20Updated%20Successfully');
            $stmt->close();
            exit();
        }
            
       
    }

    if($order_status == 2)
    $undo_status = 1;
    else if($order_status == 3)
    $undo_status = 2;
    else if($order_status == 4)
    $undo_status = 3;

    if(isset($_POST['undo-btn']))
    {
        $sql = "UPDATE orders 
        SET order_status = ?, processed_by = ?
        WHERE order_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('iii',$undo_status, $_SESSION['USER_INFO']['user_id'],  $order_id);

        if ($stmt->execute() && $undo_status == 1)
        {
            header('Location: ../Pages/AdminListOfPendingOrders.php?success_overlay=show&success_msg=Row%20Deleted%20Successfully');
            $stmt->close();
            exit();
        }

        else if ($stmt->execute() && $undo_status == 2)
        {
            header('Location: ../Pages/AdminListOfProcessedOrder.php?success_overlay=show&success_msg=Row%20Deleted%20Successfully');
            $stmt->close();
            exit();
        }

        else if ($stmt->execute() && $undo_status == 3)
        {
            header('Location: ../Pages/AdminListOfForDelivery.php?success_overlay=show&success_msg=Row%20Deleted%20Successfully');
            $stmt->close();
            exit();
        }
    }
}
?>
