<?php 
include 'config.php';

if(!isset($_SESSION['user'])) header("Location: login.php");

$user = $_SESSION['user'];

/* ======================
   SEARCH + PAGINATION
====================== */

// search value
$search = $_GET['search'] ?? "";

// pagination settings
$limit = 5;
$page = $_GET['page'] ?? 1;
$start = ($page-1) * $limit;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Welcome <?php echo $user; ?></h4>
        <div>
            <a href="add.php" class="btn btn-success btn-sm">Add Post</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>


    <!-- Search form -->
    <form method="GET" class="mb-3 d-flex">
        <input 
            type="text" 
            name="search" 
            class="form-control me-2"
            placeholder="Search posts..."
            value="<?php echo $search; ?>"
        >
        <button class="btn btn-primary">Search</button>
    </form>


<?php

/* ======================
   FETCH POSTS
====================== */

if($search != ""){
    $sql = "SELECT * FROM posts 
            WHERE title LIKE '%$search%' 
            OR content LIKE '%$search%'
            LIMIT $start,$limit";
} else {
    $sql = "SELECT * FROM posts 
            LIMIT $start,$limit";
}

$res = $conn->query($sql);


/* ======================
   DISPLAY POSTS
====================== */

while($row=$res->fetch_assoc()){
?>

    <div class="card mb-3">
        <div class="card-body">
            <h5><?php echo $row['title']; ?></h5>
            <p><?php echo $row['content']; ?></p>

            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
        </div>
    </div>

<?php
}


/* ======================
   PAGE COUNT
====================== */

if($search != ""){
    $count = $conn->query("SELECT COUNT(*) as total FROM posts 
                          WHERE title LIKE '%$search%' 
                          OR content LIKE '%$search%'");
} else {
    $count = $conn->query("SELECT COUNT(*) as total FROM posts");
}

$total = $count->fetch_assoc()['total'];

$pages = ceil($total/$limit);

?>

<!-- Pagination -->
<nav>
<ul class="pagination">

<?php
for($i=1; $i<=$pages; $i++){
?>
    <li class="page-item <?php if($i==$page) echo 'active'; ?>">
        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
            <?php echo $i; ?>
        </a>
    </li>
<?php
}
?>

</ul>
</nav>

</div>

</body>
</html>