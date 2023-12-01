<?php
require_once('config/database.php');


if(isset($_POST['submit-button'])) {
    //get form data
    $userEmail = filter_var($_POST['userEmail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userPassword = filter_var($_POST['userPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if(!$userEmail) {
        $_SESSION['sign-in-error'] = "Email is required";
    } elseif(!$userPassword) {
        $_SESSION['sign-in-error'] = "Password is required";
    } else {
        //fetch user from database
        $fetch_user_query = "SELECT * FROM tbllecturer WHERE UserEmail = '$userEmail' "; 
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if(mysqli_num_rows($fetch_user_result) == 1) { //user was found in db 
            //convert record into associative array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['PasswordHashed'];

            if(password_verify($userPassword, $db_password)) {
                $_SESSION['user-id'] = $user_record['LecturerID']; 

                if($user_record['IsAdmin'] == 1) {
                    $_SESSION['user-is-admin'] = true;
                }

                header('Location: index.php'); //log in user after success
            } else {
                $_SESSION['sign-in-error'] = "No such login or password. Please check correctness and try again";    
            }

        } else {
            $_SESSION['sign-in-error'] = "User not found";    
        }
    }

    //if problems arise
    if(isset($_SESSION['sign-in-error'])) {
        $_SESSION['signin-data'] = $_POST;
        header('Location: signin.php');
        die();
    }

} else {
    header('Location: signin.php');
    die();
}