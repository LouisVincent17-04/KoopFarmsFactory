<?php

include '../Process/UnauthorizedAccess.php';
include '../Process/AccessPage.php';
include '../Process/CodeConversion.php';

$accessUpdate = canUpdateCategory($pmp_row);
$accessMark = canMarkCategory($pmp_row);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminUpdateCategory.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory Admin</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>

        .table-container {
            max-height: 700px;
            /* min-height: 630px; */
            max-width: 1400px;
            width: 100%;
            margin-left: 1rem;
            margin-right: 1rem;
            overflow: auto;
            border: 1px solid #ccc;
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
            margin-top: 9rem;
            position: relative;
        }

        table {
            width: 100%;
            min-width: 1000px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            height: 3rem;
        }

        .table-container input {
            height: 1.5rem;
        }

        tbody {
            color: black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            position: -webkit-sticky;
            position: sticky;
            top: 2.8rem;
            z-index: 2; /* Ensure headers stay on top */
        }

        .content {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .controls-container {
            background-color: #f9f9f9;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            border-bottom: 1px solid #ddd;
            position: sticky;
            top: 0;
            z-index: 10;
            min-width: 700px;
        }

        .controls-container select,
        .controls-container input {
            margin-left: 10px;
        }

        .pagination {
            padding: 10px;
            text-align: right;
            width: 100%;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        .pagination button {
            padding: 5px 10px;
            margin-left: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
        }

        .pagination button.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        

        /* DataTables wrapper custom styling */
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            background-color: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
        }

        .dataTables_wrapper .dataTables_paginate,
        .dataTables_wrapper .dataTables_info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: white;
            position: sticky;
            bottom: 0;
            z-index: 10;
            width: 100%;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin: 0;
            padding: 0;
        }

        .dataTables_wrapper .dataTables_info {
            margin-left: 1rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-right: 1rem;
        }

        
    </style>
