<?php

include '../Process/UnauthorizedAccess.php';
include '../Process/AccessPage.php';
canAddNewProduct($pmp_row);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminAddProduct.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Koop Farm Factory Admin</title>
</head>
<body>

    <?php include '../Common/Navbar.php'; ?>
    <div class="content_container">
        <div class="success_overlay" id="success_overlay">
            <div class="message_field">
                <h2>Logged In Successfully</h2>
            </div>
        </div>

        <div class="content">

            <form id="uploadForm" action="UploadPhoto.php" method="post" enctype="multipart/form-data" style="display:none;">
                <input type="file" name="fileToUpload" id="hiddenFileInput">
                <input type="submit" value="Upload Image" name="submit">
            </form>

            <div class="photoDiv">
                <div id="addPhotoDiv">
                    + Add Product Photo
                </div>
                <input type="file" id="fileInput" accept="image/*">
            </div>

            <div class="attributeDiv">
                <div class="infoDiv">
                    
                    <input type="text" name="productName" id="productName"  placeholder="Enter Product Name">

                    <select name="category" id="category">
                    <?php

                        $sql = "select * from product_categories where id > 1 order by category_id";

                        if ($result = $mysqli->query($sql)) {
                            $json = mysqli_fetch_all ($result, MYSQLI_ASSOC);
                        }
                        
                            foreach ($json as $category)
                            {
                                echo 
                                "
                                <option value='".$category['description']."'>".$category['description']."</option>
                                ";
                            }

                    ?>
                        
                    </select>

                </div>
                
                <div class="infoDivs">
                    <div class="infoDiv1">
                        <h4>Product Unit</h4>
                        <select name="selectUnit" id="selectUnit">Select Unit
                            <option value="KG">KG</option>
                            <option value="PCS">PCS</option>
                        </select>
                    </div>

                    <div class="infoDiv2">
                        <h4>Price Per Unit</h4>
                        <input type="number" id="pricePerUnitValue" name="pricePerUnitValue" min="0.1" value="0.1" step="0.05">

                    </div>

                    <div class="infoDiv3">
                        <form action="../Process/AdminAddProductProcess.php" id="hidden_form" method="POST">

                            <input type="hidden" name="PRODUCT_NAME" id="PRODUCT_NAME" value="">
                            <input type="hidden" name="CATEGORY" id="CATEGORY" value="">
                            <input type="hidden" name="PRODUCT_UNIT" id="PRODUCT_UNIT" value="">
                            <input type="hidden" name="PRICE_PER_UNIT_VALUE" id="PRICE_PER_UNIT_VALUE" value="">
                            <input type="hidden" name="IMAGE_PATH" id="IMAGE_PATH" value="">

                            <button type="submit" onclick="submitData()">ADD</button>
                        </form>
                        
                    </div>
                </div>

            </div>
            
        </div>
    </div>    

    <style>

        .content{
            /* background-color: red; */
            margin-top: 7rem;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        /* .content_container{
            /* background-color: pink; 
            
        } */

        .photoDiv{
            /* background-color: violet; */
            height: 35vh;
        }

        .infoDiv3 button{
            height: 2.5rem;
            width: 65%;
            color: white;
            background-color: #ffd200;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 20px;
            border-width: 0;
            outline: 0;
            cursor: pointer;
        }

      

        .infoDiv1{
            display: flex;
            height: 180px;
            /* background-color: red; */
            width: 15vw;
            flex-direction: column;
            align-items:  flex-start;
            margin-left: 5rem;
            
        }
        .infoDiv2{
            display: flex;
            height: 180px;
            /* background-color: blue; */
            width: 15vw;
            flex-direction: column;
            align-items: flex-start;
        }
        .infoDiv3, #hidden_form{
            display: flex;
            height: 180px;
            /* background-color: violet; */
            width: 15vw;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }

        .infoDiv3 #hidden_form button{
            margin-bottom: 1rem;
        }


        .infoDiv1 select, .infoDiv2 input, .infoDiv3 input{
            height: 2.5rem;
            width: 65%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1rem;
            border-radius: 10px;
            color: black;
            outline: 0;
            border-width: 0;
            padding-left: 1rem;
        }

        h4{
            font-family: Arial, Helvetica, sans-serif;
            color: white;
            width: 12rem;
            
        }

        
    </style>

    <script>
        
        function submitData() {
        document.getElementById('PRODUCT_NAME').value = document.getElementById('productName').value;
        document.getElementById('CATEGORY').value = document.getElementById('category').value;
        document.getElementById('PRODUCT_UNIT').value = document.getElementById('selectUnit').value;
        document.getElementById('PRICE_PER_UNIT_VALUE').value = document.getElementById('pricePerUnitValue').value;
        
        var fileInput = document.getElementById('fileInput');
        var hiddenFileInput = document.getElementById('hiddenFileInput');
        
        if (fileInput.files.length > 0) {
            hiddenFileInput.files = fileInput.files;
            document.getElementById('IMAGE_PATH').value = fileInput.files[0].name;
        } else {
            document.getElementById('IMAGE_PATH').value = '';
        }
        document.getElementById('hidden_form').submit();
    }

            
        
    </script>

    <script>
        document.getElementById('addPhotoDiv').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    var addPhotoDiv = document.getElementById('addPhotoDiv');
                    addPhotoDiv.innerHTML = ''; 
                    addPhotoDiv.appendChild(img);

                    var fileNameElement = document.getElementById('fileName');
                    fileNameElement.textContent = "File: " + file.name;

                    var hiddenFileInput = document.getElementById('hiddenFileInput');
                    hiddenFileInput.files = event.target.files;
                    document.getElementById('uploadForm').submit();
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function removeQueryParameter() {
            const url = new URL(window.location.href);
            url.searchParams.delete('success_overlay');
            window.history.replaceState({}, document.title, url.pathname);
        }

        if (getQueryParam('success_overlay') === 'show') {
        const successOverlay = document.getElementById('success_overlay');
        successOverlay.style.display = 'flex';
        
        setTimeout(() => {
            successOverlay.style.opacity -=0.01;
        }, 700); 
        removeQueryParameter();
        }

        if (getQueryParam('logout_successful') === 'show') {
        const successOverlay = document.getElementById('logout_successful');
        successOverlay.style.display = 'flex';
        localStorage.setItem('buttonsHidden', 'false');
        setTimeout(() => {
            successOverlay.style.opacity -=0.01;
        }, 700); 
        removeQueryParameter();
        }
        
    </script>
</body>
</html>