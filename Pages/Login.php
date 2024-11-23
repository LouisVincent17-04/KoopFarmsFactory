<?php
session_start();
if(isset($_SESSION['USER_INFO']))
header('Location:home.php?msg=You%20are%20logged%20in');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Registration Page</title>
    <link rel="stylesheet" href="../CSS/Login.css">
</head>
<body>

    <?php include '../Common/Navbar.php'; ?>

    <div class="parent-container">
        <?php include '../Common/StatusOverlay.php'; ?>

        <div class="container">
            <h2>Sign in</h2>
            <form action="../Process/LoginProcess.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <input type="hidden" name="getUsername" id="getUsername" value="">
                <input type="hidden" name="getPassword" id="getPassword" value="">

                <div class="form-group">
                    <button type="submit" onclick="setValues() ">Sign in</button>
                </div>
            </form>

            <div class="social-register">
                <p id="or_label">Or</p>
                    <button class="google-button">
                    <img src="../ImageIcons/gmail_icon.png" alt="icon" class="gmail-icon"> 
                    <span>Sign in with Google</span>
                    </button>
    
                    <button class="facebook-button">
                    <img src="../ImageIcons/facebook_icon.png" alt="icon" class="facebook-icon"> 
                    <span>Sign in with Facebook</span>
                    </button>
                    
                    <div class="no_account">
                        <h4 id="no_account_label">Dont have an account? Click 
                        </h4>
    
                        <button id="here"> here</button>
    
    
                        <script>
                            document.getElementById("here").addEventListener("click", function() {
                                window.location.href = "Register.php";
                            });

                            function setValues() 
                            {
                                var username = document.querySelector('input[id="username"]').value;
                                var password = document.querySelector('input[id="password"]').value;
                                document.getElementById('getUsername').value = username;
                                document.getElementById('getPassword').value = password;
                            }
                        </script>

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

                            document.getElementById('close_btn').addEventListener('click', function() {
                                document.getElementById('error_overlay').style.display = 'none';
                            });
                        </script>
                    </div>
    
                    <!-- <span class="existing_account">Have an account? Click here
                        <button id="here"> here</button>
                    </span> -->
                
            </div>
        </div>
    </div>
    <script src="redirect.js"></script>
</body>
</html>
