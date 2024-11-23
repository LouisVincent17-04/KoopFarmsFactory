<?php session_start(); 

include '../Process/UserInactivity.php';
include '../Process/LogInFirst.php';
homeLogOut();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/home.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory</title>

    
</head>
<body>
    <?php include '../Common/Navbar.php'; ?>
    <div class="content_container">
    <?php include '../Common/StatusOverlay.php'; ?>

        <div class="intro_text">
            <div class="content">
                <h3>
                    KOOP FARM FACTORY
                </h3>
                <p>
                    Experience the best of both worlds with our
                    premium selection of fresh meat and vegetables.
                    Delivered straight from the farm to your doorstep, 
                    ensuring quality and convenience 

                </p>

                <div class="start_shopping">
                    <button id="start_shopping_button">Shop Now</button>

                    <script>
                        document.getElementById("start_shopping_button").addEventListener("click", function(event) {
                            event.preventDefault();
                            window.location.href = "Shop.php";
                        });

                        function getQueryParam(param) {
                            const urlParams = new URLSearchParams(window.location.search);
                            return urlParams.get(param);
                        }

                        function removeQueryParameter() {
                            const url = new URL(window.location.href);
                            url.searchParams.delete('success_overlay');
                            window.history.replaceState({}, document.title, url.pathname);
                        }

                        if (getQueryParam('success_overlay') === 'show') {
                        const successOverlay = document.getElementById('success_overlay');
                        successOverlay.style.display = 'flex';
                        
                        setTimeout(() => {
                            successOverlay.style.opacity -=0.01;
                        }, 700); 
                        removeQueryParameter();

                        // Optional: Store the state in local storage
                        localStorage.setItem('buttonsHidden', 'true');
                        }


                        if (getQueryParam('logout_successful') === 'show' || getQueryParam('logout_successful') === 'session_logged_out') {
                        const query_params = getQueryParam('logout_successful');
                        const successOverlay = document.getElementById('logout_successful');
                        if(query_params!='session_logged_out')
                        successOverlay.style.display = 'flex';
                        localStorage.setItem('buttonsHidden', 'false');
                        setTimeout(() => {
                            successOverlay.style.opacity -=0.01;
                        }, 700); 
                        removeQueryParameter();

                        // Optional: Store the state in local storage
                        
                        }

                        
                    </script>
                </div>
            </div>
            
        </div>

        <div class="product_image">
            <img src="../ImageIcons/product_img.png" id="productImg" alt="Image Of The Product">
        </div>
    </div>
    <script src="redirect.js"></script>
    
</body>
</html>