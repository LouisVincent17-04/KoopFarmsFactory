    <?php
    session_start();
    include "LogInFirst.php";
    loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');
    
    if(isset($_SESSION['order_done']) && isset($_POST['returnButton']))
    {
        if($_SESSION['order_done'] == true)
        {
            if(isset($_SESSION['receipt_information']) && isset($_SESSION['prod_info_arr']))
            {
                unset($_SESSION['receipt_information']);
                unset($_SESSION['prod_info_arr']);

                if(!isset($_SESSION['order_done']))
                $_SESSION['order_done'] = false;

                
            }
        }
    }

    elseif(isset($_SESSION['order_done']))
    {
        if($_SESSION['order_done'] == true)
        {
            if(isset($_SESSION['receipt_information']) && isset($_SESSION['prod_info_arr']))
            {
                unset($_SESSION['receipt_information']);
                unset($_SESSION['prod_info_arr']);

                if(!isset($_SESSION['order_done']))
                $_SESSION['order_done'] = false;


            }
        }
    }

    $url = '../Pages/Shop.php';
    header('Location: '. $url);
        
    ?>