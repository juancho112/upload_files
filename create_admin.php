<?php
// run once to create an initial admin user
include('database.php');
$username = 'admin';
$password = password_hash('adminpass', PASSWORD_DEFAULT);
$role = 'admin';
$stmt = $conn->prepare('INSERT INTO users(username, password, role) VALUES(?,?,?)');
$stmt->bind_param('sss', $username, $password, $role);
$stmt->execute();
echo "Admin user created";
?>
