<?php
// Sample data array
$items = range(1, 50); // An array with numbers from 1 to 50

// Define the number of results per page
$results_per_page = 5;

// Determine the total number of pages available
$number_of_pages = ceil(count($items) / $results_per_page);

// Determine which page number visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Determine the starting index for the results on the displaying page
$start_index = ($page - 1) * $results_per_page;

// Slice the array to get the items for the current page
$current_page_items = array_slice($items, $start_index, $results_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pagination Example</title>
</head>
<body>
    <h1>Pagination Example</h1>
    <ul>
        <?php foreach ($current_page_items as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
    </ul>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $number_of_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>"<?php if ($i == $page) echo ' style="font-weight: bold;"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $number_of_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</body>
</html>
