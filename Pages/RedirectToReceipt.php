<?php
session_start();

include("../Database/config.php");
include "../Process/LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/RedirectToReceipt.css">
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
        <div class="loading-container">
            <h3>You have </h3>
            <div class="spinnerDiv">
                <div class="spinner"></div>
                <div class="countdown">5</div>
            </div>
            <h3>seconds to cancel your order</h3>
            <button class="cancel-btn" onclick="cancelRedirect()">Cancel</button>
        </div>

        <style>
        .loading-container {
            position: relative;
            width: 100%;
            height: 93vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .loading-container h3{
            font-family: Arial, Helvetica, sans-serif;
            color: white;
            font-size: 18px;

        }

        .spinner {
            width: 150px;
            height: 150px;
            border: 10px solid lightgray;
            border-top: 10px solid orange;
            border-radius: 50%;
            animation: spin 5s linear forwards;
            background-color:white;
        }

        .countdown {
            font-size: 2rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .cancel-btn {
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #ffb400;
            color: white;
            border: none;
            cursor: pointer;
            height: 2.5rem;
            width: 10rem;
            border-radius: 10px;
            font-size: 16px;
        }

        .cancel-btn:hover {
            background-color: #ffb400;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .spinnerDiv {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: 200px; 
            height: 200px; 
        }
    </style>

    </div>
    <script src="redirect.js"></script>

    <script>
        let countdownElement = document.querySelector('.countdown');
        let countdown = 5;

        let countdownInterval = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown === 0) {
                clearInterval(countdownInterval);
                window.location.href = '../Process/PlaceOrderProcess.php'; 
            }
        }, 1000);

        function cancelRedirect() {
            clearInterval(countdownInterval);
            
            window.location.href = 'Cart.php';
        }
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
