<?php

session_start();
include '../Process/UserInactivity.php';
include "../Database/config.php";
include "../Process/LogInFirst.php";

// if(($_SESSION['USER_INFO']))
loginAccFirst('error_msg=Log%20In%20First%20To%20Track%20Your%20Order&error_overlay=show');


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/TrackOrder.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Edit Address</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        include '../Common/Navbar.php'; 
        include '../Common/StatusOverlay.php'; 
    ?>
    

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
    
    <div class="content_container">
    
        <div class="main-container">
           
            <div class="track-order-container">
                    <div class="title-container" style="display: flex; justify-content: center; align-items:center; height: 2.5rem;  background-color:orange;">
                        <h4 style="font-family: Arial, Helvetica, sans-serif; font-size:medium; color:white;">ORDER TRACKING</h4>
                    </div>

                    
                    <div class="purch-track-contents" style="overflow-y: auto;">

                    <?php


                        $currDate = date('Y-m-d');

                        $sql = "SELECT * FROM orders
                        WHERE user_id = ".$_SESSION['USER_INFO']['user_id']."
                        AND order_timedate = '".$currDate."'
                        AND order_status != 4
                        ORDER BY order_id DESC";
                        $result = $mysqli->query($sql);
                        $tracked_order = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        $num_tracker = 0;
                        $order_status = '';

                        echo"<div class='individual-div' style= 'display:flex; flex-direction: column;' >";

                        if(count($tracked_order) < 1)
                        {
                            echo "
                                 <div class='empty-track' style= '  text-align: center; display:flex; justify-content: center; '>
                                    <h3 style='font-family: Arial; '>No orders present in the queue. Order tracking is currently unavailable</h3>
                                 </div>
                            
                            ";
                        }

                        else
                        {
                            foreach($tracked_order as $track)
                            {

                                $getImage = '';
                                if($track['order_status'] == 1){
                                    $getImage = 'ImageIcons\PendingStatus.png';
                                    $order_status = 'Pending';
                                } 
                                elseif($track['order_status'] == 2){
                                    $getImage = 'ImageIcons\PreparingStatus.png';
                                    $order_status = 'Processing Order';
                                } 
                                elseif($track['order_status'] == 3){
                                    $getImage = 'ImageIcons\ForDeliveryStatus.png';
                                    $order_status = 'Order for Delivery';
                                } 
                                elseif($track['order_status'] == 4){
                                    $getImage = 'ImageIcons\DeliveredStatus.png';
                                    $order_status = 'Delivered';
                                } 
                                
    
                                echo "
                                    <div class='individual-order' style=' height:320px; width: 100%; display: flex; flex-direction: column;'>
                                        <div class='first_layer' style='  margin-top: 20px; font-family: Arial; color: white; display: flex; width: 100%; height: 200px; flex-direction:row;  '>
                                            <div class='main-info' style='height: 100%; width: 60%; border-bottom-left-radius: 20px; border-top-left-radius: 20px; background-color:#015d48;   margin-left: 20px; display: flex; flex-direction: column;'>
                                                <h3 style='margin-left: 20px;  font-weight: normal;'>Tracking: ".$track['tracking_number']."</h3>
                                                <h3 style ='margin-left: 20px; margin-top: 0px; font-weight: normal;' >Order ID: ".$track['order_id']."</h3>
                                            </div>
    
                                            <div class='price-info' style='height: 100%; width: 40%; border-bottom-right-radius: 20px; border-top-right-radius: 20px; background-color:#015d48; margin-right: 20px; display:flex; align-items: flex-end; flex-direction: column;'>
                                             
                                                <h3 style='margin-right: 20px; font-weight: normal;'>Total</h3>
                                                <h3 style ='margin-right: 20px; margin-top: 0px; font-weight: normal; ' >&#8369;".$track['total_amount']."</h3>
                                            </div>
                                        </div>
    
                                        <div class='second_layer' style = 'display:flex; justify-content :center; align-items:flex-start; width: 100%; height: 400px; overflow:hidden; '>
                                            <div class='order-status-visual' style = 'display:flex; justify-content :center; align-items:center;'>
                                                <img src='".$getImage."' style='width: 90%; height: 90%; object-fit:cover; '>
                                            </div>
                                        </div>
    
                                        <div class='third_layer' style = 'width: 100%; height: 60px; display: flex; justify-content: center; align-items:center;'>
                                            <div class='current-status'>
                                                <h3 class='order-stat-text' style='margin-left: 10px; font-size: 22px; font-family:Arial;  font-weight: normal;'>".$order_status."</h3>
                                            </div>
                                        </div>
                                
                                    
                                    </div>
                               
                                ";
    
                            }
                        }
                        
                    ?>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
    
<style>

    .first_layer .logo-img{
        background-color: #015d48;
        display: flex;
        align-items: center;
    }

    #shop_name{
        color: rgb(55, 55, 55);
        font-size: 16px;
        font-weight: bold;
    }

    #time_date_info{
        color: rgb(155, 155, 155);
        font-size: 12px;
    }




    .main-container{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .track-order-container{
        display: flex;
        background-color: white;
        flex-direction: column;
        max-height: 700px;
        width: 42rem;
    }

    .individual-order{
        display: flex;
        background-color: white;
        height: 8rem;
        margin-top: 1rem;
        border-width: 1.5px 0; 
        
        border-style: solid; 
        border-color: rgb(150,150,150); 
    }

    @media all and (max-width: 750px)
    {
        .track-order-container{
            width: 90%;
            max-height: 80%;
        }
    }

    .order-stat-text {
            animation: fadeAnimation 3s infinite;
        }

        @keyframes fadeAnimation {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

</style>

    <script src="redirect.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function checkDisplay(id) {
                const element = document.getElementById(id);
                return window.getComputedStyle(element).display === 'flex';
            }

            if (localStorage.getItem('buttonsHidden') === 'true') {
                document.getElementById('login').style.display = 'none';
                document.getElementById('register').style.display = 'none';
                document.getElementById('login2').style.display = 'none';
                document.getElementById('register2').style.display = 'none';
                document.getElementById('logout').style.display = 'flex';
                document.getElementById('logout2').style.display = 'flex';
                document.getElementById('usernameDisplay').style.display = 'flex';
            } else if (checkDisplay('login') || checkDisplay('register') || checkDisplay('login2') || checkDisplay('register2')) {
                document.getElementById('logout').style.display = 'none';
                document.getElementById('logout2').style.display = 'none';
                document.getElementById('usernameDisplay').style.display = 'none';
            }

            if (localStorage.getItem('buttonsHidden') === 'false') {
                document.getElementById('login').style.display = 'flex';
                document.getElementById('register').style.display = 'flex';
                document.getElementById('login2').style.display = 'flex';
                document.getElementById('register2').style.display = 'flex';
                document.getElementById('logout').style.display = 'none';
                document.getElementById('logout2').style.display = 'none';
                document.getElementById('usernameDisplay').style.display = 'none';
            }
        });
    </script>

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
