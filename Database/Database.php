<?php

include 'config.php';

function retrieveRecords($mysqli, $query)
{
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $rows = []; 
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row; 
        }
        return $rows; 
    } else {
        echo "No records found.";
        return []; 
    }
}

// $res = retrieveRecords($mysqli, "SELECT * FROM product_items");
?>