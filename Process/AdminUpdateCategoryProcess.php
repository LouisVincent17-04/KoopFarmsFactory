<?php
session_start();
include('../Database/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_SESSION['USER_INFO']['user_id']; 
    
    foreach ($_POST as $key => $value) {
        if (preg_match('/^category_id_(\d+)$/', $key, $matches)) {
            $category_id = $value;  
            $id = $matches[1];     
    
            $category_name = $_POST["category_name_$id"];
    
        }
    }

    if(isset($_POST['edit-btn']))
    {
        $sql = "UPDATE product_categories 
        SET category_name = ?, modified_by = ?, datetime_edited = NOW() 
        WHERE category_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('sii',$category_name, $user, $category_id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: ../Pages/AdminUpdateCategory.php?success_overlay=show&success_msg=Updated%20Successfully');
            exit();
        } else {
        
        }
    }
}
?>
