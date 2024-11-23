<?php
session_start();
include '../Process/UserInactivity.php';
include '../Database/Database.php';
include "../Process/LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

if(!isset($_SESSION['receipt_information']) &&(!isset($_SESSION['prod_info_arr'])))
header('Location:Cart.php?error_overlay=show&error_msg=You%20Need%20To%20Checkout%20Your%20Cart');

$stmt = $mysqli->prepare("DELETE FROM cart WHERE user_id = ?;");
$stmt->bind_param("i", $_SESSION['USER_INFO']['user_id']);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Receipt.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
   <?php include '../Common/Navbar.php'?> ;
    <div class="content_container">
        <div class="notif-div"  style="display:flex; position:relative; top: -20px;  justify-content:center; align-items:flex-start; width: 100%; height: 100px;">
            <div class="notification" id='notif_msg' style=" z-index: 100; display:flex; width: 100%; align-items:center; height: 100px;background-color:orange;">
                    <?php
                        if(isset($_GET['display_notif']) && isset($_GET['notif_message']))
                        {   
                            echo "<h2 style = ' margin: 1rem; font-size: 18px; font-weight: normal; color: white;'>".($_GET['notif_message'])."</h2>";
                        }
                    ?>
            </div>
        </div>
        
        
        <div class="receipt-div">    
            <div class="receipt-contents">
                
                <?php
                    if(isset($_SESSION['receipt_information']) &&(isset($_SESSION['prod_info_arr'])))
                    {
                        
                        if(!isset($_SESSION['order_done']))
                        $_SESSION['order_done'] = true;

                        $receipt_info = $_SESSION['receipt_information'];
                        $prod_info = $_SESSION['prod_info_arr'];
                        
                        echo"
                            <div class='receipt-header'>
                                <div class='logo-div' style='height: 100%; width:150px; '>
                                    <img src='../ImageIcons/KFF_OFFICIAL_LOGO.png'>
                                </div>

                            </div>
                        <div id='rec-contents' >
                        ";

                        echo"
                        
                        <div class='receipt-details' id='order-details'>
                            <div class='left'>
                                <div class='div-title' style='height: 18px;'>
                                    <h3>Order Details</h3>
                                </div>
                                <br>
                                <p>"."Order ID:</p>
                                <br>
                                <p>"."Shipping Address:</p>
                            </div>
                            
                            <div class='right'>
                                <div class='div-title' style='height:36px;'>
                                </div>
                                <p>".$receipt_info['order_id']."</p>
                                <br>
                                <p>".$receipt_info['shipping_address']."</p>
                            </div>
                            
                        </div>

                        ";

                        echo
                        "
                        <div class='receipt-details' id='ordered-prod'>
                            <div class='left'>
                        ";
                        
                            foreach($prod_info as $prod){
                                echo"<p>".$prod['quantity']." ".$prod['units']."&nbsp".$prod['prod_name'];
                            }

                        echo"
                            </div>

                            <div class='right'>
                            ";

                            foreach($prod_info as $prod){
                                echo "<p>"."&#8369;".number_format($prod['total_price'], 2)."</p>";
                            }

                        echo"
                            </div>

                        </div>

                        <div class='receipt-details' id='payments'>
                            <div class='left'>
                                <p id ='sub'> Subtotal</p>"."
                                <br>
                                <p>Shipping Cost</p>
                                <br>
                                <p>Payment Method</p>".
                                "
                            </div>
                            <div class='right'>
                                <div class='div-title' style='height:32px;'>
                                <p>"."&#8369;".number_format($receipt_info['subtotal'], 2)."</p>
                                <br>
                                <p>"."&#8369;".number_format($receipt_info['shipping_cost'], 2)."</p>
                                <br>
                                <p>".$receipt_info['payment_method']."</p>
                            </div>
                        </div>
                        
                        ";

                        echo"
                        </div>
                    </div>
                        <div class='receipt-details' id='net-pay'>
                            <div class='left'>
                                <p>Total</p>".
                                "
                            </div>
                            <div class='right'>
                                <div class='div-title' style='height:32px;'>
                                <p>"."&#8369;".number_format($receipt_info['net'], 2)."</p>
                            </div>
                        </div>
                        
                        ";
                    }

                    elseif (!isset($_SESSION['receipt_information']) || !isset($_SESSION['prod_info_arr'])) {
                        echo "<p style='text-align: center;'>Receipt information is not available.</p>
                        ";
                    }
                    
                ?>
            </div>

           <div class='returnDiv'>
                <form action="../Process/ReturnToShop.php" method="POST">
                    <button name="returnButton" id="returnButton">Return To Shop</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        
        const div_notif = document.getElementById("notif_msg");

        let opacity = 1;  

        const fadeOut = setInterval(() => {
        if (opacity <= 0) {
            clearInterval(fadeOut);  
        } else {
            opacity -= 0.01;  
            div_notif.style.opacity = opacity;  
        }
        }, 100);  

    </script>
</body>
</html>
