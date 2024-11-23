
<?php
 session_start(); 
include "../Process/LogInFirst.php";
include '../Database/config.php';
include '../Process/UserInactivity.php';
if(isset($_GET['id_']))
$product_id = $_GET['id_'];
else
header('Location:itemlist.php');

// $stmt = $mysqli->prepare("SELECT product_name, price_per_unit, quantity, units_used, img_loc FROM product_items WHERE product_id = ?;");
// $stmt->bind_param("i", $product_id);
// $stmt->execute();
// $stmt->bind_result($product_name, $price_per_unit, $quantity, $units, $img_loc);
// $stmt->fetch();
// $stmt->close();

$stmt = $mysqli->prepare("SELECT * FROM product_items WHERE product_id = ?;");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Item.css">
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
        <div class="error_overlay" id="error_overlay">
            <div class="message_field">
                <h2><?php echo $_GET['error']; ?></h2>
            </div>
        </div>

        <div class="image-div">
            <div class="item-info">
                <div id="item-image" class="item" data-name="image-div">
                   
                <img src=' <?php echo "../Items/".($items[0]['img_loc']) . '.jpg'; ?>' alt='<?php echo $items[0]["product_name"]; ?>' id='chosen-item-id'>  
                    
                </div>

                <div id="item-desc" class="item">
                    <h4 id="description"><?php echo $items[0]['product_name'];  ?></h4>
                </div>
                
            </div>
        </div>

        <div class="attribute-div">
            <h5 id="unit_lbl">Product Unit</h5>
            <select name="Product-Unit" id="prod-unit-options" onchange="displaySelectedOption()">
                <option value="KG" class="option-categories">KG</option>         
            </select>
            <br><br>
            <h5 id="price_lbl">Price</h5>
            <input type="text" id="initial-price" placeholder="" name="initial_price" value="<?php echo  $items[0]['price_per_unit'];  ?>" readonly>
            <br><br>
            <h5 id="value_lbl">Weight/Unit Value</h5>
            <input type="number" id="qty" name="quantity" min="0.1" max="<?php echo  $items[0]['quantity'];?>" value= 1 step="0.05">
            <br><br>
            <h5 id="qty_lbl">Quantity Available</h5>
            <input type="text" id="quantity-available" placeholder="" value="<?php if(isset($_GET['id_'])) echo $items[0]['quantity']." ".strtoupper($items[0]['units_used']); else echo "Error Retrieving Quantity. Go Back To Shop" ?>" name="initial_price" readonly>
            <br><br>
            <h5 id="total_lbl">Total Amount</h5>
            <input type="text" id="total-price" name="total-price" value="<?php if(isset($_GET['id_'])) echo $items[0]['price_per_unit']; ?>" placeholder="Total Price" readonly>
            <br><br><br>

            <script>
                function displaySelectedOption() {
                    var selectElement = document.getElementById('prod-unit-options');
                    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
                    document.getElementById('UNIT-ID').value =  selectedValue;
                }

                window.onload = function() 
                {
                    displaySelectedOption();
                }
            </script>

            <?php
            $input_action_url = '';

            if(!isset($_SESSION['USER_INFO'])) {
                $input_action_url = "Login.php?error_msg=Log%20In%20First%20To%20Use%20Your%20Cart&error_overlay=show";
            } else if(isset($_SESSION['USER_INFO'])) {
                $input_action_url = "../Process/storeItemToDB.php";
            }
            
            ?>

            <form action="<?php echo $input_action_url."?id_=".$product_id; ?>" method="post">
                <input type="hidden" name="IMAGE-ID" value="<?php echo $product_id; ?>" id="IMAGE-ID">
                <input type="hidden" name="ITEM-ID" id="ITEM-ID" value="
                <?php
                if (isset($_SESSION['USER_INFO'])) {
                    echo($_GET['id_']);
                }
                ?>" id="ITEM-ID">
                
                <input type="hidden" name="UNIT-ID" value="" id="UNIT-ID">
                <input type="hidden" name="TOTAL-PRICE-ID" value="" id="TOTAL-PRICE-ID">
                <input type="hidden" name="INITIAL-PRICE-ID" value="" id="INITIAL-PRICE-ID">
                <input type="hidden" name="QUANTITY-ID" value="" id="QUANTITY-ID">
                <button id="addToCart" type="submit" onclick="storeItems()">Add To Cart</button>
            </form>

        </div>
    </div>

    <style>
        #success_overlay, #error_overlay{
            display: none;
            position: fixed;
            top: 7rem;
            left: 0px;
            width: 100%;
            height: 5rem;
            background-color: rgb(250, 165, 0);
            display: none;
            justify-content: flex-start;
            align-items: center;
            color: white;
            z-index: 1000; /* Ensure it covers other content */
            font-family: Arial, Helvetica, sans-serif;
            flex-direction: row;
            opacity: 1;
            transition: opacity 2s ease-in-out; 
        }

        #error_overlay{
            background-color: red;
        }

        #success_overlay h2, #error_overlay h2{
            margin: 1rem;
            font-size: 18px;
            font-weight: normal;
            color: white;
        }
    </style>
    
    <script src="redirect.js"></script>
    
    <script type="module">
        let pricePerUnit = 0;

        document.getElementById('qty').addEventListener('input', function() {
            var numberValue = this.value;

            document.getElementById("QUANTITY-ID").value = numberValue;

            document.getElementById('total-price').value = numberValue * document.getElementById('initial-price').value;
            document.getElementById("TOTAL-PRICE-ID").value = numberValue * pricePerUnit;
        });
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
                const error_overlay = document.getElementById('error_overlay');
                error_overlay.style.display = 'flex';
                setTimeout(() => {
                    error_overlay.style.opacity -=0.01;
                }, 700); 

            } 
            else if (getQueryParam('success_overlay') === 'show') {
                const successOverlay = document.getElementById('success_overlay');
                successOverlay.style.display = 'flex';
                setTimeout(() => {
                    successOverlay.style.opacity -=0.01;
                }, 700); 
                // removeQueryParameter();
            }

            document.getElementById('close_btn').addEventListener('click', function() {
                document.getElementById('error_overlay').style.display = 'none';
            });

            document.getElementById('close_btn2').addEventListener('click', function() {
                document.getElementById('error_overlay2').style.display = 'none';
            });

            function storeItems()
            {
                document.getElementById('QUANTITY-ID').value = document.getElementById('qty').value;
            }

        </script>
</body>
</html>
