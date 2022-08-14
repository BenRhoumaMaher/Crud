<?php 
session_start();
require("../app/app.php");
$token = $_GET['token'];
if(isset($token)) {
    if(is_post()){
        $password = chars($_POST['password']);
        $hash = Encryption($password);
        $confirm = chars($_POST['confirm']);
        $errorPassword = validate_required_input($password, "PASSWORD", "password");
        if(empty($errorPassword)){
            $errorConfirm = confirm($password, $confirm);
        }
        if($errorPassword == "" && $errorConfirm == "") {
            $sql = "UPDATE registration SET password = :password WHERE token = :token";
            $query = $dbc->prepare($sql);
            $query->bindParam(':password',$hash);
            $query->bindParam(':token',$token);
            $query->execute();
            if($query) {
                $_SESSION["message"] = ' your password has been updated';
                redirect("login.php");
             }
    }
}
    }
view("Authentification/recover");