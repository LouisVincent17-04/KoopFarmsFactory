<?php
include("../Database/config.php");
session_start();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // if($_SESSION['LOGGED_OUT'] == 0)
            // {
            //     $get_sql = "SELECT * FROM users WHERE username ='".$_SESSION['username_input']."'";

            //     $result = $mysqli->query($sql);


            //     if ($result->num_rows > 0) {
            //         $row = $result->fetch_assoc();

            //         if(strlen($row['full_name']) > 1 && strlen($row['phone_number']) > 1 && strlen($row['city_municipality']) >= 1)
            //         {

            //         }
            //         else
            //         {
            //             $radioValue = htmlspecialchars($_POST['labelAs']);
            //             $fullName = htmlspecialchars($_POST['fullName']);
            //             $phoneNo = htmlspecialchars($_POST['phoneNumber']);
            //             $municipality_or_city = htmlspecialchars($_POST['municipalityOrCity']);
            //             $barangay = htmlspecialchars($_POST['barangayValue']);
            //             $purok_or_sitio = htmlspecialchars($_POST['purokOrSitio']);
            //             $additional_info = htmlspecialchars($_POST['additionalInfo']);
            
            //             if($radioValue == '' || $fullName == '' || $phoneNo == '' || $municipality_or_city == '' || $barangay == '' || $purok_or_sitio == '')
            //             {
            //                 header('Location: EditAddress.php?error_overlay=show');
            //                 exit();
            //             } 
            
            //             else
            //             {
            //                 $sql = "UPDATE users 
            //                     SET full_name = ?, phone_number = ?, city_municipality = ?, barangay = ?, purok = ?, additional_info = ?, address_label = ?, updated_at = NOW() 
            //                     WHERE username = ?";
            
            //                 $stmt = $mysqli->prepare($sql);
            
            //                 if ($stmt === false) 
            //                     echo "Error: " . $mysqli->error;
            //                  else {
            //                     $stmt->bind_param("ssssssss", $fullName, $phoneNo, $municipality_or_city, $barangay, $purok_or_sitio, $additional_info, $radioValue, $_SESSION['username_input']);
            
            //                     if ($stmt->execute()) {
        
            //                         echo "<h1>The value of the label is: " . $radioValue . "</h1>";
            //                         echo "<h1>The value of the full name is: " . $fullName . "</h1>";
            //                         echo "<h1>The value of the phone number is: " . $phoneNo . "</h1>";
            //                         echo "<h1>The value of the city/municipality is: " . $municipality_or_city . "</h1>";
            //                         echo "<h1>The value of the barangay is: " . $barangay . "</h1>";
            //                         echo "<h1>The value of the purok/sitio is: " . $purok_or_sitio . "</h1>";
            //                         echo "<h1>The value of the additional info is: " . $additional_info . "</h1>";
            
            //                         header('Location: OrderInfo.php?update_with_acc_success');
            //                         exit();
            //                     } else {
            //                         echo "Error: " . $stmt->error;
            //                     }
            
            //                     $stmt->close();
            //                 }
            //             }
            //         }

            //     }

                
            // }
            // else 
            if(!isset($_SESSION['username_input']))
            {
                $radioValue = htmlspecialchars($_POST['labelAs']);
                $fullName = htmlspecialchars($_POST['fullName']);
                $phoneNo = htmlspecialchars($_POST['phoneNumber']);
                $municipality_or_city = htmlspecialchars($_POST['municipalityOrCity']);
                $barangay = htmlspecialchars($_POST['barangayValue']);
                $purok_or_sitio = htmlspecialchars($_POST['purokOrSitio']);
                $additional_info = htmlspecialchars($_POST['additionalInfo']);
                $ID = 1;

                
    
                if($radioValue == '' || $fullName == '' || $phoneNo == '' || $municipality_or_city == '' || $barangay == '' || $purok_or_sitio == '' || $ID == '')
                {
                    $tst = "";
                    if(isset($_POST['fullName']) && strlen($_POST['fullName']) > 1)
                    $tst = "Yes Full Name";
                    else
                    $tst = "NoFullName";

                    $url = "Location: EditAddress.php?error_overlay=show&error_message=Please%20Fill%20In%20All%20The%20Required%20Fields".$tst."&labelAs=".$labelAs."&fullName=".$fullName.
                    "&phoneNumber=".$phoneNumber."&municipalityOrCity=".$municipalityOrCity."&barangayValue=".$barangayValue."&purokOrSitio=".$purokOrSitio."&additionalInfo=".$additionalInfo;

                    header($url);
                    exit();
                } 
                else
                {
                    $_SESSION['ADDRESS_LABEL'] = $radioValue;
                    $_SESSION['FULL_NAME'] = $fullName;
                    $_SESSION['PHONE_NUMBER'] = $phoneNo;
                    $_SESSION['CITY_MUNICIPALITY'] = $municipality_or_city.', Cebu';
                    $_SESSION['BARANGAY'] = $barangay;
                    $_SESSION['PUROK_SITIO'] = $purok_or_sitio;
                    $_SESSION['ADDITIONAL_INFO'] = $additional_info;
                    $_SESSION['ADDRESS_LABEL'] = $radioValue;
                    echo "<h1>The value of the guest label is: " . $radioValue . "</h1>";
                    echo "<h1>The value of the full name is: " . $fullName . "</h1>";
                    echo "<h1>The value of the phone number is: " . $phoneNo . "</h1>";
                    echo "<h1>The value of the city/municipality is: " . $municipality_or_city . "</h1>";
                    echo "<h1>The value of the barangay is: " . $barangay . "</h1>";
                    echo "<h1>The value of the purok/sitio is: " . $purok_or_sitio . "</h1>";
                    echo "<h1>The value of the additional info is: " . $additional_info . "</h1>";
                    if(!isset($_SESSION['ORDER_INFO']))
                    {
                        $_SESSION['ORDER_INFO'] = 'Visited';
                    }
                    header('Location: OrderInfo.php?n='.$fullName);

                }

                if(strlen($phoneNo) < 11)
                {
                    header('Location: EditAddress.php?error_overlay=show&error_message=Invalid%20Number%20Format');
                    exit();
                }
            }
        }
        else 
        {
            echo "<h1>No data received</h1>";
        }

        $mysqli->close();
?>

