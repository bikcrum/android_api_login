<?php

require_once 'user.php';

$name = "";
$email = "";
$contactNo = "";
$password = "";
$confirmPassword = "";

if (isset($_POST['task'])) {

    $task = $_POST['task'];
    $userObject = new User();

    if ($task == 'login') {

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        $hashed_password = md5($password);

        $json_array = $userObject->login($email, $hashed_password);

        echo json_encode($json_array);

    } else if ($task == 'register') {

        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if (isset($_POST['contact_no'])) {
            $contactNo = $_POST['contact_no'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        $hashed_password = md5($password);

        $json_registration = $userObject->register($name, $email, $contactNo, $hashed_password);

        echo json_encode($json_registration);
    }
}

?>