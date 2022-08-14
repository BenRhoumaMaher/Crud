<?php
function view($page) {
    GLOBAL $name, $lastname, $email, $phone, $country,$gender, $message,
$errorName, $errorLastName, $errorEmail, $errorPhone, $errorCountry, $errorGender, $errorMessage,
$errorPassword,$errorConfirm,$msg,$erroractivation,$message,$errorJob,$errorAge
    ;
    require(APP_PATH . "view/$page.view.php");
}
function server($va) {
    return $_SERVER[$va];
}
function is_post() {
    return $_SERVER["REQUEST_METHOD" ] == "POST";
}
function redirect($url) {
    header("Location: $url");
    die();
}
function writes($var) {
        echo $var . "<br>";
}
function chars($v) {
    return trim(htmlspecialchars($v));
}
function validate_required_input($inputValue,$inputName,$expectedType) {
    $error = "";
    $error = empty($inputValue) ? $inputName .' is required' : "";

    if(!empty($error)) {
        return $error;
    }

    switch($expectedType) {
        case "integer":
            $error = !is_numeric($inputValue) ? $inputName ." should be a numeric value" : "";
            break;
        case "string":
            $error = !is_string($inputValue) ? $inputName ." should be a string" : "";
            break;
        case "email":
            $error = !filter_var($inputValue, FILTER_VALIDATE_EMAIL) ? $inputName .' must be an email' : "";
            break;
        case "password":
            $error = strlen($inputValue) < 8 || !preg_match('@[0-9]@',$inputValue) || !preg_match('@[A-Z]@',$inputValue)
            || !preg_match('@[a-z]@',$inputValue) || !preg_match('@[^\w]@',$inputValue) ? $inputName .' must be at least 8 characters and must contain at least one number, one upper case, one lower case and one special character' : "";
            break;
        default :
            $error = "";       
    }
    return $error;
}
function confirm($pwd,$conf) {
    $error = chars($pwd) !== chars($conf) ? 'The password confirmation does not match.' : "";
    return $error;
}
function checkExist($email) {
    GLOBAL $dbc;
    $sql = "SELECT * FROM registration WHERE email =?";
    $smt = $dbc->prepare($sql);
    $smt->execute([$email]);
    $query = $smt->fetch();
    if($query) {
        return true;
    } else {
        return false;
    }
}
function emailExist($email) {
    $error = checkExist($email) ? ' email already exists!' : "";
    return $error;
}
function checkExisting($email) {
    GLOBAL $dbc;
    $sql = "SELECT * FROM users WHERE email =?";
    $smt = $dbc->prepare($sql);
    $smt->execute([$email]);
    $query = $smt->fetch();
    if($query) {
        return true;
    } else {
        return false;
    }
}
function emailExisting($email) {
    $error = checkExisting($email) ? ' email already exists!' : "";
    return $error;
}
function PasswordCheck($password, $ExistingPassword){

	$Hash = crypt($password, $ExistingPassword);
	if ($Hash === $ExistingPassword) {
		return true;
	} else {
		return false;
	}

}
function check($email,$password) {
    GLOBAL $dbc;
    $sql = "SELECT * FROM registration WHERE email =?";
    $smt = $dbc->prepare($sql);
    $smt->execute([$email]);
    $query = $smt->rowCount();
    if($query == 1) {
        if($res = $smt->fetch()) {
            if(PasswordCheck($password,$res['password'])){
                return $res;
            }
        }
    } else {
        return null;
    }
}
function credentialscheck($email,$password) {
        $error = !check($email,$password) ? ' crendentials are false !' : "";
    return $error;
}
function checkactive($email) {
    GLOBAL $dbc;
    $sql = "SELECT * FROM registration WHERE email =?";
    $smt = $dbc->prepare($sql);
    $smt->execute([$email]);
    $query = $smt->rowCount();
    $res = $smt->fetch();
    if($query == 1) {
        if($res['active'] =="ON") {
            return true;
        } else {
            return false;
        }
    }
}
function checkactivation($email){
    $error = !checkactive($email) ? ' your account is not activated !' : "";
    return $error;
}
function emailforgot($email) {
    $error = !checkExist($email) ? ' email does not exist' : "";
    return $error;
}
function Generate_Salt($length){
    //md5() calculates the md5 hash of a string
    //uniqid() generates a uniqid
    //for the uniqid(), the mt_rand() is a prefix
    //for uniqid(), the true here return a string of 23 characters long
    //mt_rand() generates random numbers 
    $random = md5(uniqid(mt_rand(),true));
    //base64_encode() returs encoded string in base64
    $base64 = base64_encode($random);
    //substr() return the $length() characters from $base64 starting with position 0
    $salt = substr($base64,0,$length);
    return $salt;
}
function Encryption($password) {
    $blowfishHashFormat="$2y$10$";
    $salt_Length = 22;
    $salt = Generate_Salt($salt_Length);
    $formating = $blowfishHashFormat . $salt;
    //$password is the string to be hashed
    //$formating is the salt string to base the hashing on
    $hash = crypt($password,$formating);
    return $hash;
}
function message(){
    if(isset($_SESSION["message"])){
        $output = $_SESSION["message"];
        $_SESSION["message"] = null;
        return $output;
    }
}
function authenticated(){
    return isset($_SESSION['email']);
}
function ensure_authenticated() {
    if(!authenticated()){
        redirect("Authentification/login.php");
    }
}
function sure_authenticated() {
    if(!authenticated()){
        redirect("../Authentification/login.php");
    }
}