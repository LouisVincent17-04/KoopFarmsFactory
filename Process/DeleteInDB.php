<?php
session_start();
include "LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

    function deleteRowInCart($id) {

        include('../Database/config.php');

        $stmt = $mysqli->prepare("DELETE FROM cart WHERE cart_id = ?;");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $mysqli->error);
        }
    
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $url = '../Pages/Cart.php';
        header('Location: '. $url);
    
        $stmt->close();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        deleteRowInCart($id);
    }

    $conn->close();


?>