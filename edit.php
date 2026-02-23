<?php include 'config.php';

$id=$_GET['id'];

if(isset($_POST['update'])){
    $t=$_POST['title'];
    $c=$_POST['content'];
    $conn->query("UPDATE posts SET title='$t', content='$c' WHERE id=$id");
    header("Location: dashboard.php");
}

$row=$conn->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();
?>

<form method="POST">
<input name="title" value="<?= $row['title'] ?>"><br>
<textarea name="content"><?= $row['content'] ?></textarea><br>
<button name="update">Update</button>
</form>