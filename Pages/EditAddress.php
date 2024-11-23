<?php
session_start();
include "../Process/LogInFirst.php";
include "../Database/config.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/EditAddress.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Edit Address</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="error_overlay" id="error_overlay" style="background-color: red;">
        <div class="message_field">
            <img src="../ImageIcons/warning_icon.png" alt="err_warn" id="error_icon" >
            <h2><?php  if(isset($_GET['error_message'])) echo $_GET['error_message']; ?></h2>
        </div> 

        <div class="exit_field">
            <button id="close_btn">X</button>
        </div>
    </div>

    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function removeQueryParameter() {
            const url = new URL(window.location.href);
            url.searchParams.delete('success_overlay');
            window.history.replaceState({}, document.title, url.pathname);
        }

        if (getQueryParam('error_overlay') === 'show') {
            document.getElementById('error_overlay').style.display = 'flex';
            removeQueryParameter();
        }

    </script>
    
    <?php include '../Common/Navbar.php'; ?>
    <div class="content_container">
        <div class="address-container" style="overflow: auto;">
            <div class="delivery_details">
                <div class="delivery-details-title">
                    <h4>Delivery Details</h4>
                </div>

                <?php  
                include('../Database/config.php');

                $currPurok = '';
                $currBarangay = '';
                $currMunicipalCity = '';
                $currPhoneNum = '';
                $currFullName = '';
                $currAddressLabel = '';
                $currAdditionalInfo = '';

                if(isset($_SESSION['USER_INFO']['user_id']))
                {
                    $user_info = '';
                    $user_sql = "SELECT * FROM users WHERE user_id = ?";
                    if ($stmt = $mysqli->prepare($user_sql)) {
                        $stmt->bind_param("i", $_SESSION['USER_INFO']['user_id']);
                        $stmt->execute();
                        $user_result = $stmt->get_result();
                        
                        $user_info = $user_result->fetch_assoc(); 
                    }

                    $currPurok = $user_info['purok'];
                    $currBarangay = $user_info['barangay'];
                    $currMunicipalCity = $user_info['city_municipality'];
                    $currPhoneNum = $user_info['phone_number'];
                    $currFullName = $user_info['full_name'];
                    $currAddressLabel = $user_info['address_label'];
                    $currAdditionalInfo = $user_info['additional_info'];
                }
                

                ?>

                <div class="name_number_details">
                    <input type="text" id="full_name" placeholder="Full Name (Ex.Tajanlangit, Louis Vincent P.)" value="<?php if(isset($_SESSION['USER_INFO'])) 
                    echo $currFullName; elseif(!isset($_SESSION['USER_INFO']) && isset($_GET['fullName'])) echo $_GET['fullName']; else echo ""; ?>" required>
                    <input type="text" id="phone_number" pattern="[0-9]*" placeholder="Phone Number" value="<?php if(isset($_SESSION['USER_INFO']))
                    echo $currPhoneNum; if(!isset($_SESSION['USER_INFO']) && isset($_GET['phone_number'])) echo $_GET['phone_number']; ?>" required>
                </div>

         

                <div class="address_details">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <?php
                    

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'get_barangays') {
                        if (isset($_POST['municipality_name'])) {
                            $municipality_name = $mysqli->real_escape_string($_POST['municipality_name']);
                            $sql = "SELECT barangays.barangay_id, barangays.barangay_name, city_municipality.place 
                            FROM barangays 
                            JOIN city_municipality ON barangays.city_municipality_id = city_municipality.id
                            WHERE city_municipality.place  = '".$municipality_name."'";
                            $barangays = [];

                            if ($result = $mysqli->query($sql)) {
                                while ($row = $result->fetch_assoc()) {
                                    $barangays[] = $row;
                                }
                                $result->free();
                            } else {
                                echo "Error: " . $mysqli->error;
                            }

                            foreach ($barangays as $value) {
                                echo "<option value='".$value["barangay_name"]."'>".$value["barangay_name"]."</option>";
                            }
                        }
                        exit;
                    }

                    $sql = "SELECT id, place FROM city_municipality";
                    $municipalities = [];

                    if ($result = $mysqli->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $municipalities[] = $row;
                        }
                        $result->free();
                    } else {
                        echo "Error: " . $mysqli->error;
                    }
                    ?>

                            <select name="municipality" id="municipality" onchange="updateBarangays()">
                                <option value="" required>--Select a municipality/city--</option>
                                <?php
                                foreach ($municipalities as $municipality) {
                                    echo "<option value='".$municipality["place"]."'";
                                    
                                    
                                    if ($municipality["place"] == $currMunicipalCity && isset($_SESSION['USER_INFO'])) {
                                        echo " selected";
                                    }
                                    
                                    echo ">".$municipality["place"]."</option>";
                                }
                                ?>
                            </select>

                            <select name="barangay" id="barangay">
                                <option value="">--Select a barangay--</option>
                            </select>

                            <input type="text" name="purok_sitio" id="purok_sitio" placeholder="Purok/Sitio" value="<?php if(isset($_SESSION['USER_INFO'])) echo $currPurok; ?>">
                </div>

                <div class="building_house_no_details">
                    <input type="text" name="additional_add_info" id="additional_add_info" placeholder="Building / House Number: (Optional)" value="<?php if(isset($_SESSION['USER_INFO'])) echo $currAdditionalInfo; ?>">
                </div>

             

                <div class="label_as_details">
                    
                    <div class="label-div">
                        <label for="radio_home" class="labels">Home</label>
                        <input type="radio" name="radioChoice" value="Home" id="radio_home" <?php if($currAddressLabel == 'Home' && isset($_SESSION['USER_INFO'])) echo "checked"; ?>>
                    </div>

                    <div class="label-div">
                        <label for="radio_work" class="labels">Work</label>
                        <input type="radio" name="radioChoice" value="Work" id="radio_work" <?php if($currAddressLabel == 'Work' && isset($_SESSION['USER_INFO'])) echo "checked"; ?>>
                    </div>

                    <div class="label-div">
                        <label for="radio_others" class="labels">Others</label>
                        <input type="radio" name="radioChoice" value="Others" id="radio_others" <?php if($currAddressLabel == 'Others' && isset($_SESSION['USER_INFO'])) echo "checked"; ?>>
                    </div>
                    
                </div>

                <div class="action_buttons">
                    <button type="button" id="cancel_address">Cancel</button>

                    <?php
                    if(isset($_SESSION['USER_INFO']))
                    {
                        $get_sql = "SELECT * FROM users WHERE user_id =".$_SESSION['USER_INFO']['user_id'].";";

                        $result = $mysqli->query($get_sql);

                        $row = '';
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                        }
                    }
                    
                    if(isset($_SESSION['USER_INFO']))
                    $actionUrl = "../Process/SubmitDeliveryInfoLogged.php";
                    
                    ?>

                    <form action="<?php echo $actionUrl ?>" method="POST">
                        <input type="hidden" name="labelAs" id="labelAs" value="">
                        <input type="hidden" name="fullName" id="fullName" value="">
                        <input type="hidden" name="phoneNumber" id="phoneNumber" value="">
                        <input type="hidden" name="municipalityOrCity" id="municipalityOrCity" value="">
                        <input type="hidden" name="barangayValue" id="barangayValue" value="">
                        <input type="hidden" name="purokOrSitio" id="purokOrSitio" value="">
                        <input type="hidden" name="additionalInfo" id="additionalInfo" value="">

                        <button type="submit" id="submit_address" onclick="setValues()">Submit</button>


                    </form>
                </div>

            </div>
        </div>

        
    </div>
