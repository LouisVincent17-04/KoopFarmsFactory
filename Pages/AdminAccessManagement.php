<?php
    include '../Process/UnauthorizedAccess.php';
    include '../Process/AccessPage.php';
    include 'Key.php';
    canAccessManageUserType($amp_row);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminAccessManagement.css">
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
                    <thead>
                        <tr>
                            <th class="sortable" data-sort="id">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>User ID</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminAccessManagement.php?sort=asc_user_id'"></div>
                                        <div class="triangle-down"  onclick="window.location.href='AdminAccessManagement.php?sort=des_user_id'"></div>
                                    </div>
                                </div>
                            </th>
                            

                            <th class="sortable" data-sort="username">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>Username</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminAccessManagement.php?sort=asc_username'"></div>
                                        <div class="triangle-down" onclick="window.location.href='AdminAccessManagement.php?sort=des_username'"></div>
                                    </div>
                                </div>
                            </th>

                            <th class="sortable" data-sort="created_at">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>Created At</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminAccessManagement.php?sort=asc_created_at'"></div>
                                        <div class="triangle-down" onclick="window.location.href='AdminAccessManagement.php?sort=des_created_at'"></div>
                                    </div>
                                </div>
                            </th>

                            <th class="sortable" data-sort="updated_at">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>Updated At</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminAccessManagement.php?sort=asc_created_at'"></div>
                                        <div class="triangle-down" onclick="window.location.href='AdminAccessManagement.php?sort=des_created_at'"></div>
                                    </div>
                                </div>
                            </th>

                            <th class="sortable" data-sort="user-type">
                                <div class="header">
                                    <div class="meta-data">
                                        <h4>User Type</h4>
                                    </div>
                                    
                                    <div class="sort-buttons">
                                        <div class="triangle-up" onclick="window.location.href='AdminAccessManagement.php?sort=asc_user_type'"></div>
                                        <div class="triangle-down" onclick="window.location.href='AdminAccessManagement.php?sort=des_user_type'"></div>
                                    </div>
                                </div>
                            </th>      
                            <th class="sortable" data-sort="shop">Shop</th>                     
                            <th class="sortable" data-sort="action">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('../Database/Database.php');
                            $sql = '';

                            $shoplist = retrieveRecords($mysqli, "SELECT * FROM shop;");
                            
                    
                            if(isset($_GET['sort']))
                            {
                                $col = substr($_GET['sort'], 4, strlen($_GET['sort']) -  3);
                                if(substr($_GET['sort'], 0, 3) == 'asc')
                                    $sql = "SELECT *
                                    FROM acc_management_privileges 
                                    JOIN users ON acc_management_privileges.user_id = users.user_id
                                    ORDER BY $col; ";
                                elseif(substr($_GET['sort'], 0, 3) == 'des')
                                    $sql = "SELECT *
                                    FROM acc_management_privileges 
                                    JOIN users ON acc_management_privileges.user_id = users.user_id; ";
                            }
                            else
                            $sql = "SELECT *
                            FROM acc_management_privileges 
                            JOIN users ON acc_management_privileges.user_id = users.user_id; ";
                            
                            $result = $mysqli->query($sql);

                            
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                        <tr id='row-{$row['user_id']}'>
                                            <td style='max-width: 120px;'>{$row['user_id']}</td>
                                            <td style='max-width:150px; min-width:150px;' >{$row['username']}</td>
                                            <td style='max-width:100px; min-width:100px;'>{$row['datetime_created']}</td> 
                                            <td style='max-width:100px; min-width:100px;'>{$row['datetime_updated']}</td>
                                            <td style='max-width:100px; min-width:100px;'>
                                                <input type='text' style='max-width:100px; min-width:100px;' value='{$row['user_type']}' class='editable' data-id='{$row['user_id']}' id='user_type_{$row['user_id']}'>
                                            </td>

                                            <td>";
                                            if($row['user_type'] == 2)
                                            {
                                                echo "
                                                <form class='shopSelectionForm' action='../Process/AdminUpdateAccounts.php' method='POST'>
                                                    <input type='hidden' name='shop_user_id_".$row['user_id']."' value='".$row['user_id']."'>
                                                    <select class='shopSelection' name='selected_option_".$row['user_id']."' onchange='submitShopForm(event)'> 
                                                        <option value='0'>Select Shop</option>";
                                                        foreach ($shoplist as $shop) {
                                                            $adminlist = retrieveRecords($mysqli, "SELECT * FROM admin WHERE user_id =".$row['user_id']);
                                                            $select_shop = ($adminlist[0]['shop_id'] == $shop['shop_id']) ? ' selected' : '';
                                                            echo "
                                                            <option value='".$shop['shop_id']."'".$select_shop.">".$shop['shop_name']."</option>";
                                                        }
                                                        
                                                echo "
                                                    </select>
                                                </form>";

                                            }
                                            else
                                            {
                                                echo "";
                                            }
                                            
                                            echo"
                                            </td>

                                            <td>
                                                <form action='../Process/AdminUpdateAccounts.php' method='POST'>
                                                    <input type='hidden' name ='user_id' value='{$row['user_id']}'>
                                                    
                                                    <input type='hidden' name ='user_type' value='' id='hidden_user_type_{$row['user_id']}'>
                                                    <button type='submit' name ='edit-btn' class='edit-btn' data-id='{$row['user_id']}'>Update</button>
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

    function submitShopForm(event) {
    const form = event.target.form;
    const selectedOptionValue = event.target.value;

    const userId = form.querySelector("input[type='hidden']").value;

    const encryptedStore = btoa(selectedOptionValue);
    const encryptedUserId = btoa(userId);  
    const encryptedStoreLabel = btoa(<?php echo json_encode($key1) ?>);  
    const encryptedUserIdLabel = btoa(<?php echo json_encode($key2) ?>);

    window.location.href = '../Process/AdminUpdateAccounts.php?' + encryptedStoreLabel + '=' + encryptedStore + '&' +
    encryptedUserIdLabel + '=' + encryptedUserId;
}




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
});

</script>


</body>
</html>









































