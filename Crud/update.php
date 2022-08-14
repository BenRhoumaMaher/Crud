<?php
session_start();
require('../app/app.php');
sure_authenticated();

    if(isset($_REQUEST['update'])){
        $uid = $_GET['id'];
        $name = chars($_POST['name']);
        $lastname = chars($_POST['lastname']);
        $country = chars($_POST['country']);
        $job = chars($_POST['job']);
        $age = chars($_POST['age']);
    
            $sql = "UPDATE users SET 
              name = :name, 
              lastname = :lastname,
              country = :country,
              job = :job,
              age = :age
              WHERE id = :id";

        $query = $dbc->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);  
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->bindParam(':job', $job, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':id', $uid, PDO::PARAM_STR);
            $query->execute();
            if($query) {
                $_SESSION["message"] = ' user informations have been updated';
                redirect('../index.php');
             }
            }
view("Crud/update");