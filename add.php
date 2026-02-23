<?php include 'config.php'; ?>

<form method="POST">
Title: <input name="title"><br>
Content:<br>
<textarea name="content"></textarea><br>
<button name="add">Add</button>
</form>

<?php
if(isset($_POST['add'])){
    $t=$_POST['title'];
    $c=$_POST['content'];
    $conn->query("INSERT INTO posts(title,content) VALUES('$t','$c')");
    header("Location: dashboard.php");
}
?>