<?php 

include '../Process/UnauthorizedAccess.php';
include '../Process/AccessPage.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminOrders.css">
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

            <div class="actionDivs" id="listOfPendingOrdersDiv" onclick="window.location.href='AdminListOfPendingOrders.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/list_orders.png" alt="">
                </div>
                <div class="inner">List Of Pending Orders</div>
            </div>

            <div class="actionDivs" id="listOfProcessedOrdersDiv" onclick="window.location.href='AdminListOfProcessedOrder.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/list_orders.png" alt="">
                </div>
                <div class="inner">List Of Processed Orders</div>
            </div>

            <div class="actionDivs" id="listOfForDeliveryOrdersDiv" onclick="window.location.href='AdminListOfForDelivery.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/list_orders.png" alt="">
                </div>
                <div class="inner">For Delivery</div>
            </div>

            <div class="actionDivs" id="listOfDeliveredOrdersDiv" onclick="window.location.href='AdminListOfDelivered.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/list_orders.png" alt="">
                </div>
                <div class="inner">List Of Delivered Orders</div>
            </div>

            <div class="actionDivs" id="orderSummaryDiv" onclick="window.location.href='AdminOrderSummary.php'">
                <div class="imageDiv">
                    <img src="../ImageIcons/order_summary.png" alt="">
                </div>
                <div class="inner">Order Summary</div>
            </div>
        </div>

        

        <style>
            .content{
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                justify-content: center;
                
            }

            .actionDivs{
                display: flex;
                flex-direction: column;
                height: 260px;
                width: 350px;
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
                height: 30%;
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
                height: 70%;
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