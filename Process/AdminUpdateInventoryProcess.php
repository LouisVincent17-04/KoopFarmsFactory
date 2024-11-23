<?php
session_start();
include('../Database/config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($_POST as $key => $value) {
        if (preg_match('/^shop_user_id_(\d+)$/', $key, $matches)) {

            $id = $matches[1];     
            $shop_id = $_POST["selected_option_$id"];
            echo $id." -> ".$shop_id;
            exit();
        }
    }
    
    

    if(isset($_POST['edit-btn']))
    {
        $sql = "UPDATE product_items 
        SET product_name = ?, price_per_unit = ?, quantity = ?, category_id = ?, datetime_edited = NOW(), modified_by = ? 
        WHERE product_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('sddiii',$product_name, $product_price , $quantity, $product_category, $user, $product_id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: ../Pages/AdminUpdateInventory.php?success_overlay=show&success_msg=Updated%20Successfully');
            exit();
        } else {
        
        }
    }

    if(isset($_POST['del-btn']))
    {
        $sql = "DELETE FROM product_items 
        WHERE product_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $product_id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: ../Pages/AdminUpdateInventory.php?success_overlay=show&success_msg=Deleted%20Successfully');
            exit();
        } else {
        
        }
    }


}
?>
