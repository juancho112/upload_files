<?php
session_start();
include('database.php');
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header('Location: login.php');
    exit();
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="cases.csv"');
$out = fopen('php://output', 'w');

fputcsv($out, ['ID','Name','Address','Status','User']);
$result = $conn->query('SELECT cases.id, name, address, status, username FROM cases JOIN users ON users.id=cases.user_id');
while($row = $result->fetch_assoc()){
    fputcsv($out, [$row['id'],$row['name'],$row['address'],$row['status'],$row['username']]);
}

fclose($out);
?>
