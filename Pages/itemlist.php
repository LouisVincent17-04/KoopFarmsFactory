<?php
session_start();

error_reporting(0);
include("../Database/config.php");
include '../Process/UserInactivity.php';

$results_per_page = 8;

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$start_from = ($page - 1) * $results_per_page;

$sql = "SELECT COUNT(*) FROM product_items WHERE category_id = ".$_GET['id'].";";
$result = $mysqli->query($sql); 
$row = $result->fetch_row();
$total_items = $row[0];

$total_pages = ceil($total_items / $results_per_page);

$sql = "SELECT product_id, product_name, price_per_unit, img_loc FROM product_items 
        WHERE category_id = ".$_GET['id']." 
        ORDER BY product_name
        LIMIT $start_from, $results_per_page";
$result = $mysqli->query($sql);
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/itemlist.css">
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
        <div class="product-item-container" id="items-container">
            <?php foreach ($items as $item): ?>
                <div class='product-item'  data-name='<?php echo $item["product_name"]; ?>' data-price='<?php echo $item["price_per_unit"]; ?>' data-image='Items/<?php echo $item["img_loc"].".jpg"; ?>'>
                    <a href=<?php echo"Item.php?id_=".$item['product_id'] ?>>
                        <?php 

                         ?>
                        <img src='../Items/<?php echo $item["img_loc"].".jpg"; ?>' alt='<?php echo $item["product_name"]; ?>'>
                        <div class='description-div'>
                            <p class='item-description'><?php echo $item["product_name"]; ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <style>
            .pagination {
                display: flex;
                justify-content: center;
                margin-top: 20px;
                /* background-color: red; */
            }
            .pagination a {
                margin: 0 5px;
                padding: 8px 16px;
                text-decoration: none;
                background-color: #f2f2f2;
                color: white;
                border: 1px solid #ddd;
                border-radius: 5px;
                height: 2.5rem;
                text-align: center;
                justify-self: center;
                font-size: larger;
                font-family:Arial, Helvetica, sans-serif;
                background-color: transparent;
                margin-bottom: 3rem ;
            }
            .pagination a:hover {
                background-color: #ddd;
            }
            .pagination a.active {
                background-color: #007bff;
                color: white;
                border: 1px solid #007bff;
            }

            .pagination img{
                width: 1.5rem;
                height: 1.5rem;
            
            }

            
            
        </style>

            <div class="pagination">

                <?php if ($page > 1): ?>
                    <a href="?id=<?php echo $_GET['id']; ?>&page=<?php echo $page - 1; ?>">
                        <img src="../ImageIcons/arrow-left.png" alt="">
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?id=<?php echo $_GET['id']; ?>&page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if ($page < $total_pages): ?>
                    <a href="?id=<?php echo $_GET['id']; ?>&page=<?php echo $page + 1; ?>">
                        <img src="../ImageIcons/arrow-right.png" alt="">
                    </a>
                <?php endif; ?>

            </div>

    </div>
    <script src="redirect.js"></script>

    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function checkDisplay(id) {
                const element = document.getElementById(id);
                return window.getComputedStyle(element).display === 'flex';
            }

            if (localStorage.getItem('buttonsHidden') === 'true') {
                document.getElementById('login').style.display = 'none';
                document.getElementById('register').style.display = 'none';
                document.getElementById('login2').style.display = 'none';
                document.getElementById('register2').style.display = 'none';
                document.getElementById('logout').style.display = 'flex';
                document.getElementById('logout2').style.display = 'flex';
                document.getElementById('usernameDisplay').style.display = 'flex';
            } else if (checkDisplay('login') || checkDisplay('register') || checkDisplay('login2') || checkDisplay('register2')) {
                document.getElementById('logout').style.display = 'none';
                document.getElementById('logout2').style.display = 'none';
                document.getElementById('usernameDisplay').style.display = 'none';
            }

            if (localStorage.getItem('buttonsHidden') === 'false') {
                document.getElementById('login').style.display = 'flex';
                document.getElementById('register').style.display = 'flex';
                document.getElementById('login2').style.display = 'flex';
                document.getElementById('register2').style.display = 'flex';
                document.getElementById('logout').style.display = 'none';
                document.getElementById('logout2').style.display = 'none';
                document.getElementById('usernameDisplay').style.display = 'none';
            }
        });
    </script>

    <script>
        document.querySelectorAll('.chicken-item').forEach(product => {
            product.addEventListener('click', function() {
                const image = this.getAttribute('data-image');
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                
                const item_image = { image, name, price };

                localStorage.setItem('item-image', JSON.stringify(item_image));
                window.location.href = 'Item.php'; 
            });
        });
    </script>
</body>
</html>
