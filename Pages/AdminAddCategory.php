<?php


include '../Process/UnauthorizedAccess.php';
include "../Process/AccessPage.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminAddCategory.css">
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

            <form id="uploadForm" action="../Process/UploadPhoto.php" method="post" enctype="multipart/form-data" style="display:none;">
                <input type="file" name="fileToUpload" id="hiddenFileInput">
                <input type="submit" value="Upload Image" name="submit">
            </form>

            <div class="photoDiv">
                <div id="addPhotoDiv">
                    + Add Category Photo
                </div>
                <input type="file" id="fileInput" accept="image/*">
            </div>

            <div class="attributeDiv">
                <div class="infoDiv">   
                    <input type="text" name="category" id="category"  placeholder="Enter Category Name">
                </div>
    
                <div class="button_div">
                    <form action="../Process/AdminAddProductProcess.php" id="hidden_form" method="POST">

                        <input type="hidden" name="CATEGORY_NAME" id="CATEGORY_NAME" value="">
                        <input type="hidden" name="IMAGE_PATH" id="IMAGE_PATH" value="">

                        <button type="submit" onclick="submitData()">ADD CATEGORY</button>
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>    

    <style>

        .button_div button{
            height: 3rem;
            width: 15rem;
            border-radius: 2rem;
            border-width: 0px;
            color: white;
            background-color:#ffb400;
            font-size: medium;
            margin-top: 0px;
        }

        .photoDiv{
            height: 20rem;
        }

       .infoDiv{
        margin: 0px;
        /* background-color: red; */
        height: 5rem;
        align-items: center;
        width: 25rem;
        margin-bottom: 2rem;
       }

       .infoDiv input{
        width: 25rem;
       }

        .content{
            margin-top: 7rem;
            display: flex;
            width: 100%;
            flex-direction: column;
            /* background-color: pink; */
            align-items: center;
        }

        .attributeDiv{
            display: flex;
            flex-direction: column;
            align-items: center;
            /* background-color: lightblue; */
            
        }

        h4{
            font-family: Arial, Helvetica, sans-serif;
            color: white;
            width: 12rem;
            
        }
        
    </style>

    <script>
        
        function submitData() {
        document.getElementById('CATEGORY_NAME').value = document.getElementById('category').value;
        
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

        document.addEventListener("DOMContentLoaded", function()
        {
            const hamburger_button = document.getElementById("hamburger");
            const dropdown = document.getElementById('navDropdown');
        
            hamburger_button.addEventListener('click', function (){
                if(dropdown.style.display ==='flex'){
                    dropdown.style.display = 'none';
                }
                else{
                    dropdown.style.display = 'flex';
                }
            });
        });
        
    </script>

    <script>

    document.addEventListener("DOMContentLoaded", function () {
        const hamburger_button = document.getElementById("hamburger");
        const dropdown = document.getElementById('navDropdown');

        hamburger_button.addEventListener('click', function () {
            // Toggle dropdown visibility
            dropdown.style.display = (dropdown.style.display === 'flex') ? 'none' : 'flex';
        });

        // Optionally, close the dropdown when clicking outside of it
        document.addEventListener('click', function (event) {
            if (!dropdown.contains(event.target) && !hamburger_button.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    });
    </script>

</body>
</html>