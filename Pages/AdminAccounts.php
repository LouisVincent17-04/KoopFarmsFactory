<?php 

include '../Process/UnauthorizedAccess.php';
include '../Process/AccessPage.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminAccounts.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory Admin</title>
</head>
<body>
    <?php include '../Common/Navbar.php'; ?>
    <div class="content_container">
        <div class="success_overlay" id="success_overlay">
            <div class="message_field">
                <h2>Logged In Successfully</h2>
            </div>
        </div>

        <div class="content">

            <div class="actionDivs" id="updateInventoryDiv" onclick="window.location.href='AdminAccessManagement.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/acm.png" alt="">
                </div>
                <div class="inner">Account Access Management</div>
            </div>

            <div class="actionDivs" id="editCategoryDiv" onclick="window.location.href='AdminAccountsPrivileges.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/aap.png" alt="">
                </div>
                <div class="inner">Admin Accounts Privileges</div>
            </div>
        </div>

        

        <style>
            .content{
                margin-top: 7rem;
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                justify-content: center;
                
            }

            .actionDivs{
                display: flex;
                flex-direction: column;
                height: 20rem;
                width: 25rem;
                background-color: white;
                margin: 40px 30px;
                margin-top: 2rem;
                cursor: pointer;
                transition: transform 0.3s;
                align-items: flex-end;
                border-radius: 1rem;
                text-align: center;
            }

            .actionDivs:hover
            {
                transform: scale(1.1);
            }

            .inner{
                width: 100%;
                height: 40%;
                display: flex;
                justify-content: center;
                align-items: center;
                color: black;
                font-size: 24px;
                font-weight: bold;
                font-family: Arial, Helvetica, sans-serif;
            }

            .imageDiv{
                width: 100%;
                display: flex;
                height: 60%;
                justify-content: center;
                align-items: center;
            }

            .content img{
                height: 10rem;
                width: 10rem;
            }
        </style>

        <script>

        document.addEventListener("DOMContentLoaded", function () {
            const hamburger_button = document.getElementById("hamburger");
            const dropdown = document.getElementById('navDropdown');

            hamburger_button.addEventListener('click', function () {
                // Toggle dropdown visibility
                dropdown.style.display = (dropdown.style.display === 'flex') ? 'none' : 'flex';
            });

            // Optionally, close the dropdown when clicking outside of it
            document.addEventListener('click', function (event) {
                if (!dropdown.contains(event.target) && !hamburger_button.contains(event.target)) {
                    dropdown.style.display = 'none';
                }
            });
        });
        </script>
    </div>    
</body>
</html>