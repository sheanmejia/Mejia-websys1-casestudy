<?php
include 'config.php';
$user_id = (int)$_GET['user_id'];
$result = mysqli_query($conn, "SELECT username, role, name, email FROM users WHERE id=$user_id");
$user = mysqli_fetch_assoc($result);
echo json_encode($user);
?>