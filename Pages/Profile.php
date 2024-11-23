<?php
session_start();
include '../Process/UserInactivity.php';
include "../Process/LogInFirst.php";
include "../Database/config.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php  include '../Common/Navbar.php';  ?>
    <div class="content_container">
        

        
        
        <div class="parent-info-div">

        <div class="success_overlay" id="success_overlay">
            <div class="message_field">
                <h2>Updated Successfully</h2>
            </div>
        </div>
        
        <div class="error_overlay" id="error_overlay">
            <div class="message_field">
                <h2>Username Already Taken</h2>
            </div>
        </div>
        
        </style>

            <div class="user-info-div">
                <div class="info-container">
                    <div class="info-header">
                        <div class="left">
                            <h3>Full Name</h3>
                        </div>

                        <div class="right">
                            <input type='image' src='../ImageIcons/edit.png' alt="Submit" width="25" height="25" onclick="window.location.href ='ModifyFullName.php'">
                        </div>
                    
                    </div>

                    <div class="content">
                    
                    <?php echo $_SESSION['USER_INFO']['full_name']; ?>
                    
                    </div>
                </div>

                <div class="info-container">
                    <div class="info-header">
                        <div class="left">
                            <h3>Username</h3>
                        </div>

                        <div class="right">
                            <input type='image' src='../ImageIcons/edit.png' alt="Submit" width="25" height="25" onclick="window.location.href ='ModifyUsername.php'">
                        </div>
                    
                    </div>

                    <div class="content">
                    <?php  echo $_SESSION['USER_INFO']['username']; ?>
                    </div>
                </div>

                <div class="info-container">
                    <div class="info-header">
                        <div class="left">
                            <h3>Mobile Number</h3>
                        </div>

                        <div class="right">
                            <input type='image' src='../ImageIcons/edit.png' alt="Submit" width="25" height="25"  onclick="window.location.href ='ModifyMobileNumber.php'">
                        </div>                        
                    </div>

                    <div class="content">
                    <?php  echo $_SESSION['USER_INFO']['phone_number']; ?>
                    </div>
                </div>

                <div class="info-container">
                    <div class="info-header">
                        <div class="left">
                            <h3>Address</h3>
                        </div>

                        <div class="right">
                            <input type='image' src='../ImageIcons/edit.png' alt="Submit" width="25" height="25" onclick="window.location.href ='EditAddress.php'">
                        </div>
                    </div>

                    <div class="content">
                        <?php  echo $_SESSION['USER_INFO']['purok']." ".$_SESSION['USER_INFO']['barangay']." ".$_SESSION['USER_INFO']['city_municipality'];; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>

        .content_container{
            display: flex;
            align-items: center;
            height: auto;
        }

        .parent-info-div{
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info-div{
            background-color: white;
            max-height: 600px;
            width: 600px;
            max-width: 90%;
            overflow: auto;
            border-radius: 15px;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .info-header{
            
            border-radius: 15px;
            margin: 15px 15px 0px 15px;
            display: flex;
            /* background-color: red; */
            height: 40px;
            
        }

        .info-container{
            display: flex;
            flex-direction: column;
            box-shadow: 0px 0px 6px grey;
            margin: 10px;
            border-radius: 10px;
            
        }

        .content{
            margin: 0px 15px 10px 15px;
            border-radius: 15px;
        }

        .left h3{
           padding: 20px;
           font-size: 16px;
        }

        .right input{
           margin-right: 10px;
            
        }

        .left, .right{
            width: 50%;
            height: 100;
            padding: 1px;
            border-radius: 15px;
            display: flex;
            align-items: center;
        }

        .left{
            /* background-color: orange; */
            
        }

        .right{
            /* background-color: orangered; */
            display: flex;
            justify-content: flex-end;
        }

        .content{
            /* background-color: purple; */
            padding: 20px;
            height: 40px;
            display: flex;
            align-items: center;
        }

        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        #success_overlay, #error_overlay{
            display: none;
            position: fixed;
            top: 7rem;
            left: 0px;
            width: 100%;
            height: 5rem;
            background-color: rgb(250, 165, 0);
            display: none;
            justify-content: flex-start;
            align-items: center;
            color: white;
            z-index: 1000; /* Ensure it covers other content */
            font-family: Arial, Helvetica, sans-serif;
            flex-direction: row;
            opacity: 1;
            transition: opacity 2s ease-in-out; 
        }

        #error_overlay{
            background-color: red;
        }

        #success_overlay h2, #error_overlay h2{
            margin: 1rem;
            font-size: 18px;
            font-weight: normal;
            color: white;
        }

    </style>
    <script src="redirect.js"></script>

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
                const error_overlay = document.getElementById('error_overlay');
                error_overlay.style.display = 'flex';
                setTimeout(() => {
                    error_overlay.style.opacity -=0.01;
                }, 700); 

            } else if (getQueryParam('error_overlay2') === 'show') {
                document.getElementById('error_overlay2').style.display = 'flex';
                // removeQueryParameter();
            }
            else if (getQueryParam('success_overlay') === 'show') {
                const successOverlay = document.getElementById('success_overlay');
                successOverlay.style.display = 'flex';
                setTimeout(() => {
                    successOverlay.style.opacity -=0.01;
                }, 700); 
                // removeQueryParameter();
            }

            document.getElementById('close_btn').addEventListener('click', function() {
                document.getElementById('error_overlay').style.display = 'none';
            });

            document.getElementById('close_btn2').addEventListener('click', function() {
                document.getElementById('error_overlay2').style.display = 'none';
            });

        </script>

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
        document.querySelectorAll('.chicken-item').forEach(product => {
            product.addEventListener('click', function() {
                const image = this.getAttribute('data-image');
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                
                const item_image = {
                    image, name, price
                };

                localStorage.setItem('item-image', JSON.stringify(item_image));
                window.location.href = 'Item.php'; 
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('option-items').addEventListener('change', function() {
                var selectedValue = this.value;
                var itemDiv = document.getElementById('items-container');
                if (selectedValue == '100' || selectedValue == '101') {
                    itemDiv.style.display = 'flex';
                } else {
                    itemDiv.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
