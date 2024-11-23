<?php 

include '../Process/UnauthorizedAccess.php';
include '../Process/AccessPage.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/AdminContentManagement.css">
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
        </div>
    </div>    
</body>
</html>