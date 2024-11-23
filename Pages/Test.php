<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if(isset($_GET['processed_by_filter']))
        {
            echo $_GET['processed_by_filter'];
        }
    ?>
</body>
</html>