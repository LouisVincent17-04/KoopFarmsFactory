<?php
    $itemImg = $_POST['IMAGE-ID'] ?? '';
    $itemName = $_POST['ITEM-NAME-ID'] ?? '';
    $itemUnit = $_POST['UNIT-ID'] ?? '';
    $totalPrice = $_POST['TOTAL-PRICE-ID'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Image Details</title>
</head>
<body>
    <h1>Image Details</h1>
    <p>Item Name: <?php echo htmlspecialchars($itemName); ?></p>
    <p>Image Source: <?php echo htmlspecialchars($itemImg); ?></p>
    <p>Image Unit: <?php echo htmlspecialchars($itemUnit); ?></p>
    <p>Total Price: <?php echo htmlspecialchars($totalPrice); ?></p>
</body>
</html>