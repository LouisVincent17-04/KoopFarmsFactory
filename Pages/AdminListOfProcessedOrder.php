<?php
    include '../Process/UnauthorizedAccess.php';
    include '../Process/AccessPage.php';
    $processedBy = 3;
    include('../Database/config.php');
    $sql = '';
    $temp = 'Failed';
    
    if(isset($_GET['sort']))
    {
        $col = substr($_GET['sort'], 4, strlen($_GET['sort']) -  3);
        if(substr($_GET['sort'], 0, 3) == 'asc')
        {
            $sql = "SELECT orders.order_id, orders.order_status, orders.processed_by, users.full_name, product_items.product_name,
            product_items.price_per_unit, product_items.units_used, order_items.quantity, order_items.total_price
            FROM order_items 
            JOIN orders ON order_items.order_id = orders.order_id
            JOIN users ON order_items.user_id = users.user_id
            JOIN product_items ON order_items.product_id = product_items.product_id
            WHERE orders.order_status = 2 ORDER BY $col; ";
        }
            
        elseif(substr($_GET['sort'], 0, 3) == 'des')
        {
            $sql = "SELECT orders.order_id, orders.order_status, orders.processed_by, users.full_name, product_items.product_name,
            product_items.price_per_unit, product_items.units_used, order_items.quantity, order_items.total_price
            FROM order_items 
            JOIN orders ON order_items.order_id = orders.order_id
            JOIN users ON order_items.user_id = users.user_id
            JOIN product_items ON order_items.product_id = product_items.product_id
            WHERE orders.order_status = 2 ORDER BY $col DESC; ";
        }
            
    }
    elseif(isset($_GET['processed_by_filter']))
    {
        if($_GET['processed_by_filter'] == 1)
        {
            $condition = "orders.order_status = 2 AND orders.processed_by = ".$_SESSION['USER_INFO']['user_id']." ORDER BY order_id;";
            $processedBy = 1;
        }

        elseif($_GET['processed_by_filter'] == 2)
        {
            $condition = " orders.order_status = 2 AND orders.shop_id = 1 ORDER BY order_id;";
            $processedBy = 2;
        }

        elseif($_GET['processed_by_filter'] == 3) 
        {
            $condition = " orders.order_status = 2  ORDER BY order_id;";
            $processedBy = 3;
        }

        $sql = "SELECT orders.order_id, orders.order_status, orders.processed_by, users.full_name, product_items.product_name,
        product_items.price_per_unit, product_items.units_used, order_items.id, order_items.quantity, order_items.total_price
        FROM order_items 
        JOIN orders ON order_items.order_id = orders.order_id
        JOIN users ON orders.user_id = users.user_id
        JOIN product_items ON order_items.product_id = product_items.product_id
        WHERE ".$condition;
    }
    else
    {
        $sql = "SELECT orders.order_id, orders.order_status, orders.processed_by, users.full_name, product_items.product_name,
        product_items.price_per_unit, product_items.units_used, order_items.id, order_items.quantity, order_items.total_price
        FROM order_items 
        JOIN orders ON order_items.order_id = orders.order_id
        JOIN users ON orders.user_id = users.user_id
        JOIN product_items ON order_items.product_id = product_items.product_id
        WHERE orders.order_status = 2 ORDER BY order_id;";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminListOfProcessedOrder.css">
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
            max-width: 1400px;
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
    <?php 
    include '../Common/Navbar.php'; 
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

                    <label>
                        <select id="processBySelection">
                            <option value="1" <?php if($processedBy == 1) echo "selected"; else echo ""; ?> >Processed By: Me</option>
                            <option value="2" <?php if($processedBy == 2) echo "selected"; else echo "";  ?> >Processed By: Current Shop</option>
                            <option value="3" <?php if($processedBy == 3) echo "selected"; else echo "";  ?> >Processed By: Everybody</option>
                        </select>
                    </label>
                    
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
                    <thead>
                        <tr>
                            <th class="sortable" data-sort="id">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>Order ID</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminListOfOrders.php?sort=asc_order_id'"></div>
                                        <div class="triangle-down"  onclick="window.location.href='AdminListOfOrders.php?sort=des_order_id'"></div>
                                    </div>
                                </div>
                            </th>

                            <th class="sortable" data-sort="full_name">Customer Name</th>

                            <th class="sortable" data-sort="product">Product</th>
                            <th class="sortable" data-sort="quantity">Quantity</th>
                            <th class="sortable" data-sort="quantity">Unit</th>
                            <th class="sortable" data-sort="price">Price</th>
   
                            <th class="sortable" data-sort="total_price">Total Price</th>
                            <th class="sortable" data-sort="action">Action</th>     
                            <th class="sortable" data-sort="undo_action">Undo Action</th>         
                            <th class="sortable" data-sort="undo_action">Processed By</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                                
                            $result = $mysqli->query($sql);
                            
                            if ($result->num_rows > 0) {
                                $index = 0;
                                $prev_order_id = 0;
                                $curr_order_id = 0;
                                $temp_count = 0;

                                while ($row = $result->fetch_assoc()) {
                                    $curr_order_id = $row['order_id'];
                                    $button_stat = 'enabled';
                                    if($_SESSION['USER_INFO']['user_id'] != $row['processed_by'])
                                    $button_stat = " disabled style='opacity: 0.5'";
                                    
                                    $total = $row['price_per_unit'] * $row['quantity'];
                                    echo"<tr id='row-{$row['id']}'>";
                                    if($curr_order_id != $prev_order_id && $temp_count == 0)
                                    {
                                        $temp_count++;
                                        echo "
                                            <td>{$row['order_id']}</td>
                                            <td style='max-width: 160px;'>
                                                <form method='POST' action='AdminUserDetails.php'>
                                                    <input type='hidden' name='customer' value='".$row['full_name']."'>
                                                    <button class='cust-btn'>{$row['full_name']}</button>
                                                </form>
                                            </td>
                                        ";
                                    }
                                    else
                                    {
                                        $temp_count = 0;
                                        echo "
                                            <td> </td>
                                            <td> </td>
                                        ";
                                    }
                                    
                                        
                                        echo"
                                            <td style='max-width: 150px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'>{$row['product_name']}</td>
                                            <td class='qty' style='width: 50px;'>
                                                <form action='../Process/AdminUpdateQuantity.php' method='POST'>
                                                    <input class ='qty_input' name='updated_qty_{$row['id']}' type='number' value='{$row['quantity']}' style='width: 100px; padding-left: 5px; '> 
                                                    <input class ='id_input' name='updated_id_{$row['id']}' type='hidden' value='{$row['id']}' >
                                                    <input class ='id_input' name='updated_order_id_{$row['id']}' type='hidden' value='{$row['order_id']}' >
                                                    <input class ='id_input' name='updated_price_{$row['id']}' type='hidden' value='{$row['price_per_unit']}' > 
                                                    <input class ='id_input' name='updated_processed_by_{$row['id']}' type='hidden' value='{$row['processed_by']}' >
                                                    <button class='qty-btn' ".$button_stat.">
                                                        <svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                                        <path d='M7.38228 10.5688C6.95801 10.9224 6.90068 11.553 7.25425 11.9772C7.60781 12.4015 8.23838 12.4588 8.66265 12.1053L7.38228 10.5688ZM12 8.02247L12.6402 7.25425C12.2693 6.94521 11.7306 6.94521 11.3598 7.25425L12 8.02247ZM15.3373 12.1053C15.7616 12.4588 16.3921 12.4015 16.7457 11.9772C17.0993 11.553 17.0419 10.9224 16.6177 10.5688L15.3373 12.1053ZM11 15.9775C11 16.5298 11.4477 16.9775 12 16.9775C12.5523 16.9775 13 16.5298 13 15.9775H11ZM8.66265 12.1053L12.6402 8.79069L11.3598 7.25425L7.38228 10.5688L8.66265 12.1053ZM11.3598 8.79069L15.3373 12.1053L16.6177 10.5688L12.6402 7.25425L11.3598 8.79069ZM11 8.02247V15.9775H13V8.02247H11ZM17.6569 6.34315C20.781 9.46734 20.781 14.5327 17.6569 17.6569L19.0711 19.0711C22.9763 15.1658 22.9763 8.83418 19.0711 4.92893L17.6569 6.34315ZM17.6569 17.6569C14.5327 20.781 9.46734 20.781 6.34315 17.6569L4.92893 19.0711C8.83418 22.9763 15.1658 22.9763 19.0711 19.0711L17.6569 17.6569ZM6.34315 17.6569C3.21895 14.5327 3.21895 9.46734 6.34315 6.34315L4.92893 4.92893C1.02369 8.83418 1.02369 15.1658 4.92893 19.0711L6.34315 17.6569ZM6.34315 6.34315C9.46734 3.21895 14.5327 3.21895 17.6569 6.34315L19.0711 4.92893C15.1658 1.02369 8.83418 1.02369 4.92893 4.92893L6.34315 6.34315Z' fill='white'/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>  
                                            <td>{$row['units_used']}</td>
                                            <td>".number_format(doubleval($row['price_per_unit']), 2, '.','')."</td>
                                            <td>".number_format(doubleval($total), 2, '.','')."</td>
                                            <td>
                                                <form action='../Process/UpdateOrderStatus.php' method='POST'>
                                                    <input type='hidden' name='processed' value=".$row['processed_by'].">
                                                    <input type='hidden' name ='order_id' id ='order_id' value='".$row['order_id']."'> 
                                                    <input type='hidden' name ='order_stat' id ='order_stat' value='".$row['order_status']."'> 
                                                    <button type='submit' name ='edit-btn' class='edit-btn' data-id='{$row['id']}' ".$button_stat.">Process Order</button>
                                                </form>
                                            </td>

                                            <td>
                                                <form action='../Process/UpdateOrderStatus.php' method='POST'>
                                                    <input type='hidden' name='processed' value=".$row['processed_by'].">
                                                    <input type='hidden' name ='order_id' id ='order_id' value='".$row['order_id']."'> 
                                                    <input type='hidden' name ='order_stat' id ='order_stat' value='".$row['order_status']."'> 
                                                    <button type='submit' name ='undo-btn' class='undo-btn' data-id='{$row['id']}' ".$button_stat.">Undo Action</button>
                                                </form>
                                            </td>
                                            <td class='processed_by'>
                                                <form method='POST' action='AdminUserDetails.php'>
                                                    <input type='hidden' name='processed_by' value='".$row['processed_by']."'>
                                                    <button class='id-btn'>{$row['processed_by']}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    ";
                                    $index++;
                                    $prev_order_id = $curr_order_id;
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
            const searchInput = document.getElementById('searchInput');
            const entriesPerPageSelect = document.getElementById('entriesPerPage');
            const prevPageButton = document.getElementById('prevPage');
            const nextPageButton = document.getElementById('nextPage');
            const pageInfo = document.getElementById('pageInfo');
            const rows = Array.from(document.querySelectorAll('#dataTable tbody tr'));
            let entriesPerPage = parseInt(entriesPerPageSelect.value, 10);
            let currentPage = 1;
            let totalPages = Math.ceil(rows.length / entriesPerPage);
            let processed_by_filter = document.getElementById("processBySelection");
            
            


            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    let found = false;
                    cells.forEach(cell => {
                        const cellText = cell.textContent.toLowerCase();
                        if (cellText.includes(searchTerm)) {
                            found = true;
                        }
                    });
                    row.style.display = found ? '' : 'none';
                });
                const visibleRows = rows.filter(row => row.style.display !== 'none');
                totalPages = Math.ceil(visibleRows.length / entriesPerPage);
                currentPage = 1;
                updateTable();
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

            function updatePaginationControls() {
                prevPageButton.disabled = currentPage === 1;
                nextPageButton.disabled = currentPage === totalPages;
                pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
            }

            entriesPerPageSelect.addEventListener('change', () => {
                entriesPerPage = parseInt(entriesPerPageSelect.value, 10);
                const visibleRows = rows.filter(row => row.style.display !== 'none');
                totalPages = Math.ceil(visibleRows.length / entriesPerPage);
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

        // document.getElementById('processBySelection').addEventListener('change', function(event) {
        //     window.location.href = "../Process/SelectProcessByFilter.php?processed_by_filter=" + event.target.value +;
        // });


</script>



<script>
    document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const id = this.getAttribute('data-id');
            const user_type_input = document.getElementById(`user_type_${id}`);
            const hiddenUserType = document.getElementById(`hidden_user_type_${id}`);

            hiddenUserType.value = user_type_input.value;

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


<script>
    document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const id = this.getAttribute('qty-btn');
            const product_name_input = document.getElementById(`updated_qty_${id}`);
            const hiddenProductName = document.getElementById(`updated_qty_${id}`);

            hiddenProductName.value = product_name_input.value;

            const product_category_input = document.getElementById(`product_category_${id}`);
            const hiddenProductCategory = document.getElementById(`hidden_product_category_${id}`);
            
            hiddenProductCategory.value = product_category_input.value;

            const price_input = document.getElementById(`product_price_${id}`);
            const hiddenPrice = document.getElementById(`hidden_price_${id}`);

            hiddenPrice.value = price_input.value;

            const quantity_input = document.getElementById(`product_quantity_${id}`);
            const hiddenQuantity = document.getElementById(`hidden_quantity_${id}`);

            hiddenQuantity.value = quantity_input.value;

        });
    });
});

</script>

</body>
</html>









































