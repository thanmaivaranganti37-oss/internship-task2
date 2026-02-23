<?php include 'config.php';

if(!isset($_SESSION['user'])) header("Location: login.php");

echo "Welcome ".$_SESSION['user'];
echo " | <a href='add.php'>Add Post</a> | <a href='logout.php'>Logout</a><br><br>";

$res=$conn->query("SELECT * FROM posts");

while($row=$res->fetch_assoc()){
    echo "<h3>".$row['title']."</h3>";
    echo $row['content']."<br>";
    echo "<a href='edit.php?id=".$row['id']."'>Edit</a> | ";
    echo "<a href='delete.php?id=".$row['id']."'>Delete</a><hr>";
}
?>