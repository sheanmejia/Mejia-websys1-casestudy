<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Handle uploads
    $profile_pic = '';
    $signature = '';
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $profile_pic = 'uploads/' . basename($_FILES['profile_pic']['name']);
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profile_pic);
    }
    if (isset($_FILES['signature']) && $_FILES['signature']['error'] == 0) {
        $signature = 'uploads/' . basename($_FILES['signature']['name']);
        move_uploaded_file($_FILES['signature']['tmp_name'], $signature);
    }
    
    $query = "INSERT INTO users (username, password, role, profile_pic, signature, name, email) VALUES ('$username', '$password', '$role', '$profile_pic', '$signature', '$name', '$email')";
    if (mysqli_query($conn, $query)) {
        header('Location: login.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class = "title">
    <header><h1>Register</h1></header>
    </div>
    <div class="container" style =" width: 980px; margin-left: 100px;
    border-radius: 10px; padding: 30px; text-align: center; ">
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="role" required><br>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
                <option value="admin">Admin</option>
            </select><br>
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            Picture<input type="file" name="profile_pic" accept="image/*" required><br>
            Signature<input type="file" name="signature" accept="image/*" required><br>
            <button type="submit">Register</button><br>

            <p>Don't have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>