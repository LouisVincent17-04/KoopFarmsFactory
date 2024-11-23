<?php
session_start();
include("../Database/config.php");

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $query = htmlspecialchars($query); 

    if(strlen($query) >= 1 ) {
        $sql = "SELECT category_id, description, imagename FROM product_categories WHERE description LIKE ? AND id > 1 ORDER BY category_id";
        $stmt = $mysqli->prepare($sql);
        $searchTerm = "%$query%";
        $stmt->bind_param("s", $searchTerm);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $products = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($products);
        } else {
            echo json_encode([]);
        }
    } else {
        
        $sql = "SELECT category_id, description, imagename FROM product_categories WHERE id > 1 ORDER BY category_id";
        $stmt = $mysqli->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $products = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($products);
        } else {
            echo json_encode([]);
        }
    }
}
?>

