<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="user">User:</label>
        <input type="text" id="user" name="user"><br>
        <label for="pass">Password:</label>
        <input type="text" name="pass" id="pass"><br>
        <input type="submit" value="Submit">
    </form>
    
<?php

if (isset($_SESSION['login_mess'])){
    echo $_SESSION['login_mess'];
    unset($_SESSION['login_mess']);
} 

?>
    
</body>
</html>