<?php
session_start();

//check if logged in and if not, redirect to home.php




//connect to DB
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_datab = 'test';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_datab);

if (!$conn){
    echo 'Not connected' . $conn->connect_error;
} else {
    echo 'Connected <br>';
};


$username = $_POST['user'];
$username = filter_var($username, FILTER_SANITIZE_STRING);
$password = $_POST['pass'];
$password = filter_var($password, FILTER_SANITIZE_STRING);
// echo $username;

//select users from DB
$query = $conn->query("SELECT * FROM user WHERE username = '$username' and password = '$password'");
//transform $query to a associative array
$query = mysqli_fetch_assoc($query);
// print_r($query);

//set the logic to check if user was logged in
if (empty($username) || empty($password)) {
    $_SESSION['login_mess'] = 'Empty username or password';
    $_SESSION['login_status'] = false;
} else if ($query['username'] == $username && $query['password'] == $password) {
    $_SESSION['login_status'] = true;
    $_SESSION['login_mess'] = 'Hello ' . $username . '. You are connected';
} else {
    $_SESSION['login_mess'] = 'Wrong username or password';
    $_SESSION['login_status'] = false;
}

//check if login
if (isset($_SESSION['login_status']) &&  $_SESSION['login_status'] == true) {
    header('Location: todolist.php');
    exit;
} else {
    header('Location: home.php');
    $_SESSION['login_mess'] = 'You are not logged in';
    exit;
};

?>