<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qty = 0;
    $specid = 0;
    $orderid = 0;
    $price = 0;
    foreach ($_POST as $key => $value) {
        if (preg_match('/^updated_id_(\d+)$/', $key, $matches)) {
            $product_id = $value;  
            $id = $matches[1];     
    
            $qty = $_POST["updated_qty_$id"];
            $specid = $_POST["updated_id_$id"];
            $orderid = $_POST["updated_order_id_$id"];
            $price = $_POST["updated_price_$id"];
            $processed_by = $_POST["updated_processed_by_$id"];
        }
    }
    
    if($processed_by != $_SESSION['USER_INFO']['user_id'])
    {
        header('Location: ../Pages/AdminListOfProcessedOrder.php?error_overlay=show&error_msg=Someone%20Processed%20This%20Order');
        exit();
    }

    include '../Database/Database.php';
    $current_stocks = retrieveRecords($mysqli, "SELECT product_items.quantity
    FROM order_items 
    JOIN product_items ON order_items.product_id = product_items.product_id 
    WHERE order_items.id = ".$specid);

    if($current_stocks[0]['quantity'] < $qty)
    {
        header('Location: ../Pages/AdminListOfProcessedOrder.php?error_overlay=show&error_msg=Insufficient%20Stocks');
        exit();
    }    

    $sql = "UPDATE order_items 
    SET quantity = ?, total_price = ?
    WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $total =  $qty * $price;
    $stmt->bind_param('did', $qty, $total, $specid );

    if ($stmt->execute()) {

        $updated_total = retrieveRecords($mysqli, "SELECT total_price FROM order_items WHERE
        order_id = ".$orderid);
        $total_amount = 0;

        foreach ($updated_total as $upd)
        {
            $total_amount += $upd['total_price'];
        }

        $sql = "UPDATE orders 
        SET total_amount = ?
        WHERE order_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('di', $total_amount, $orderid);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: ../Pages/AdminListOfProcessedOrder.php?success_overlay=show&success_msg=Row%20Updated%20Successfully');
            exit();
        } else {
        
        }


    } else {
    
    }
}
    
?>