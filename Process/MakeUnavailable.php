<?php
    session_start();
    include('../Database/config.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_availability'])) 
    {
        $user = $_SESSION['USER_INFO']['user_id']; 
        $product_id = $_POST['product_id'];
        $marked_as = $_POST['marked_as'];

        if(isset($_POST['marked_as']))
        {
            $marked_as = $_POST['marked_as'];
            $changeTo = 0;

            if($marked_as == 0) $changeTo = 1;
            elseif($marked_as == 1) $changeTo = 0;
            
            $sql = "UPDATE product_items 
            SET  isAvailable = ?, datetime_edited = NOW(),  modified_by = ?
            WHERE product_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('sii', $changeTo, $user,  $product_id);

            if ($stmt->execute()) 
            {
                $stmt->close();
                header('Location: ../Pages/AdminUpdateInventory.php?update_success=true');
                exit();
            } 
            else 
            { 

            }
        }

    }

    else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_availability'])) 
    {
        $user = $_SESSION['USER_INFO']['user_id']; 
        $category_id = $_POST['category_id'];
        $marked_as = $_POST['marked_as'];

        if($marked_as == 'Available')
        {
            $changeTo = 'Not Available';
            
            $sql = "UPDATE product_categories 
            SET modified_by = ?, isAvailable = ?, datetime_edited = NOW()
            WHERE category_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ssi',  $user, $changeTo,  $category_id);

            if ($stmt->execute()) 
            {
                $stmt->close();
                header('Location: ../Pages/AdminUpdateCategory.php?success_overlay=show&success_msg=Updated%20Successfully');
                exit();
            } 
            else 
            { 

            }
        }

        else if($marked_as == 'Not Available')
        {
            $changeTo = 'Available';
            
            $sql = "UPDATE product_categories 
            SET date_edited = CURDATE(), time_edited = CURTIME(), mark_as = ?,  user = ?
            WHERE category_id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ssi', $changeTo, $user,  $category_id);

            if ($stmt->execute()) 
            {
                $stmt->close();
                header('Location: ../Pages/AdminUpdateCategory.php?success_overlay=show&success_msg=Updated%20Successfully');
                exit();
            } 
            else 
            { 

            }
        }
    }

    else
    {
        echo "Not working";
    }
?>
