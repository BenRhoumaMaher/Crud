<?php
session_start();
require('../app/app.php');
$errorName = $errorLastName = $errorEmail = $errorPhone = $errorCountry = $errorGender = $errorMessage = $errorPassword = $errorConfirm = $msg = "";
if(is_post()) {
    
    $name = chars($_POST['name']);
    $lastname = chars($_POST['lastname']);
    $email = chars($_POST['email']);
    $phone = chars($_POST['phone']);
    $country = chars($_POST['country']);
    $gender = chars($_POST['gender']);
    $message = chars($_POST['message']);
    $password = chars($_POST['password']);
    $confirm = chars($_POST['confirm']);
    
    $errorName = validate_required_input($name, "NAME", "string");
    $errorLastName = validate_required_input($lastname, "LASTNAME", "string");
    $errorEmail = validate_required_input($email, "EMAIL", "email");
    $msg = emailExist($email);
    $errorPhone = validate_required_input($phone, "PHONE", "integer");
    $errorCountry = validate_required_input($country, "COUNTRY", "string");
    $errorGender = validate_required_input($gender, "GENDER", "string");
    $errorPassword = validate_required_input($password, "PASSWORD", "password");
    $errorConfirm = confirm($password, $confirm);
    //bin2hex gets the hexadecimal value
    //openssl_random_pseudo_bytes gets a random strings
    $token = bin2hex(openssl_random_pseudo_bytes(30));

    if( $errorName == "" && $errorLastName == "" && $errorEmail == "" && $errorPhone == "" && $errorCountry == "" 
    && $errorGender == "" && $errorPassword == "" && $errorConfirm == "" && $msg == "") {
        $hash = Encryption($password);
        $sql = "INSERT INTO `registration` (name,lastname,email,phone,country,gender,message, password,token,active)
        VALUES(:name, :lastname, :email, :phone, :country, :gender, :message, :password,:token, 'OFF')";
        //prepare statement
        $query = $dbc->prepare($sql);
        //bind parameters
        $query->bindParam(':name', $name);
        $query->bindParam(':lastname', $lastname);  
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':country', $country);
        $query->bindParam(':gender', $gender);
        $query->bindParam(':message', $message);
        $query->bindParam(':password', $hash);
        $query->bindParam(':token', $token);
        //execution
        $query->execute();
        //check that the data has been inserted if the lastinsert id is greater than 0
        if($query) {
            $subject = "Registration for ".$email;
            $body = "Thank you for your registration " .$name. "<br>" ." Here's your link of activation : http://localhost/forms/Authentification/activation.php?token=" .$token;
            $email_to = $email;
            $email_from = "maherbenrhoumaa@gmail.com";
            $sender_name = "M&CODE";
            require('../PHPMailer/PHPMailerAutoload.php');
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "maherbenrhoumaa@gmail.com";
            $mail->Password = "njfzlecqqnisnohh";
            $mail->Port = 25;
            $mail->IsHTML(true);
            $mail->From = $email_from;
            $mail->FromName = $sender_name;
            $mail->Sender = $email_from; // indicates ReturnPath header
            $mail->AddReplyTo($email_from, "No Reply"); // indicates ReplyTo headers
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($email_to);
            if($mail->Send()){
                $_SESSION["message"] = ' Check your email for the activation link';
                redirect("login.php");
            }
        } 
    }
}
view("Authentification/registration");