<?php

session_start();

include "../Database/Database.php";
include "../Process/LogInFirst.php";
loginAccFirst('error_msg=Log%20In%20First%20To%20Track%20Your%20Purchase%20History&error_overlay=show');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/PurchaseHistory.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Edit Address</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    <?php include '../Common/StatusOverlay.php' ?>

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
        <div class="main-container">
            
            <div class="purchase-hist-container">
                    <div class="title-container" style="display: flex; justify-content: center; align-items:center; height: 2.5rem;  background-color:orange;">
                        <h4 style="font-family: Arial, Helvetica, sans-serif; font-size:medium; color:white;">PURCHASE HISTORY</h4>
                    </div>

                    <?php
                        $sql = "SELECT * FROM orders
                        WHERE user_id = ".$_SESSION['USER_INFO']['user_id']."
                        AND order_status >= 1 
                        ORDER BY order_id DESC";
                        $result = $mysqli->query($sql);
                        $history = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        echo"<div class='individual-div' >";

                        if(count($history) < 1)
                        echo"<h2>History is Empty</h2>";
                     ?>
                    <div class="purch-hist-contents" >

                    <?php
                        foreach($history as $hist)
                        {
                            $shop = retrieveRecords($mysqli, 'SELECT shop_name FROM shop WHERE shop_id = '.$hist['shop_id']);
                            echo "
                                <div class='individual-hist' style='height:100px;'>
                                    <a href='IndividualHistory.php?history_id=".$hist['order_id']."'>
                                        <div class='first_layer'>
                                            <div class='logo-img' style='  border-radius: 15px; margin: 10px; height:80px; width: 100px;  '>
                                                <img src='../ImageIcons/product_img.png' style='margin: 5px; border-radius: 20px; height:70px; width: 90px;'>
                                            </div>
                                        </div>

                                        <div class='second_layer' style = 'width: 60%; height: 100%; display: flex; '>
                                            <div class='order-info' >
                                                <p id = 'shop_name'>".$shop[0]['shop_name']."</p> 
                                                <p id = 'time_date_info'>".$hist['order_timedate']."</p>
                                            </div>
                                        </div>

                                        <div class='third_layer' style = 'width: 40%; height: 100%; display: flex;'>
                                            <div class='price-info' style='display: flex;'>
                                                <p> &#8369;".$hist['total_amount']."</p>
                                            </div>
                                        </div>
                                    </a>

                                
                                </div>
                           
                            ";

                        }
                        
                    ?>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
    
<style>

    h2{
        text-align: center;
    }

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

    .order-info, .price-info {
        overflow-wrap: break-word;
        width: 100%;
        height: 100%;
        
    }

    .third_layer .price-info{
        align-items: flex-start;
        justify-content: end;
    }

    .order-info p, .price-info p
    {
        margin: 10px;
        font-family: Arial, Helvetica, sans-serif;
    }


    .main-container{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .purchase-hist-container{
        display: flex;
        background-color: white;
        flex-direction: column;
        width: 40rem;
        min-height: 500px;
    }

    .individual-hist a{
        display: flex;
        background-color: white;
        flex-direction: row;
        height: 8rem;
        margin-top: 1rem;
        border-top-width: 1.5px; /* Top border width */
        border-bottom-width: 1.5px; /* Bottom border width */
        border-right-width: 0px;
        border-left-width: 0px;
        border-style: solid; 
        border-color: rgb(150,150,150); 
        text-decoration: none;
        color: black;
    }

    .individual-hist:hover{
        cursor: pointer;
        transform: scale(1.02);
        transition: transform 0.5s;
        margin-bottom: 20px;
    }

    .individual-div{
        height: max-content;
    }

    @media all and (max-width: 750px)
    {
        .purchase-hist-container{
            width: 90%;
            max-height: 80%;
        }
    }

</style>
    
</body>
</html>
