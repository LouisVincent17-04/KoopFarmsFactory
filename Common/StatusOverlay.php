<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/StatusOverlay.css">
</head>
<body>

<?php 
    if (isset($_GET['success_overlay']) && isset($_GET['success_msg'])) {
        $success_msg = htmlspecialchars($_GET['success_msg']); // Sanitize user input
        echo "<div class='success_overlay' id='success_overlay'>
                <div class='message_field'>
                    <h2>{$success_msg}</h2>
                </div>
            </div>";
    }  
?>

<?php
    if (isset($_GET['error_overlay']) && isset($_GET['error_msg'])) {
        $error_msg = htmlspecialchars($_GET['error_msg']); // Sanitize user input
        echo "<div class='error_overlay' id='error_overlay'>
                <div class='message_field'>
                    <img src='../ImageIcons/warning_icon.png' alt='err_warn' id='error_icon'>
                    <h2>{$error_msg}</h2>
                </div>
                <div class='exit_field'>
                    <button id='close_btn'>X</button>
                </div>
            </div>";
    }
?>

<script>
    document.getElementById('close_btn')?.addEventListener('click', function() {
        document.getElementById('error_overlay').style.display = 'none';
    });

    
</script>

<script>
    function fadeIn(element) {
        let opacity = 1; 
        element.style.opacity = opacity;

        let interval = setInterval(function() {
            opacity -= 0.05; 
            element.style.opacity = opacity;

            if (opacity <= 0) {
                clearInterval(interval); 
            }
        }, 10); 
    }    
        let element = document.getElementById('success_overlay');
        fadeIn(element);
    
</script>


</body>
</html>
