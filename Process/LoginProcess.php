<?php
include("../Database/Database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['getUsername']);
    $password = htmlspecialchars($_POST['getPassword']);

    if ($username == '' || $password == '') {
        $error_msg = urlencode("Please Fill In All Required Fields");
        header("Location: ../Pages/login.php?error_overlay=show&error_msg=$error_msg");
        exit();
    }

    $sql = "SELECT password_hash, user_type FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($db_password_hash, $user_type);
            $stmt->fetch();

            if (password_verify($password, $db_password_hash)) {
                session_start();

                $temp_arr = [];
                foreach (retrieveRecords($mysqli, "SELECT * FROM users WHERE username = '".$username."';") as $subArray) {
                    $temp_arr = array_merge($temp_arr, $subArray);
                }

                $_SESSION['USER_INFO'] = $temp_arr;

                if ($user_type == 1) {
                    header('Location: ../Pages/home.php?success_overlay=show&success_msg=Logged%20In%20Successfully');
                } elseif ($user_type == 2) {
                    header('Location: ../Pages/AdminDashboard.php?success_overlay=show&success_msg=Logged%20In%20Successfully');
                } else {
                    // Fallback for unexpected user_type values
                    header('Location: ../Pages/login.php?error_overlay=show&error_msg=' . urlencode("Unauthorized user type."));
                }
                exit();
            } else {
                // Incorrect password
                header("Location: ../Pages/login.php?error_overlay=show&error_msg=" . urlencode("Invalid Username Or Password"));
                exit();
            }
        } else {
            // Username not found
            header("Location: ../Pages/login.php?error_overlay=show&error_msg=" . urlencode("Invalid Username Or Password"));
            exit();
        }
    } else {
        // Query execution failed
        header("Location: ../Pages/login.php?error_overlay=show&error_msg=" . urlencode("Query execution failed."));
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
