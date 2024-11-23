<?php
session_start();

if(isset($_SESSION['USER_INFO']))
header('Location:home.php');

include '../Process/UserInactivity.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Registration Page</title>
    <link rel="stylesheet" href="../CSS/Register.css">
</head>
<body>
    <?php include '../Common/Navbar.php'; ?>
    <div class="parent-container">
        
        <?php
            if(isset($_GET['error_overlay']) && isset($_GET['error_msg']))
                echo "<div class='error_overlay' id='error_overlay'>
                    <div class='message_field'>
                        <img src='ImageIcons/warning_icon.png' alt='err_warn' id='error_icon'>
                        <h2>".$_GET['error_msg']."</h2>
                    </div>
                    <div class='exit_field'>
                        <button id='close_btn'>X</button>
                    </div>
                </div>";
        ?>

        <?php 
        
            if(isset($_GET['success_overlay'])){
                echo "<div class='success_overlay' id='success_overlay'>
                    <div class='message_field'>
                        <h2>".$_GET['success_msg']."</h2>
                    </div>
                </div>";
            }  
        
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
            } else if (getQueryParam('error_overlay2') === 'show') {
                document.getElementById('error_overlay2').style.display = 'flex';
                removeQueryParameter();
            }
            else if (getQueryParam('success_overlay') === 'show') {
                const successOverlay = document.getElementById('success_overlay');
                successOverlay.style.display = 'flex';
                setTimeout(() => {
                    successOverlay.style.opacity -=0.01;
                }, 700); 
                removeQueryParameter();
            }

            document.getElementById('close_btn').addEventListener('click', function() {
                document.getElementById('error_overlay').style.display = 'none';
            });

            document.getElementById('close_btn2').addEventListener('click', function() {
                document.getElementById('error_overlay2').style.display = 'none';
            });

        </script>
        
        <div class="container">
            <h2>Register</h2>
            <form id="registrationForm" action="../Process/RegisterProcess.php" method="POST" onsubmit="setValues()">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <input type="hidden" name="getUsername" id="getUsername" value="">
                <input type="hidden" name="getPassword" id="getPassword" value="">
                <input type="hidden" name="getConfirmPassword" id="getConfirmPassword" value="">
                <button type="submit" id="sign_up_button">Sign up</button>
            </form>
            <div class="social-register">
                <p id="or_label">Or</p>
                <button class="google-button" id="googleButton">
                    <img src="ImageIcons/gmail_icon.png" alt="icon" class="gmail-icon">
                    <span>Sign up with Google</span>
                </button>
                <button class="facebook-button">
                    <img src="ImageIcons/facebook_icon.png" alt="icon" class="facebook-icon">
                    <span>Sign up with Facebook</span>
                </button>
                <div class="existing_account">
                    <h4 id="exist_acc_label">Have an account? Click </h4>
                    <button id="here">here</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("here").addEventListener("click", function() {
            window.location.href = "Login.php";
        });

        document.getElementById("googleButton").addEventListener("click", function() {
            window.location.href = "home.php";
        });

        function setValues() {
            var username = document.querySelector('input[id="username"]').value;
            var password = document.querySelector('input[id="password"]').value;
            var confirmPassword = document.querySelector('input[id="confirm-password"]').value;
            document.getElementById('getUsername').value = username;
            document.getElementById('getPassword').value = password;
            document.getElementById('getConfirmPassword').value = confirmPassword;
        }

        document.getElementById("hamburger").addEventListener("click", function() {
            var dropdown = document.getElementById("navDropdown");
            if (dropdown.style.display === "flex") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "flex";
            }
        });

    </script>
</body>
</html>
