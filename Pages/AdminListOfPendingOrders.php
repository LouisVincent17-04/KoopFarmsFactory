<?php
    include '../Process/UnauthorizedAccess.php';
    include '../Process/AccessPage.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminListOfPendingOrders.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory Admin</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>

        .table-container {
            max-height: 700px;
            max-width: 1400px;
            width: 100%;
            margin-left: 1rem;
            margin-right: 1rem;
            overflow: auto;
            border: 1px solid #ccc;
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
            position: relative;
            margin-top: 30px;
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

        @media all and (max-width: 834px){
            .content{
               padding: 0 20px;
            }

        }
        
    </style>
</head>



<body>

    <?php include '../Common/Navbar.php'; ?>
    <?php include '../Common/StatusOverlay.php'; ?>
    
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
                        Search: <input type="text" id="searchInput">
                    </label>
                </div>

                <style>
                   
                    
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

                            <th class="sortable" data-sort="email">Customer Info</th>

                            <th class="sortable" data-sort="order_date">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>Order Date</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminListOfOrders.php?sort=asc_order_date'"></div>
                                        <div class="triangle-down" onclick="window.location.href='AdminListOfOrders.php?sort=des_order_date'"></div>
                                    </div>
                                </div>
                            </th>

                            <th class="sortable" data-sort="total_amount">Total Amount</th>
                            <th class="sortable" data-sort="payment_method">Payment Method</th>
                            <th class="sortable" data-sort="shipping_cost">Shipping Cost</th>
                            <th class="sortable" data-sort="order_status">Action</th>
                 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('../Database/config.php');
                            $sql = '';
                    
                            if(isset($_GET['sort']))
                            {
                                $col = substr($_GET['sort'], 4, strlen($_GET['sort']) -  3);
                                if(substr($_GET['sort'], 0, 3) == 'asc')
                                    $sql = "SELECT * FROM order_items  WHERE order_status = 1 ORDER BY $col;";
                                elseif(substr($_GET['sort'], 0, 3) == 'des')
                                    $sql = "SELECT * FROM order_items  WHERE order_status = 1 ORDER BY $col DESC";
                            }

                            else
                            $sql = "SELECT orders.order_id, orders.user_id, orders.order_timedate, orders.order_status, orders.total_amount, orders.payment_method, 
                            orders.shipping_cost, orders.customer_notes
                            FROM orders  WHERE order_status = 1";
                            
                            
                            $result = $mysqli->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                        <tr id='row-{$row['order_id']}'>
                                            <td>{$row['order_id']}</td>
                                            <td>
                                                <form method='POST' action='AdminUserDetails.php'>
                                                    <input type='hidden' value='".$row['user_id']."'>
                                                    <button class='id-btn'>{$row['user_id']}</button>
                                                </form>
                                            </td>
                                            <td>{$row['order_timedate']}</td>
                                            <td>{$row['total_amount']}</td>
                                            <td>{$row['payment_method']}</td>
                                            <td>{$row['shipping_cost']}</td>   
                                            <td style='max-width: 200px;'>
                                                <form action='../Process/UpdateOrderStatus.php' method='POST'  style='display:flex;'>
                                                    
                                                    <input type='hidden' name ='order_id' id ='order_id' value='".$row['order_id']."'> 
                                                    <input type='hidden' name ='order_stat' id ='order_stat' value='".$row['order_status']."'> 
                                                    <button type='submit' name ='edit-btn' class='action-button1' data-id='{$row['order_id']}'>Confirm</button>
                                                    <button type='submit' name ='del-btn' class='action-button2' data-id='{$row['order_id']}'>Delete</button>

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
            const searchInput = document.getElementById('searchInput');
            const entriesPerPageSelect = document.getElementById('entriesPerPage');
            const prevPageButton = document.getElementById('prevPage');
            const nextPageButton = document.getElementById('nextPage');
            const pageInfo = document.getElementById('pageInfo');
            const rows = Array.from(document.querySelectorAll('#dataTable tbody tr'));
            let entriesPerPage = parseInt(entriesPerPageSelect.value, 10);
            let currentPage = 1;
            let totalPages = Math.ceil(rows.length / entriesPerPage);

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


</script>

<script>
//     document.addEventListener('DOMContentLoaded', () => {
//     const editButtons = document.querySelectorAll('.edit-btn');

//     editButtons.forEach(button => {
//         button.addEventListener('click', function(event) {
//             const id = this.getAttribute('data-id');
//             const order_status = document.getElementById(`order_status_${id}`);
//             const order_status = document.getElementById(`order_status_${id}`);
//             hiddenUserType.value = user_type_input.value;

//         });
//     });
// });

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
            successOverlay.style.opacity = 1; 

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









































