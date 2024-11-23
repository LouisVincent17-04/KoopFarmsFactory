<?php 

include '../Process/UnauthorizedAccess.php';
include '../Process/AccessPage.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminProducts.css">
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

            <div class="actionDivs" id="updateInventoryDiv" onclick="window.location.href='AdminUpdateInventory.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/updateInventory.png" alt="">
                </div>
                <div class="inner">Update Inventory</div>
            </div>

            <div class="actionDivs" id="editCategoryDiv" onclick="window.location.href='AdminUpdateCategory.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/editCategory.png" alt="">
                </div>
                <div class="inner">Update Category</div>
            </div>
        </div>

        <style>
            .content{
                margin-top: 100px;
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
    </div>    
</body>
</html>