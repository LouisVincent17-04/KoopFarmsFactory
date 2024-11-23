
<?php
    include('../Database/config.php');
    session_start();

    $ADMIN_USERNAME = "";

    if (isset($_SESSION['username_input'])) 
        {
            $ADMIN_USERNAME = $_SESSION['username_input'];
        } else {
            
        } 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $PRODUCT_NAME = htmlspecialchars($_POST['PRODUCT_NAME']);
        $CATEGORY = htmlspecialchars($_POST['CATEGORY']);
        $PRODUCT_UNIT = htmlspecialchars($_POST['PRODUCT_UNIT']);
        $PRICE_PER_UNIT_VALUE = htmlspecialchars($_POST['PRICE_PER_UNIT_VALUE']);
        $IMAGE_PATH = htmlspecialchars($_POST['IMAGE_PATH']);

    }

    echo "Product Name: ". $PRODUCT_NAME. "<br>";
    echo "Category: ". $CATEGORY. "<br>";
    echo "Product Unit: ". $PRODUCT_UNIT. "<br>";
    echo "Price per Unit: ". $PRICE_PER_UNIT_VALUE. "<br>";
    echo "Image Path: ". $IMAGE_PATH. "<br>";

    $DATE_CREATED = date('Y-m-d');
    $TIME_CREATED = date('H:i:s');
    $TEMP_QUANTITY = 0;

    $sql = "SELECT product_id FROM inventory order by product_id DESC LIMIT 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $PRODUCT_ID = $row['product_id'] + 1;

    $sql = "INSERT INTO inventory (product_id, product_name, product_category, quantity, units_used, price_per_unit, date_added, time_added, image_path, date_last_edited, time_last_edited, user)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issdsdssssss",$PRODUCT_ID, $PRODUCT_NAME, $CATEGORY, $TEMP_QUANTITY, $PRODUCT_UNIT, $PRICE_PER_UNIT_VALUE, $DATE_CREATED,
    $TIME_CREATED, $IMAGE_PATH, $DATE_CREATED, $TIME_CREATED, $ADMIN_USERNAME);
    $stmt->execute();
    $stmt->close();

    $CATEGORY_ID = 0;

    $sql = "SELECT * FROM product_categories WHERE description = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $CATEGORY);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $CATEGORY_ID = $row['category_id'];
    $stmt->close();

    echo "Cat ID: ". $CATEGORY_ID. "<br>";

    $sql = "SELECT item_id FROM product_item order by item_id DESC LIMIT 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $ITEM_ID = $row['item_id'] + 1;
 
    $sql = "INSERT INTO product_item (item_id, item_desc, category_id, item_price, img_loc) VALUES (?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("isids", $ITEM_ID, $PRODUCT_NAME, $CATEGORY_ID, $PRICE_PER_UNIT_VALUE, $IMAGE_PATH);
    $stmt->execute();
    $stmt->close();

    header('Location:../Pages/AdminAddProduct.php');
   
?>
