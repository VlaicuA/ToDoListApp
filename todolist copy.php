<?php
//design done with figma
include_once 'connect.php';
//check if logged in
echo 'To do list <br>';
if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
    echo 'Hello You are logged in';;
} else {
    header('Location: index.php');
    $_SESSION['login_mess'] = 'You are not logged in';
    exit;
};


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

    <a href="./home.php">Home</a> <br>
    <form action="" method="post">
    <label for="todo">Insert item:</label>
    <input type="text" id="todo" name="todo" placeholder="Item"><br>
    <input type="submit" value="Insert">
    </form>

<?php

//check if POST['todo'] is not set to avoid display an error on the page
if (isset($_POST['todo'])){
    $new_item = $_POST['todo'];
}


//insert to the DB from POST
if (isset($new_item)) {
$new_item = $_POST['todo'];
$sel = $conn->query("INSERT INTO to_do_list SET 
item = '$new_item'
");
echo '<script>window.location.href = "todolist.php";</script>'; //for reloading 
    exit;
}

echo '<br>';

//read the db

$read_db = $conn->query("SELECT * FROM to_do_list ORDER BY id DESC");

//display the db items
while($row = $read_db->fetch_array()){
    echo "<form action='test.php' method='get'>";
    echo '<h4> ID: '  . $row['id'].'</h4>';
    echo '<p> To do item: ' . $row['item'].' </p>';
    echo '<p> Status: '. ($row['status'] == 1 ? 'Pending' : 'Complete').'</p>';
    echo "<a href='todolist.php?id=".$row['id']."'>Delete</a> <br>";
    echo "<a href='update.php?id=".$row['id']."'>Complete</a>";
    echo '</form>';
}

//delete
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    $deleting = mysqli_query($conn, "DELETE FROM to_do_list WHERE id = '$delete_id'");
    echo '<script>window.location.href = "todolist.php";</script>'; //for reloading 
    exit;
};

?>

</body>
</html>