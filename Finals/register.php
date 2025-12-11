<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require 'config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $user_type = $_POST['user_type'];

    // Handle file upload
    $picture = '';
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $picture = $target_file;
        }
    }

    // Insert user
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, user_type, picture) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$username, $password, $email, $name, $user_type, $picture])) {
        $message = "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $message = "Registration failed.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div style="text-align: center; margin-top: 50px; background-color: #6eb4c4ff; padding: 20px; border-radius: 10px; width: 50%; margin-left: auto; margin-right: auto;">
    <h2>Register</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <select name="user_type" required>
            <option value="faculty">Faculty</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <input type="file" name="picture" accept="image/*" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p><?php echo $message; ?></p>
    <a href="login.php">Click here to Login!</a>
    </div>
</body>
</html>