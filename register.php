<?php include 'config.php'; ?>

<form method="POST">
Username: <input name="username"><br>
Password: <input type="password" name="password"><br>
<button name="register">Register</button>
</form>

<?php
if(isset($_POST['register'])){
    $u = $_POST['username'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users(username,password) VALUES('$u','$p')");
    echo "Registered! <a href='login.php'>Login</a>";
}
?>