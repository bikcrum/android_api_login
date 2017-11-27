<?php

include_once 'db-connect.php';

$db_table = "users";

$db = new DbConnect();

$host = DB_HOST;
$user = DB_USER;
$password = DB_PASSWORD;
$con = mysqli_connect($host, $user, $password);

if ($con) {
    echo '<h1>Connected to MySQL</h1>';

    $email = "bikcrum@gmail.com";
    $password = "test1234";

    $query = "select * from " . $db_table . " where email = '" . $email . "' Limit 1";

    $result = mysqli_query($db->getDb(), $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<h1>Email exist</h1>';
    } else {
        echo '<h1>Email doesnt exisit</h1>';
    }

    mysqli_close($db->getDb());
    $db = new DbConnect();

    $query = "select * from " . $db_table . " where email = '" . $email . "' AND password = '" . $password . "' Limit 1";

    $result = mysqli_query($db->getDb(), $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<h1>account exist</h1>';
    } else {
        echo '<h1>account doesnt exist</h1>';
    }
    mysqli_close($db->getDb());

} else {
    echo '<h1>MySQL Server is not connected</h1>';
}

?>