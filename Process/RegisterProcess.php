<?php
include("../Database/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['getUsername']);
    $password = htmlspecialchars($_POST['getPassword']);
    $confirm_password = htmlspecialchars($_POST['getConfirmPassword']);

    if ($password !== $confirm_password) {
        header('Location: ../Pages/Register.php?error_overlay=show&error_msg=Password%20Don\'t%20Match');
        exit();
    }
    if(strlen($password) < 8)
    {
        header('Location: ../Pages/Register.php?error_overlay=show&error_msg=Password%20Minimum%20Of%208%20Characters');
        exit();
    }
    if(strlen($username) > 20)
    {
        header('Location: ../Pages/Register.php?error_overlay=show&error_msg=Username%20Must%20Not%20Exceed%2020Characters');
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $default_usertype = 1;
    $sql = "INSERT INTO users (username, password_hash, user_type, datetime_added, datetime_edited) VALUES (?, ?, ?, NOW(), NOW())";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($mysqli->error));
    }

    $sql = "SELECT * FROM users"; 

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $temp = mysqli_fetch_all ($result, MYSQLI_ASSOC);

        foreach($temp as $t)
        {
            if($t['username'] == $username)
            {
                header('Location: ../Pages/Register.php?error_overlay=show&error_msg=Sorry,%20the%20username%20you
                %20have%20chosen%20is%20already%20taken,%20Please try%20a%20different%20one.');
                exit();
            }
        }
    }


    $stmt->bind_param("ssi", $username, $password_hash, $default_usertype);
    if ($stmt->execute()) 
    { 
        //////////////////////////////////////// PRODUCT MANAGEMENT PRIVILEGES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        
        $sql = "SELECT * FROM users ORDER BY user_id DESC LIMIT 1";

        $result = $mysqli->query($sql);

        $username = '';
        $latest_id = 0;

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $username = $row['username'];
            $latest_id = (int)$row['user_id'];

        } else {
            echo "No data found.";
        }

        $sql = "INSERT INTO prod_management_privileges (user_id, add_prod, mark_prod, update_prod, delete_prod, add_cat,
        mark_cat, update_cat, delete_cat) 
        VALUES (?,0,0,0,0,0,0,0,0)";

        $stmt = $mysqli->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($mysqli->error));
        }

        $stmt->bind_param("i", $latest_id);

        if ($stmt->execute()) 
        {
        } 
        else 
        {
            echo "Failed";
        }
        //////////////////////////////////////// ACCOUNT MANAGEMENT PRIVILEGES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        $sql = "INSERT INTO acc_management_privileges (user_id, view_acc, manage_user_type, datetime_created, datetime_updated) 
        VALUES (?,0,0, NOW(), NOW())";

        $stmt = $mysqli->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($mysqli->error));
        }

        $stmt->bind_param("i", $latest_id);

        if ($stmt->execute()) {
            header('Location: ../Pages/Register.php?success_overlay=show&success_msg=Account%20Registered%20Successfully');
        } else {
            header('Location: ../Pages/Register.php?error_overlay=show');
        }
    } 
    $stmt->close();
    $mysqli->close();
    
    exit();
}
?>
