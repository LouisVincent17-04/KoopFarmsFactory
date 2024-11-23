<?php

include('../Database/config.php');
include "LogInFirst.php";
loginAccFirst('error_overlay=show&error_msg=You%20Need%20To%20Login%20First');
$sql = "SELECT * FROM acc_management_privileges WHERE user_id = ".$_SESSION['USER_INFO']['user_id'];

$result = $mysqli->query($sql);
$amp_row = array();

if ($result->num_rows > 0) {
    $amp_row = $result->fetch_assoc();
} else {
    echo "No data found HERE.".$active_username;
}

function canAccessAccountsPrivileges($row){
    if($row['viewAcc'] == 1) 
    {    
    }
    elseif($row['viewAcc'] == 0) 
    {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    }
}


function canAccessManageUserType($row){
    if($row['manage_user_type'] == 1) 
    {
    }

    elseif($row['manage_user_type'] == 0)
    {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    } 
}

$sql1 = "SELECT * FROM prod_management_privileges WHERE user_id = ".$_SESSION['USER_INFO']['user_id'];

$result1 = $mysqli->query($sql1);
$pmp_row = array();

if ($result1->num_rows > 0) {
    $pmp_row = $result1->fetch_assoc();
} else {
    echo "No data found HERE.".$active_username;
}

function canAddNewProduct($row){
    if($row['add_prod'] == 1) 
    {    
    }
    elseif($row['add_prod'] == 0) 
    {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    }
}

function canMarkProduct($row){
    if($row['mark_prod'] == 1) 
    {    
        return 1;   
        exit(); 
    }
    elseif($row['mark_prod'] == 0) 
    {
        return 0;   
        exit(); 
    }
}

function canUpdateProduct($row){
    if($row['update_prod'] == 1) 
    {
        return 1;   
        exit(); 
    }
    elseif($row['update_prod'] == 0) 
    {
        return 0;
        exit();
    }

    
}

function canDeleteProduct($row){
    if($row['delete_prod'] == 1) 
    {    
        return 1;   
        exit(); 
    }
    elseif($row['delete_prod'] == 0) 
    {
        return 0;   
        exit(); 
    }
}

function canAddNewCategory($row){
    if($row['add_cat'] == 1) 
    {    
    }
    elseif($row['add_cat'] == 0) 
    {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    }
}

function canMarkCategory($row){
    if($row['mark_cat'] == 1) 
    {    
        return 1;   
        exit(); 
    }
    elseif($row['mark_cat'] == 0) 
    {
        return 0;   
        exit(); 
    }
}

function canUpdateCategory($row){
    if($row['update_cat'] == 1) 
    {    
        return 1;   
        exit(); 
    }
    elseif($row['update_cat'] == 0) 
    {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    }
}

function canDeleteCategory($row){
    if($row['delete_cat'] == 1) 
    {    
    }
    elseif($row['delete_cat'] == 0) 
    {
        header('HTTP/1.1 403 Forbidden');
        exit('Access denied');
    }
}

?>