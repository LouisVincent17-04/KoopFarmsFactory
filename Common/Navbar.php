
<head>
  <meta charset="utf-8">
  <title>Responsive Navbar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/Navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<?php 
    if(!isset($_SESSION['USER_INFO']) || (isset($_SESSION['USER_INFO']) && $_SESSION['USER_INFO']['user_type'] != 2))
    {
        echo"
            <nav>
                <input type='checkbox' id='check'>

                
                <label for='check' class='checkbtn'>
                    <i class='fas fa-bars'></i>
                </label>

                    <img src='../ImageIcons/KFF_OFFICIAL_LOGO.png' alt='KFF Logo' id='kff_logo'>

                <ul>
                    <li><a href='home.php' id='home'>Home</a></li>
                    <li><a href='#' id='contact_us'>Contact Us</a></li>
                    <li><a href='Shop.php' id='shop'>Shop</a></li>
                    <li><a href='PurchaseHistory.php' id='purchaseHistory'>Purchase History</a></li>
                    <li><a href='TrackOrder.php' id='trackOrder'>Track Order</a></li>
                ";        
                    // if(!isset($_SESSION['USER_INFO']))
                    // {
                    //     session_destroy();
                    //     header('Location:login.php');
                    // }

                    if(isset($_SESSION['USER_INFO']['user_type']))
                    {
                        
                        echo"
                        <li><a href='Profile.php' id='username_' style='font-weight:bold;'>".$_SESSION['USER_INFO']['username']."</a></li>
                        <li><a href='../Process/LogoutProcess.php'>Logout</a></li>
                        ";
                    }
                    else
                    {
                        echo"
                        <li><a href='Login.php' id='login_'>Login</a></li>
                        <li><a href='Register.php'>Register</a></li>
                        ";
                    }
                    
                    echo"
                    <li><a href='Cart.php' id='cart'>My Cart</a></li>
                </ul>
            </nav>
        ";
    }
    elseif($_SESSION['USER_INFO']['user_type'] == 2)
    {
        echo"
            <nav>
                <input type='checkbox' id='check'>

                
                <label for='check' class='checkbtn'>
                    <i class='fas fa-bars'></i>
                </label>

                    <img src='../ImageIcons/KFF_OFFICIAL_LOGO.png' alt='KFF Logo' id='kff_logo'>

                <ul>
                    <li><a href='AdminDashboard.php' id='dashboard'>Dashboard</a></li>
                    <li><a href='AdminProducts.php' id='products'>Products</a></li>
                    <li><a href='AdminOrders.php' id='orders'>Orders</a></li>
                    <li><a href='AdminSettings.php' id='settings'>Settings</a></li>
                    <li><a href='AdminContentManagement.php' id='content_management'>Content Management</a></li>
                    <li><a href='AdminCustomers.php' id='customers'>Customers</a></li>
                    <li><a href='AdminAccounts.php' id='accounts'>Accounts</a></li>
                    <li><a href='../Process/LogoutProcess.php' id='logout'>Logout</a></li>
            
                </ul>
            </nav>
        ";
    }
?>

<script>
    function adjustMargin() {
    let width = window.innerWidth;
    let marginValue = width - 1370;

    let usernameElement = document.getElementById('username_');
    let loginElement = document.getElementById('login_');

    if (usernameElement) {
        if(width > 1385)
        usernameElement.style.marginLeft = marginValue + "px";
        else
        usernameElement.style.marginLeft = 0 + "px";
    }

    if (loginElement) {
        if(width > 1385)
        loginElement.style.marginLeft = marginValue + "px";
        else
        loginElement.style.marginLeft = 0 + "px";
    }
}

adjustMargin();

window.addEventListener('resize', adjustMargin);


</script>