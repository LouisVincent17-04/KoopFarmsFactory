<?php
session_start();

include("../Database/config.php");
include '../Process/UserInactivity.php';
include "../Process/LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/ModifyFullName.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../Common/Navbar.php'; ?>
    <div class="content_container">
        <div class="parent-info-div">
            <div class="user-info-div">
                <div class="info-container">

                    <div class="info-header">
                        <h3>Mobile Number</h3>
                    </div>

                    <form action="../Process/ModifyProcess.php" method="POST">
                        <input type="text" name="mobileNumber" id="" value="<?php  echo $_SESSION['USER_INFO']['phone_number']; ?>">
                        <button id="saveMobileNumber" name="saveMobileNumber">Save</button>
                    </form>
                        
                    
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
            /* background-color: blueviolet; */
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form{
            margin: 15px 15px 15px 15px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

     

        form button{
            width: 90%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            border-radius: 10px;
            background-color: #ffb400;
            height: 40px;
            border-width: 0px;
            margin-left: 5%;
        }

        .user-info-div{
            background-color: white;
            max-height: 600px;
            width: 600px;
            max-width: 90%;
            overflow: auto;
            border-radius: 15px;
            margin-top: 10rem;
            margin-bottom: 5rem;
        }

        .info-header{
            
            border-radius: 15px;
            margin: 15px 15px 0px 15px;
            display: flex;
            /* background-color: red; */
            height: 40px;
            color: rgb(120, 120, 120);
        }

        .info-container{
            display: flex;
            flex-direction: column;
            box-shadow: 0px 0px 6px grey;
            margin: 10px;
            border-radius: 10px;
            
        }

        .info-container input{
            margin: 0px 15px 10px 15px;
            border-radius: 10px;
        }

        .info-header h3{
            padding-left: 20px;
            font-size: 16px;
        }

        .info-container input{
            background-color: transparent;
            border-width: 2px;
            border-color: rgb(220, 220, 220);
            padding: 20px;
            height: 40px;
            display: flex;
            align-items: center;
            width: 90%;
            margin-left: 5%;
        }

        button:hover{
            cursor: pointer;
        }

        *{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    <script src="redirect.js"></script>

    <script>
        let countdownElement = document.querySelector('.countdown');
        let countdown = 5;

        // Start the countdown
        let countdownInterval = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown === 0) {
                clearInterval(countdownInterval);
                window.location.href = '#'; // Redirect to Aarray.php after countdown
            }
        }, 1000);

        // Cancel function to stop the countdown and redirect to Aarray.php
        function cancelRedirect() {
            clearInterval(countdownInterval);
            window.location.href = 'Aarray.php'; // Redirect to Aarray.php when canceled
        }
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
