<?php
session_start();
require("../app/app.php");
$token = $_GET['token'];
if(isset($token)) {
    $sql = "UPDATE registration SET active = 'ON' WHERE token = ?";
    $query = $dbc->prepare($sql);
    $query->bindParam(':token',$token);
    $query->execute([$token]);
    if($query) {
        $_SESSION["message"] = ' your account is activated now';
        redirect("login.php");
    } else {
        redirect("registration.php");
    }
}