</div>
    
    <script src="redirect.js"></script>

    <script>
        

        function setValues()
        {
            var radioChoice = document.querySelector('input[name="radioChoice"]:checked').value;
            var fullName = document.querySelector('input[id="full_name"]').value; 
            var phoneNo = document.querySelector('input[id="phone_number"]').value; 
            var municipalityOrCity = document.querySelector('select[id="municipality"]').value;
            var barangayValue = document.querySelector('select[id="barangay"]').value; 
            var purokOrSitio = document.querySelector('input[id="purok_sitio"]').value; 
            var additionalInfo = document.querySelector('input[id="additional_add_info"]').value;

            document.getElementById('labelAs').value = radioChoice;
            document.getElementById('fullName').value = fullName;
            document.getElementById('phoneNumber').value = phoneNo;
            document.getElementById('municipalityOrCity').value = municipalityOrCity;
            document.getElementById('barangayValue').value = barangayValue; 
            document.getElementById('purokOrSitio').value = purokOrSitio;
            document.getElementById('additionalInfo').value = additionalInfo; 
        }


    </script>

    <script>
        function updateBarangays() {
            var municipalityDropdown = document.getElementById('municipality');
            var selectedValue = municipalityDropdown.value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../Process/updateBarangays.php', true); 
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        document.getElementById('barangay').innerHTML = xhr.responseText;
                    } else {
                        console.error('AJAX request failed. Status:', xhr.status);
                    }
                }
            };

            xhr.send('action=get_barangays&municipality_name=' + encodeURIComponent(selectedValue));
        }

        document.addEventListener('DOMContentLoaded', function() {
            var municipalityDropdown = document.getElementById('municipality');
            if (municipalityDropdown.value) {
                updateBarangays();
            }

            document.getElementById('close_btn').addEventListener('click', function(){
                document.getElementById('error_overlay').style.display = 'none';
            });
        });
    </script>
    
</body>
</html>
