<?php
session_start();   
require('app/app.php');
ensure_authenticated();
if(isset($_REQUEST['add'])){
    
    $name = chars($_POST['name']);
    $lastname = chars($_POST['lastname']);
    $email = chars($_POST['email']);
    $country = chars($_POST['country']);
    $job = chars($_POST['job']);
    $age = chars($_POST['age']);
    
    $errorName = validate_required_input($name, "NAME", "string");
    $errorLastName = validate_required_input($lastname, "LASTNAME", "string");
    $errorCountry = validate_required_input($country, "COUNTRY", "string");
    $errorJob = validate_required_input($job, "JOB", "string");
    $errorAge = validate_required_input($age, "AGE", "integer");
    $errorEmail = validate_required_input($email, "EMAIL", "email");
    $msg = emailExisting($email);
    
    if( $errorName == "" && $errorLastName == "" && $errorEmail == "" && $errorJob == "" && $errorCountry == "" 
         && $errorAge == "" && $msg == "") {
            
            $sql = "INSERT INTO users(name,lastname,email,country,job,age)
            VALUES(:name, :lastname, :email, :country, :job, :age)";
            //prepare statement
            $query = $dbc->prepare($sql);
            //bind parameters
            $query->bindParam(':name', $name);
            $query->bindParam(':lastname', $lastname);  
            $query->bindParam(':email', $email);
            $query->bindParam(':country', $country);
            $query->bindParam(':job', $job);
            $query->bindParam(':age', $age);
            //execution
            $query->execute();
            if($query) {
                $_SESSION['message'] = ' a new user has been added';
            } else {
                $_SESSION['message'] = ' an error';
            }
        }
    }

    view("index");