</head>
<body>

        <?php include '../Common/Navbar.php'; 
        include '../Common/StatusOverlay.php'; 
        ?>

    <div class="content_container">
        <div class="content">
            <div class="table-container">
                <div class="controls-container">
                    <label>
                        Show 
                        <select id="entriesPerPage">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        entries
                    </label>
                    
                    <button id="addCategory" onclick="window.location.href='AdminAddCategory.php'">+ Add New category</button>

                    <label>
                        Search: <input type="text" id="searchInput">
                    </label>
                </div>

                <style>
                   
                    .sort-buttons {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        /* background-color: red; */
                        width: 20%;
                        height: 100%;
                    }
                    .sort-buttons .triangle-up, .sort-buttons .triangle-down {
                        width: 0;
                        height: 0;
                        border-left: 5px solid transparent;
                        border-right: 5px solid transparent;
                        cursor: pointer;
                        display: block;
                        margin: 2px 0;
                    }
                    .triangle-up {
                        border-bottom: 8px solid #333;
                    }
                    .triangle-down {
                        border-top: 8px solid #333;
                    }
                    .header{
                        /* background-color: yellow;  */
                        height: 100%; 
                        width: 100%;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                    }

                    .meta-data{
                        height: 100%;
                        display: flex;
                        justify-content: flex-start;
                        align-items: center;
                        width: 80%;
                    }
                </style>

                <table id="dataTable">
                    <thead style="padding: 15px ;">
                        <tr>
                            <th class="sortable" data-sort="id">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>Category ID</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminUpdateInventory.php?sort=asc_prod_id'"></div>
                                        <div class="triangle-down"  onclick="window.location.href='AdminUpdateInventory.php?sort=desc_prod_id'"></div>
                                    </div>
                                </div>
                            </th>
                            

                            <th class="sortable" data-sort="name">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>Category Name</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminUpdateInventory.php?sort=asc_prod_name'"></div>
                                        <div class="triangle-down" onclick="window.location.href='AdminUpdateInventory.php?sort=desc_prod_name'"></div>
                                    </div>
                                </div>
                            </th>                            
                           
                            <th class="sortable" data-sort="modified_by">Modified By</th>
                            <th class="sortable" data-sort="mark_as">Mark As</th>
                            <th class="sortable" data-sort="action">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('../Database/Database.php');
                            $sql = '';
                    
                            if(isset($_GET['sort']))
                            {
                                if($_GET['sort'] == 'asc_prod_id')
                                    $sql = "SELECT * FROM product_categories ORDER BY category_id";
                                elseif($_GET['sort'] == 'asc_prod_name')
                                    $sql = "SELECT * FROM product_categories ORDER BY category_name";
                                elseif($_GET['sort'] == 'desc_prod_id')
                                    $sql = "SELECT * FROM product_categories ORDER BY category_id DESC";
                                elseif($_GET['sort'] == 'desc_prod_name')
                                    $sql = "SELECT * FROM product_categories ORDER BY category_name DESC";

                            }
                            else
                            $sql = "SELECT * FROM product_categories";
                            
                            $category = retrieveRecords($mysqli, "SELECT * FROM product_categories");
                            $result = $mysqli->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    echo "
                                        <tr id='row-{$row['category_id']}'>
                                            <td>
                                                <button class='id-btn'>{$row['category_id']}</button>
                                            </td>
                                            <td><input type='text' value='{$row['category_name']}' class='editable1' data-id='{$row['category_id']}' id='category_name_{$row['category_id']}'></td>

                                            <td>
                                                <button class = 'modif-btn'>{$row['modified_by']}</button>
                                            </td>
                                            <td>

                                                <form action='../Process/MakeUnavailable.php' method='POST'>
                                                    <input type='hidden' name ='marked_as' id ='marked_as' value='{$row['isAvailable']}'>
                                                    <input type='hidden' name ='category_id' id = 'category_id' value='{$row['category_id']}'>";

                                                    if($accessMark == 1)
                                                    echo"<button class='avail-btn' type = 'submit' name = 'category_availability'>".convertAvailability($row['isAvailable'])."</button>";
                                                    else
                                                    echo"<button class='avail-btn' type = 'submit' disabled name = 'category_availability'>".convertAvailability($row['isAvailable'])."</button>";
                                                echo"
                                                </form>

                                            </td>
                                            <td style='max-width: 200px;'>
                                                <form action='../Process/AdminUpdateCategoryProcess.php' method='POST'  style = 'display:flex; '>
                                                    <input type='hidden' name ='category_id_{$row['category_id']}' value='{$row['category_id']}'>
                                                    <input type='hidden' name ='category_name_{$row['category_id']}' id='hidden_category_name_{$row['category_id']}' value=''>
                                                    ";
                                                    if($accessUpdate == 1)  
                                                    echo "<button type='submit' name ='edit-btn' class='edit-btn' data-id='{$row['category_id']}'>Update</button>";
                                                    else
                                                    echo "<button type='submit' name ='edit-btn' disabled class='edit-btn' data-id='{$row['category_id']}'>Update</button>";

                                                echo"
                                                </form>
                                            </td>
                                        </tr>
                                    ";

                                }
                            } else {
                                echo "<tr><td colspan='11'>No rows found.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>

                <div class="pagination">
                    <button id="prevPage" class="disabled">Previous</button>
                    <button id="nextPage">Next</button>
                </div>
            </div>
        </div>
    </div>

    

    <script>
    document.addEventListener('DOMContentLoaded', () => {
    const entriesPerPageSelect = document.querySelector('#entriesPerPage');
    const searchInput = document.querySelector('#searchInput');
    const prevPageButton = document.querySelector('#prevPage');
    const nextPageButton = document.querySelector('#nextPage');
    const rows = Array.from(document.querySelectorAll('#dataTable tbody tr'));

    let currentPage = 1;
    let entriesPerPage = parseInt(entriesPerPageSelect.value, 10);
    let totalPages = Math.ceil(rows.length / entriesPerPage);

    function updatePaginationControls() {
        prevPageButton.classList.toggle('disabled', currentPage === 1);
        nextPageButton.classList.toggle('disabled', currentPage === totalPages);
    }

    function updateTable() {
        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = startIndex + entriesPerPage;

        rows.forEach((row, index) => {
            if (index >= startIndex && index < endIndex && row.style.display !== 'none') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        updatePaginationControls();
    }

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();

        const filteredRows = rows.filter(row => {
            const cells = row.querySelectorAll('td');
            let found = false;

            cells.forEach(cell => {
                const input = cell.querySelector('input');
                if (input) {
                    const cellValue = input.value.toLowerCase();
                    if (cellValue.includes(searchTerm)) {
                        found = true;
                    }
                }
            });

            return found;
        });

        // Update total pages and reset current page
        totalPages = Math.ceil(filteredRows.length / entriesPerPage);
        currentPage = 1;

        // Display filtered rows and update pagination
        rows.forEach(row => {
            if (filteredRows.includes(row)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        updateTable();
    }

    entriesPerPageSelect.addEventListener('change', () => {
        entriesPerPage = parseInt(entriesPerPageSelect.value, 10);
        totalPages = Math.ceil(rows.length / entriesPerPage);
        currentPage = 1; 
        updateTable();
    });

    searchInput.addEventListener('input', filterTable);

    prevPageButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    });

    nextPageButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            updateTable();
        }
    });

    updateTable();
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const id = this.getAttribute('data-id');
            const category_name_input = document.getElementById(`category_name_${id}`);
            const hiddencategoryName = document.getElementById(`hidden_category_name_${id}`);

            hiddencategoryName.value = category_name_input.value;

            const category_category_input = document.getElementById(`category_category_${id}`);
            const hiddencategoryCategory = document.getElementById(`hidden_category_category_${id}`);
            
            hiddencategoryCategory.value = category_category_input.value;

            const price_input = document.getElementById(`category_price_${id}`);
            const hiddenPrice = document.getElementById(`hidden_price_${id}`);

            hiddenPrice.value = price_input.value;

            const quantity_input = document.getElementById(`category_quantity_${id}`);
            const hiddenQuantity = document.getElementById(`hidden_quantity_${id}`);

            hiddenQuantity.value = quantity_input.value;

        });
    });
});

</script>


<script>
   document.addEventListener('DOMContentLoaded', () => {
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    function removeQueryParameter(param) {
        const url = new URL(window.location.href);
        url.searchParams.delete(param);
        window.history.replaceState({}, document.title, url.pathname + url.search);
    }

    function fadeOutOverlay(overlayId, delay) {
        const successOverlay = document.getElementById(overlayId);
        if (successOverlay) {
            successOverlay.style.display = 'flex'; 
            successOverlay.style.opacity = '1'; 

            setTimeout(() => {
                let opacity = 1;

                function updateOpacity() {
                    opacity -= 0.01; 
                    if (opacity <= 0) {
                        opacity = 0;
                        successOverlay.style.display = 'none'; 
                    }
                    successOverlay.style.opacity = opacity; 
                }

                const fadeInterval = setInterval(() => {
                    updateOpacity();
                    if (opacity <= 0) {
                        clearInterval(fadeInterval);
                        removeQueryParameter(overlayId.split('Div')[0] + '_success');
                    }
                }, 10);
            }, delay); 
        }
    }

    if (getQueryParam('update_success') === 'true') {
        fadeOutOverlay('updateSuccessDiv', 700);
    }

    if (getQueryParam('delete_success') === 'true') {
        fadeOutOverlay('deleteSuccessDiv', 700);
    }
});

</script>

</body>
</html>