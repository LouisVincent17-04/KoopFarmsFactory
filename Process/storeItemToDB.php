<?php
    session_start();
    include '../Database/Database.php';
    include "LogInFirst.php";

    loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

    $product_id = $_POST['ITEM-ID'];
    $quantity = $_POST['QUANTITY-ID'];

    $cart_info = retrieveRecords($mysqli, "SELECT * FROM cart WHERE user_id = ".$_SESSION['USER_INFO']['user_id'].";");
    $stocks_available = retrieveRecords($mysqli, "SELECT product_name, quantity FROM product_items WHERE product_id = ".$product_id.";");

    if($stocks_available[0]['quantity'] < $quantity)
    header('Location:../Pages/Item.php?error_msg=Insufficient Stocks For '.$stocks_available[0]['product_name']);

    $count = 0;
    $should_insert = true;

    if(count($cart_info) > 0)
    {
        foreach($cart_info as $info)
        {
            if($product_id == $info['product_id'])
            {
                $updated_qty = $info['quantity'] + $quantity;
                $stmt = $mysqli->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
                $stmt->bind_param("dii", $updated_qty , $_SESSION['USER_INFO']['user_id'], $product_id);                
                $stmt->execute();
                $count++;
                $should_insert = false;
            }
            else
            {
                $count++;
            }
        }
        if($count == count($cart_info) && $should_insert)
        {
            $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id, quantity, datetime_added) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iid", $_SESSION['USER_INFO']['user_id'], $product_id, $quantity);            
            $stmt->execute();  
        }
    }
    else
    {
        $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id, quantity, datetime_added) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iid", $_SESSION['USER_INFO']['user_id'], $product_id, $quantity);            
        $stmt->execute();  
    }

    header('Location: ../Pages/Cart.php');

//     if($quantity > $retrieved_quantity)
//     {
//         $url = 'item.php?id_='.$product_id.'&error=Your%20Purchase%20Exceeds%20%20The%20Limit&error_overlay=show';
//         header('Location: '. $url);
//         exit();
//     }

//     $item_desc = $itemName;
//     $total_price = $totalPrice;
//     $item_price = $itemPrice;
//     $img_loc = $itemImg;

//     // item_desc total_price, unit, quantity
//     $sql = "SELECT user_id, product_id, quantity from cart WHERE user_id = ".$user.";";
//     if ($result = $mysqli->query($sql)) {
//         $cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     }

//     $itemCount = 0;

//     foreach($cart_items as $key => $cart)
//     {
//         ++$itemCount;
//     }



//     if($itemCount > 0)
//     {
//         foreach($cart_items as $item)
//         {       
//             if($item['product_id'] == $itemID)
//             {
//                 $updated_quantity = (double)$item['quantity'] + (double)$quantity;
                
//                 $stmt = $mysqli->prepare("UPDATE cart SET quantity = ?, datetime_added = NOW() WHERE product_id = ? AND user_id =".$_SESSION['USER_ID'].";");
//                 $stmt->bind_param("di", $updated_quantity, $product_id);
            
//                 if ($stmt->execute()) 
//                 {
//                     echo "Updated successfully";
//                 } else {
//                     echo "Error: " . $stmt->error;
//                 }
//                 echo "Line 76";
//                 header('Location:Cart.php');
//                 exit();
                
//             }
//             else
//             {
//                 $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id, quantity, datetime_added) VALUES (?, ?, ?, NOW())");
//                 $stmt->bind_param("iid", $user, $product_id, $quantity);
            
//                 if ($stmt->execute()) {
//                     echo "New record created successfully";
//                 } else {
//                     echo "Error: " . $stmt->error;
//                 }
//                 header('Location:Cart.php');
//                 echo "Line 91";
//                 exit();
                
//             }
//         }
//     }

//     else
//     {
//         $stmt = $mysqli->prepare("INSERT INTO cart (user_id, product_id, quantity, datetime_added) VALUES (?, ?, ?, NOW())");
//         $stmt->bind_param("iid", $user, $product_id, $quantity);
    
//         if ($stmt->execute()) {
//             echo "New record created successfully";
//         } else {
//             echo "Error: " . $stmt->error;
//         }
//     }

    

//     header('Location:Cart.php');
//     echo "Line 114 with item count of ".$itemCount." ".$user;
//     exit();
// ?>

