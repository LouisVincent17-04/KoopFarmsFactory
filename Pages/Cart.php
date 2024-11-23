<?php

session_start();

include "../Process/LogInFirst.php";
include "../Database/config.php";
include '../Process/UserInactivity.php';

loginAccFirst('error_msg=Log%20In%20First%20To%20Use%20Your%20Cart&error_overlay=show');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Cart.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Shopping Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    <?php include '../Common/Navbar.php'; ?>
    <div class="content_container">
        <?php include '../Common/StatusOverlay.php'; ?>
        <?php
            $sql = "select user_id, product_id, quantity from cart order by cart_id;";
            if ($result = $mysqli->query($sql)) {
                $item_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
        ?>

        <div class="purchase-container">
        
            <div class="cart-info-div">
                    <div class="cart-title"> 
                        <h4>SHOPPING CART</h4>
                    </div>

                    <!-- INDIVIDUAL PURCHASE DIVS -->
                    <?php
                    $overall = 0;

                        if(isset($_SESSION['USER_INFO']))
                        {
 
                            $sql = "SELECT cart.cart_id, cart.quantity, product_items.product_name, product_items.img_loc,
                            product_items.units_used, product_items.price_per_unit
                            FROM cart
                            JOIN product_items ON cart.product_id = product_items.product_id
                            WHERE cart.user_id = ".$_SESSION['USER_INFO']['user_id'].";";
                            

                            if ($result = $mysqli->query($sql)) {
                                $cart_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            }

                            

                            foreach ($cart_items as $item) {
                                echo "
                                <div class='cart-content'>
                                    <div class='purchase-details'>
                                        <div id='image-src-div'>
                                            <img src='../Items/".$item['img_loc'].".jpg'>
                                        </div>

                                        <div class='child-details'>
                                            <p id = 'item_to_purchase'>".$item['product_name']."</p>

                                            <p id = 'qty'>".number_format(doubleval($item['quantity']), 2, '.','')." ".strtoupper($item['units_used'])."</p>
    
                                            <p id = 'item_price'>"."Price Per KG: ".number_format(doubleval($item['price_per_unit']), 2, '.','')."</p>                 
                                        </div>

                                        <div class='additional-details'>";
                                        $overall += $item['quantity'] * $item['price_per_unit'];
                                        echo"

                                            <div class='price-details'>
                                                <p id ='total_price'>"."Php ".number_format(doubleval($item['quantity'] * $item['price_per_unit']), 2, '.','')."</p>

                                            </div>

                                            <div class='action-buttons'>
    
                                                <form method='POST' action='../Process/DeleteInDB.php' class='button-methods'>
                                                    <button type='submit' id='remove_item'> REMOVE </button>
                                                    <input type='hidden' name='id' value='".$item['cart_id']."'>                                           
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                            $cart_msg = '';
                            if(count($cart_items) < 1)
                            {
                                $cart_msg = "ADD";
                            }
                            else
                            {
                                $cart_msg = "ADD MORE";
                            }

                            echo "
                            <div class='cart-content'>
                                <div id='add_more_div'>
                                    <form method='POST' action='Shop.php' class='button-methods'>
                                        <button type='submit' id='add_item'> +".$cart_msg." </button>
                                    </form>
                                </div>
                            </div>
                            ";
                        }

                    ?>
                    <!-- INDIVIDUAL PURCHASE DIVS -->
                </div>
                            
                <div class="checkout-div">
                        
                        <?php

                            if(isset($_SESSION['USER_INFO']))
                            {
                                echo 
                                "
                                <div class = 'overall-div'>
                                    <h4 id='overall_pay_label'>Total Payments:</h4>
                                    <h4 id='overall_payment'>".number_format(doubleval($overall), 2, '.','')."</h4>
                                </div>
                                
                                <form method='POST' action='EditAddress.php' class='checkout-btn-div'>
                                    <button type='submit' id='checkout-btn'>Checkout</button>
                                </form>
                                ";
                            }
                            
                        ?>
                        
                </div>

            </div>
        </div>
    </div>
      
    <style>
        h4{
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
    </style>
    
    <script src="redirect.js"></script>

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


