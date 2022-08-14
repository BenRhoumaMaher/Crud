<?php
session_start();
error_reporting(0);
require('../app/app.php');
$errorEmail = $errorPassword = $msg = $erroractivation =  "";
if(is_post()) {

    $email = chars($_POST['email']);
    $password = chars($_POST['password']);
    $remember = $_POST['remember'];
    $forgot = $_POST['forgot'];
    $errorEmail = validate_required_input($email, "EMAIL", "email");
    $errorPassword = validate_required_input($password, "PASSWORD", "password");
    if(empty($errorPassword && $errorEmail)){
        $msg = credentialscheck($email,$password);
        $erroractivation = checkactivation($email);
    }
    if(isset($remember)){
        $expireTime = time() + 60*60*24*365*10;
        setcookie("M&CODE",$email,$expireTime);
    }
    if(isset($forgot)){
        redirect("forgot.php");
    }
    if( $errorEmail == "" && $errorPassword == "" && $msg == "" && $erroractivation == "") {
                $_SESSION['email'] = $email;
                redirect("../index.php");
    }
}
view("Authentification/login");