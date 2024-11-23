<?php
    session_start();

    include '../Database/Database.php';

    include "LogInFirst.php";
    loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');

    if (isset($_POST['saveUsername'])) {
        $newUsername = $_POST['username'];
    
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    
        try 
        {
            $sql = "UPDATE users SET 
            username = ?, 
            datetime_edited = NOW() 
            WHERE user_id = ?";
    
            $stmt = $mysqli->prepare($sql);
    
            if ($stmt === false) {
                throw new Exception('Prepare failed: ' . htmlspecialchars($mysqli->error));
            }
    
            $stmt->bind_param("si", $newUsername, $_SESSION['USER_INFO']['user_id']);
            
            if($stmt->execute())
            {     
                $temp_arr = [];
                foreach (retrieveRecords($mysqli, "SELECT * FROM users WHERE user_id = ".$_SESSION['USER_INFO']['user_id']) as $subArray) {
                    $temp_arr = array_merge($temp_arr, $subArray);
                }
                $_SESSION['USER_INFO'] = $temp_arr;
                header('Location: ../Pages/Profile.php?success_overlay=show&success_msg=Username%20Changed%20Successfully.');
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                header('Location: ../Pages/Profile.php?error_overlay=show&error_msg='. $e->getCode());
            } else {
                header('Location: ../Pages/Profile.php?error_overlay=show&error_msg='. $e->getCode());
            }
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $mysqli->close();
        }
    }

    elseif(isset($_POST['saveMobileNumber']))
    {
        $newMobileNumber = $_POST['mobileNumber'];
        $sql = "UPDATE users 
        SET phone_number = ?, 
        datetime_edited = NOW() 
        WHERE user_id = ?";

        $stmt = $mysqli->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($mysqli->error));
        }

        $stmt->bind_param("si",$newMobileNumber, $_SESSION['USER_INFO']['user_id']);

        if ($stmt->execute()) {
            $temp_arr = [];
            foreach (retrieveRecords($mysqli, "SELECT * FROM users WHERE user_id = ".$_SESSION['USER_INFO']['user_id']) as $subArray) {
                $temp_arr = array_merge($temp_arr, $subArray);
            }
            $_SESSION['USER_INFO'] = $temp_arr;
            header('Location: ../Pages/Profile.php?success_overlay=show');
        } else {
            header('Location: ../Pages/Profile.php?error_overlay=show');
        }

        $stmt->close();
        $mysqli->close();
    }

    elseif(isset($_POST['saveFullName']))
    {
        $newFullName = $_POST['fullName'];
        $sql = "UPDATE users SET 
        full_name = ?, 
        datetime_edited = NOW() 
        WHERE user_id = ?";

        $stmt = $mysqli->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($mysqli->error));
        }

        $stmt->bind_param("si", $newFullName, $_SESSION['USER_INFO']['user_id']);

        if ($stmt->execute()) {
            $temp_arr = [];
            foreach (retrieveRecords($mysqli, "SELECT * FROM users WHERE user_id = ".$_SESSION['USER_INFO']['user_id']) as $subArray) {
                $temp_arr = array_merge($temp_arr, $subArray);
            }
            $_SESSION['USER_INFO'] = $temp_arr;

            header('Location: ../Pages/Profile.php?success_overlay=show');
        } else {
            header('Location: ../Pages/Profile.php?error_overlay=show');
        }

        $stmt->close();
        $mysqli->close();
    }

?>