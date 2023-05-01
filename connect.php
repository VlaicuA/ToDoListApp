<?php
session_start();
//check if logged in
echo 'connected to DB <br>';
if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
    echo '';
} else {
    header('Location: home.php');
    $_SESSION['login_mess'] = 'You are not logged in';
    exit;
};

$db_host = "localhost";
$db_username = 'root';
$db_password = 'root';
$db_database = "do_list";

$conn = new mysqli($db_host, $db_username, $db_password, $db_database);

if (!$conn) {
    $_SESSION['conn'] = 'Not connected' . $conn->connect_error;
} else {
    $_SESSION['conn'] = 'Connected to DB!';
}

?>