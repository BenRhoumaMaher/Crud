<?php
session_start();
require("../app/app.php");
sure_authenticated();
$email = $_GET['email'];
    if(isset($email)) {
        $sql = "DELETE FROM users WHERE email = ?";
        $query = $dbc->prepare($sql);
        $query->bindParam(':email',$email);
        $query->execute([$email]);
        if($query) {
            $_SESSION["message"] = ' user has been deleted';
            redirect("../index.php");
        }
    }