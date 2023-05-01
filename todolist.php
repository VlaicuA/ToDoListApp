<?php
include_once 'connect.php';
//check if logged in
if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
    echo 'Hello '. $_SESSION['username'] .'! You are logged in';;
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Schoolbell&v1" rel="stylesheet">
    <title>To do list</title>
</head>
<body>

<section class="main">
        <div class="top_triangle"></div>
        <div class="trapezoid top_trapezoid"></div>
        <section class="main_frame">
            <section class="main_section">
            <section class="insert_form_section">
                <form action="" method="post" class="insert_form">
                    <div class="insert_item">
                    <div>
                    <p>Insert item:</p>
                    </div>
                    <div>
                    <input type="text" id="todo" name="todo" placeholder="Item" maxlength="40"><br>
                    </div>
                    </div>
                    <div class="insert_item_button">
                    <input type="submit" value="   Insert   ">
                    </div>
                </form>
            </section>
            <section class="items_section">
                <div class="action_item_head">Action</div>
                <div class="to_do_item_head">To do</div>
                <div class="status_item_head">Status</div>
            </section>
            <hr>
            <?php
            $read_db = $conn->query("SELECT * FROM to_do_list ORDER BY id DESC");

            while($row = $read_db->fetch_array()) {
            echo '<form action="test.php" method="get">';
                echo '<section class="item">';
                // echo '<div class="action_item">'."<a href='update.php?id=".$row['id']."'>Complete</a>".'</div>';
                echo "<a href='update.php?id=".$row['id']."'>C/U</a>";
                echo "<a href='todolist.php?id=".$row['id']."'>Del</a> <br>";
                echo '<div class="to_do_item">'. $row['item'] .'</div>';
                echo '<div class="status_item">'. ($row['status'] == 1 ? 'Pending' : 'Complete').'</div>';          
                echo '</section>';
            echo '</form>';
            echo '<hr class="hr_dashed">';
            }
            ?>
            </section>
            </section>
        </section>
        
    </section>
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