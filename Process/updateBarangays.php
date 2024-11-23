<?php
session_start();
include "../Database/config.php";
include "LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

$currBarangay = $_SESSION['USER_INFO']['barangay'];
              

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'get_barangays') {
    if (isset($_POST['municipality_name'])) {
        $municipality_name = $mysqli->real_escape_string($_POST['municipality_name']);
        $sql = "SELECT barangays.barangay_id, barangays.barangay_name, city_municipality.place 
        FROM barangays 
        JOIN city_municipality ON barangays.city_municipality_id = city_municipality.id
        WHERE city_municipality.place  = '".$municipality_name."'";
        $result = $mysqli->query($sql);

        if ($result) {
            foreach ($result as $value) {
                echo "<option value='".$value["barangay_name"]."'";
                
                if ($value["barangay_name"] == $currBarangay) {
                    echo " selected";
                }
                
                echo ">".$value["barangay_name"]."</option>";
            }
        } else {
            echo "<option>Error: " . $mysqli->error . "</option>";
        }
        $result->free();
    }
    exit;
}
?>
