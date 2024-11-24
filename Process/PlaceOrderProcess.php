<?php
session_start();
include '../Database/config.php';
include 'LogInFirst.php';
include 'CodeConversion.php';
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

$total_amount = 0;


$receipt_information = array();
$prod_info_arr = array();


if(isset($_SESSION['USER_INFO']))
{

    $stmt = $mysqli->prepare("SELECT users.full_name, users.phone_number, users.city_municipality, users.barangay, users.purok, 
    users.additional_info, product_items.product_id, product_items.product_name, product_items.price_per_unit, product_items.units_used, cart.quantity
    FROM cart
    JOIN users ON cart.user_id = users.user_id
    JOIN product_items ON cart.product_id = product_items.product_id
    WHERE cart.user_id = ?
    ORDER BY cart.cart_id");
    $stmt->bind_param("i", $_SESSION['USER_INFO']['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($items as $item) {
            $total_amount += ($item["quantity"] * $item['price_per_unit']);
            
            $prod_info_arr[] = array(
                'prod_name' => $item['product_name'],
                'total_price' => ($item["quantity"] * $item['price_per_unit']),
                'quantity' => $item['quantity'],
                'units' => $item['units_used']
            );
            
        }

    // IF THE USER DOES NOT HAVE ANY INFORMATION ABOUT HIS/HER DELIVERY INFO

    if(strlen($items[0]['purok']) < 2 && strlen($items[0]['barangay']) < 2 && strlen($items[0]['city_municipality']) < 2 &&
    strlen($items[0]['full_name']) < 2 && ($items[0]['phone_number']) < 11)
    {
        header('Location: EditAddress.php?error_msg=Fill%20Up%Delivery%Details&error_overlay=show');
        exit();
    }

    elseif(strlen($items[0]['purok']) < 2 && strlen($items[0]['barangay']) < 2 && strlen($items[0]['city_municipality']) < 2)
    {
        header('Location: ../Pages/EditAddress.php?error_msg=Address%20Incomplete&error_overlay=show');
        exit();
    }

    elseif(($items[0]['phone_number']) < 11)
    {
        header('Location: ../Pages/EditAddress.php?error_msg=Invalid%20Phone%20Number&error_overlay=show');
        exit();
    }
    elseif(strlen($items[0]['full_name']) < 2)
    {
        header('Location: ../Pages/EditAddress.php?error_msg=Name%20Not%20Set&error_overlay=show');
        exit();
    }
    else
    {
        $user_id = $_SESSION['USER_INFO']['user_id'];
        $order_status = 1;
        $payment_method = 1;
        $phone_number = $items[0]['phone_number'];
        $shipping_address = $items[0]['purok']." ".$items[0]['barangay']." ".$items[0]['city_municipality'];
        $billing_address = $items[0]['purok']." ".$items[0]['barangay']." ".$items[0]['city_municipality'];
        $shipping_cost = 50.00;
        $customer_notes = $items[0]['additional_info']; 
        $current_shop = 1;
    
    
        $sql = "INSERT INTO orders (user_id, shop_id, order_timedate, order_status, total_amount, payment_method, shipping_address,
        billing_address, shipping_cost, customer_notes) 
        VALUES (?,?, NOW(), ?,  ?, ?, ?, ?, ?, ?)";
        
        $stmt = $mysqli->prepare($sql);
    
    
        $stmt->bind_param("iiidissds", $user_id, $current_shop, $order_status, $total_amount, $payment_method,
        $shipping_address, $billing_address, $shipping_cost, $customer_notes);
    
        if ($stmt->execute()) {
            echo "Update Successful";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $ORDER_ID = 0;
        $PROD_ID = 0;
        $PROD_NAME = '';
        $QUANTITY = 0.00;
        $PRICE = 0.00;
        $TOTAL_PRICE = 0.00;
        $PLACED_ORDER_AT = '';
        $UNIT = '';
    
        $sql = "SELECT * FROM orders ORDER BY order_id DESC LIMIT 1"; 
    
        $result = $mysqli->query($sql);
    
        if ($result->num_rows > 0) {
            $row_data = $result->fetch_assoc();
            
            $ORDER_ID = (int)$row_data['order_id'];    
        } else {
            echo "No rows found.";
        }

        
    
        $receipt_information = array(
            'full_name' => $items[0]['full_name'],
            'payment_method' => convertPaymentMethod($payment_method),
            'shipping_address' => $shipping_address,
            'shipping_cost' => $shipping_cost,
            'order_id' => $ORDER_ID,
            'subtotal' => $total_amount,
            'net' => ($total_amount + $shipping_cost)
        );
    
    
        if(!isset($_SESSION['receipt_information']) &&(!isset($_SESSION['prod_info_arr'])))
        {
            $_SESSION['receipt_information'] = $receipt_information;
            $_SESSION['prod_info_arr'] = $prod_info_arr;
    
        }

        foreach ($items as $item_info) 
        {
            
            $PROD_ID =  $item_info['product_id'];
            $QUANTITY = $item_info['quantity'];
            $PRICE = $item_info['price_per_unit'];
            $TOTAL_PRICE = $item_info['price_per_unit'] * $item_info['quantity'];
            $UNIT = $item_info['unit_used'];  
            $USER = $_SESSION['USER_INFO']['user_id'];

            $sql = "INSERT INTO order_items (user_id, order_id, product_id, quantity, price, total_price, datetime_added) 
            VALUES (?,?,?,?,?,?,NOW())";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iiiddd",$USER, $ORDER_ID, $PROD_ID, $QUANTITY, $PRICE, $TOTAL_PRICE);
            $stmt->execute();
            
            $sql = "UPDATE product_items 
            SET quantity = quantity - ?
            WHERE product_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('di', $QUANTITY, $PROD_ID);
    
            if ($stmt->execute()) {
                $stmt->close();
            } else {
            
            }
        }
    }
}

    $url = '../Pages/Receipt.php?display_notif=1&notif_message=Thank%20you%20for%20Ordering!%20Expect%20a%20call%20from%20an%20agent%20to%20confirm%20your%20order';
    header('Location: '. $url);

    $stmt->close();
    $mysqli->close();
    exit();

?>



