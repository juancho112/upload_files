<?php
session_start();
include('database.php');
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// add case
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $stmt = $conn->prepare('INSERT INTO cases(name, address, status, user_id) VALUES(?,?,?,?)');
    $stmt->bind_param('sssi', $name, $address, $status, $user_id);
    $stmt->execute();
}

// fetch cases
if($role === 'admin'){
    $result = $conn->query('SELECT cases.id, name, address, status, username FROM cases JOIN users ON users.id=cases.user_id');
}else{
    $stmt = $conn->prepare('SELECT id, name, address, status FROM cases WHERE user_id=?');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<html>
<head>
    <title>Cases</title>
</head>
<body>
<h2>Case List</h2>
<a href="logout.php">Logout</a><br><br>
<form method="post">
    Name: <input type="text" name="name" required><br>
    Address: <input type="text" name="address" required><br>
    Status: <input type="text" name="status" required><br>
    <input type="submit" value="Add Case">
</form>
<br>
<?php if($role === 'admin'){ echo '<a href="export_cases.php">Export to Excel</a><br><br>'; } ?>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Address</th><th>Status</th><?php if($role==='admin'){echo '<th>User</th>'; } ?></tr>
<?php while($row=$result->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['address']); ?></td>
    <td><?php echo htmlspecialchars($row['status']); ?></td>
    <?php if($role==='admin'){ echo '<td>'.htmlspecialchars($row['username']).'</td>'; } ?>
</tr>
<?php } ?>
</table>
</body>
</html>
