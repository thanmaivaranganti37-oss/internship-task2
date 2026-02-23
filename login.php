<?php include 'config.php'; ?>

<form method="POST">
Username: <input name="username"><br>
Password: <input type="password" name="password"><br>
<button name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])){
    $u=$_POST['username'];
    $p=$_POST['password'];

    $res=$conn->query("SELECT * FROM users WHERE username='$u'");
    $row=$res->fetch_assoc();

    if(password_verify($p,$row['password'])){
        $_SESSION['user']=$u;
        header("Location: dashboard.php");
    } else {
        echo "Wrong password";
    }
}
?>