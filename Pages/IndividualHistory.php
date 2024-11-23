<?php

session_start();
include '../Database/config.php';
include "../Process/UserInfo.php";
include '../Process/UserInactivity.php';
include "../Process/LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/IndividualHistory.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Shopping Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>                
    <?php include '../Common/Navbar.php';  ?>                        
    <div class="content_container">
        <div class="error_overlay" id="error_overlay">
            <div class="message_field">
                <img src="ImageIcons/warning_icon.png" alt="err_warn" id="error_icon">
                <h2 id="errorMessage">
                    <?php
                        if(isset($_GET['error_msg']))
                        {
                            echo "<h2>".$_GET['error_msg']."</h2>";
                        }
                    ?>
                </h2>
            </div>
            <div class="exit_field">
                <button id="close_btn2">X</button>
            </div>
        </div>

        <?php
            $item_info = '';
            $stmt = $mysqli->prepare("SELECT * FROM order_items
            JOIN users ON order_items.user_id = users.user_id
            JOIN product_items ON order_items.product_id = product_items.product_id
            JOIN orders ON order_items.order_id = orders.order_id
            WHERE order_items.user_id = ? AND order_items.order_id = ? ");
            $stmt->bind_param("ii", $_SESSION['USER_INFO']['user_id'], $_GET['history_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $item_info = $result->fetch_all(MYSQLI_ASSOC);
        ?>

        <div class="purchase-container">
        <div class="order-title"> 
                    <h4>ORDER INFORMATION</h4>
                </div>  
            <div class="order-info-div">
                                                                <!-- /order-title -->
                <?php
                if(isset($_SESSION['USER_INFO']))
                {
                    echo 
                    "
                    <div class = 'order_summary'>
                        <div class = 'order_summary_title'>
                            <h4>Order Summary</h4>
                        </div>                                                  <!-- /order_summary_title -->
                        <div class = 'order_content'>
                            <div class = 'order_qty_unit'>
                                <div class = 'order_qty_unit_child'>
                    ";

                    foreach ($item_info as $item) {
                        echo 
                        "
                            <h4>".$item['quantity']." ".$item['units_used']."</h4>                                
                        ";
                    }

                    echo "</div>                                                    <!-- /order_qty_unit_child -->";

                    echo
                    "
                        <div class = 'order_desc'>
                    ";

                    foreach ($item_info as $item) {
                        echo 
                        "
                            <h4>".$item['product_name']."</h4>
                        ";
                    }

                    echo 
                    "
                                </div>                                                  <!-- /order_desc -->  
                            </div>                                                  <!-- /order_qty_unit -->
                            <div class = 'order_total'>
                    ";

                    foreach ($item_info as $item) {
                        echo 
                        "
                            <h4>".number_format(doubleval($item['quantity'] * $item['price_per_unit']), 2, '.','')."</h4>
                        ";
                    }

                        $to_address = $item_info[0]['purok']." ".$item_info[0]['barangay']." ".$item_info[0]['city_municipality'];
                        $phone_number = $item_info[0]['phone_number'];
                    
                        $from_address = 'Purok 2 Gabi, Cordova, Cebu';
                      
                        

                    echo 
                    "
                            </div>                                                  <!-- /order_total -->
                        </div>                                                  <!-- /order_content -->
                        <div class = 'address'>
                            <div class = 'address_icons'>
                                <img class = 'addImg' src = '../ImageIcons/from_location.png'>
                                <img class = 'addImg' src = '../ImageIcons/to_location.png'>
                                <img class = 'addImg' src = '../ImageIcons/phone_icon.png'>
                            </div>                                                  <!-- /address_icons -->
                            <div class = 'address_info'>
                                <h4>".$from_address."</h4>
                                <h4>".$to_address."</h4>
                                <h4>".$phone_number."</h4>
                            </div>                                                  <!-- /address_info -->
                        </div>                                                  <!-- /address -->
                    </div>                                                  <!-- /order_summary -->
                    ";

                    $overall = 0;
                    $delivery_fee = 50; // Just a temporary variable lol...

                    foreach ($item_info as $total_) {
                        $overall = $overall + ($total_['quantity'] * $total_['price_per_unit']);
                    }

                    echo 
                    "
                    <div class = 'payment'>
                        <div class = 'payment_detail_title'>
                            <h4>Payment Detail</h4>
                        </div>                                                  <!-- /payment_detail_title -->
                        <div class = 'payment_method'>
                            <h4>Cash</h4>
                        </div>                                                  <!-- /payment_method -->
                    </div>                                                  <!-- /payment -->
                    ";

                    echo 
                    "
                    <div class = 'amount_summary'>
                        <div class = 'amount_title'>
                            <h4>Subtotal</h4>
                            <h4 class='h42'>Delivery Fee</h4>
                        </div>                                                  <!-- /amount_title -->
                        <div class = 'total_amount'>
                            <h4>".number_format(doubleval($overall), 2, '.','')."</h4>
                            <h4 class='h42'>".number_format(doubleval($delivery_fee), 2, '.','')."</h4>
                        </div>                                                  <!-- /total_amount -->
                    </div>                                                  <!-- /amount_summary -->
                    ";
                }
                ?>
            </div>                                                  <!-- /order-info-div -->
            
            <div class="place-order-btn-div">
                <?php
                    $overall = $overall + $delivery_fee;
                    $_SESSION['OVERALL_AMOUNT'] = $overall;
                    $_SESSION['DELIVERY_FEE'] = $delivery_fee;
                    echo 
                    "
                    <div class='amount_to_pay'>
                        <div class = 'overall-label-div'>
                            <h4 id='overall_pay_label'>Total</h4>
                        </div>                                                  <!-- /overall-label-div -->
                        <div class = 'overall-amount-div'>
                            <h4 id='overall_payment'>".number_format(doubleval($overall), 2, '.','')."</h4>
                        </div>                                                  <!-- /overall-amount-div -->
                    </div>                                                  <!-- /amount_to_pay -->
                    ";
                ?>
                <form method='POST' action="../Pages/PurchaseHistory.php" >
                    <button type="submit" id="place-order-btn">Back To History</button>
                </form>
            </div>                                                  <!-- /place-order-btn-div -->
        </div>                                                  <!-- /purchase-container -->
    </div>                                                  <!-- /content_container -->


    <style>
        h4{
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
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
                url.searchParams.delete('error_overlay');
                window.history.replaceState({}, document.title, url.pathname);
            }

            if (getQueryParam('error_overlay') === 'show') {
                document.getElementById('error_overlay').style.display = 'flex';
                // removeQueryParameter();
            }
  
            document.getElementById('close_btn').addEventListener('click', function() {
                document.getElementById('error_overlay').style.display = 'none';
            });


        </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function checkDisplay(id) {
                const element = document.getElementById(id);
                return window.getComputedStyle(element).display === 'flex';
            }
        });

        
    </script>
</body>
</html>



