<?php
session_start();

error_reporting(0);
include "../Database/config.php";
include '../Process/UserInactivity.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Shop.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory</title>
    
</head>
<body>
    
<?php
	$sql = "SELECT category_id, category_name, category_img from product_categories where category_id >= 1 ORDER by category_id";
	if ($result = $mysqli->query($sql)) {
		$json = mysqli_fetch_all ($result, MYSQLI_ASSOC);
	}
?>
    <?php include '../Common/Navbar.php'; ?>
    <div class="content_container">
        <div class="chicken-items-container" id="items-container">

        <?php
            foreach ($json as $value) {
                echo "
                <div class='chicken-item'>
                    <a href='itemlist.php?id=".$value["category_id"]."'>
                        <img src='../Category/".$value["category_img"].".jpg' alt=''> 
                        <div class='description-div'>
                            <h3 class='item-description'>".$value["category_name"]."</h3>
                        </div>
                    </a>
                </div>
                ";
            }
        ?>
        </div>
    </div>

    <script>
        document.getElementById('search_box').addEventListener('input', function() {
            const query = this.value;

            if (query.length >= 0) { // Only perform search if input length is at least 1 character
                fetch('search_handler.php?query=' + encodeURIComponent(query))
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('items-container');
                        container.innerHTML = ''; // Clear previous results

                        if (data.length > 0) {
                            data.forEach(product => {
                                const productDiv = document.createElement('div');
                                productDiv.className = 'chicken-item';
                                productDiv.innerHTML = `
                                    <a href='itemlist.php?id=${product.category_id}'>
                                        <img src='../Category/${product.category_img}.jpg' alt=''>
                                        <div class='description-div'>
                                            <h3 class='item-description'>${product.category_name}</h3>
                                        </div>
                                    </a>
                                `;
                                container.appendChild(productDiv);
                            });
                        } else {
                            container.innerHTML = '<p>No products found.</p>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } 
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

    <script>
        document.querySelectorAll('.chicken-item').forEach(product => {
            product.addEventListener('click', function() {
                const image = this.getAttribute('data-image');
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                
                const item_image = {
                    image, name, price
                };

                localStorage.setItem('item-image', JSON.stringify(item_image));
                window.location.href = 'Item.php'; 
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('option-items').addEventListener('change', function() {
                var selectedValue = this.value;
                var itemDiv = document.getElementById('items-container');
                if (selectedValue == '100' || selectedValue == '101') {
                    itemDiv.style.display = 'flex';
                } else {
                    itemDiv.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
