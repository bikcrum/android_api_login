<?php

require_once 'user.php';

$password = "";

$email = "";


if (isset($_POST['email'])) {

    $email = $_POST['email'];

}

if (isset($_POST['password'])) {

    $password = $_POST['password'];

}


$userObject = new User();

// Registration
/*
if(!empty($username) && !empty($password) && !empty($email)){

    $hashed_password = md5($password);

    $json_registration = $userObject->createNewRegisterUser($username, $hashed_password, $email);

    echo json_encode($json_registration);

}
*/
// Login

if (!empty($email) && !empty($password)) {

    $hashed_password = md5($password);

    $json_array = $userObject->loginUsers($email, $password);

    echo json_encode($json_array);
}
?>