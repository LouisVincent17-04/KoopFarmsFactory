<?php
include "../Database/config.php";
session_start();
include "LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');


$labelAs = $_POST['labelAs'];
$fullName = $_POST['fullName'];
$phoneNumber = $_POST['phoneNumber'];
$municipalityOrCity = $_POST['municipalityOrCity'];
$barangayValue = $_POST['barangayValue'];
$purokOrSitio = $_POST['purokOrSitio'];
$additionalInfo = $_POST['additionalInfo'];

if(strlen($phoneNumber) < 11)
{
    header('Location: ../Pages/EditAddress.php?error_overlay=show&error_message=Invalid%20Number%20Format');
    exit();
}

if($labelAs == '' || $fullName == '' || $phoneNumber == '' || $municipalityOrCity == '' || $barangayValue == '' || $purokOrSitio == '')
{
    header('Location: ../Pages/EditAddress.php?error_overlay=show&error_message=Please%20Fill%20In%20All%20The%20Required%20Fields&labelAs='.$labelAs.'&fullName='.$fullName.
    '&phoneNumber='.$phoneNumber.'&municipalityOrCity='.$municipalityOrCity.'&barangayValue='.$barangayValue.'&purokOrSitio='.$purokOrSitio.'&additionalInfo='.$additionalInfo);
    exit();
} 

$sql = "UPDATE users SET 
        full_name = ?, 
        phone_number = ?, 
        city_municipality = ?, 
        barangay = ?, 
        purok = ?, 
        additional_info = ?, 
        address_label = ?, 
        datetime_edited = NOW() 
        WHERE user_id = ?";

$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($mysqli->error));
}

$stmt->bind_param("sssssssi", $fullName, $phoneNumber, $municipalityOrCity, $barangayValue, $purokOrSitio, $additionalInfo, $labelAs, $_SESSION['USER_INFO']['user_id']);

if ($stmt->execute()) {
    if(!isset($_SESSION['ORDER_INFO']))
    {
        $_SESSION['ORDER_INFO'] = 'Visited';
        
    }
    header('Location: ../Pages/OrderInfo.php?success_overlay=show');
    exit();

} else {
    header('Location: ../Pages/OrderInfo.php?error_overlay=show');
}

$stmt->close();
$mysqli->close();
?>
