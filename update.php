<?php
include_once 'connect.php';

//check if logged in
if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
    echo 'Hello you are logged in <br>';

} else {
    header('Location: home.php');
    $_SESSION['login_mess'] = 'You are not logged in <br>';
    exit;
};


//change the status

$id_update = $_GET['id'];

echo $id_update . '<br>';

$select = "SELECT * FROM to_do_list WHERE id = $id_update";
$select_result = mysqli_query($conn, $select);
$slt = mysqli_fetch_assoc($select_result);

print_r($slt);


$sql= "UPDATE to_do_list SET
status = 0
WHERE id = '$id_update';
";


if ($conn->query($sql) === TRUE) {
    //redirect 
    header("location: todolist.php"); 
    echo 'a';
} else {
    echo "Error updating task status: " . $conn->error;
}
exit;

?>

