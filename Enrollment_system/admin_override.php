<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['enroll_override'])) {
        $student_id = $_POST['student_id'];
        $subject_id = $_POST['subject_id'];
        mysqli_query($conn, "INSERT INTO enrollments (student_id, subject_id) VALUES ($student_id, $subject_id)");
    } elseif (isset($_POST['add_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        mysqli_query($conn, "INSERT INTO users (username, password, role, name) VALUES ('$username', '$password', '$role', '$name')");
    }
}
$users = mysqli_query($conn, "SELECT * FROM users");
$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="title">
    <h1>Admin Panel</h1>
    <nav><a href="dashboard.php">Back to Dashboard</a></nav>
</div>
    <div class="container">
        <h2>Enrollment Override</h2>
            <form method="POST">
                Student ID: <input type="number" name="student_id" required>
                Subject ID: <input type="number" name="subject_id" required>
                <button type="submit" name="enroll_override">Override Enroll</button>
            </form>
            <h2>Add User</h2>
            <form method="POST">
                Username: <input type="text" name="username" required>
                Password: <input type="password" name="password" required>
                Role: <select name="role"><option>student</option><option>faculty</option><option>admin</option></select>
                Name: <input type="text" name="name" required>
                <button type="submit" name="add_user">Add User</button>
            </form>
            <h2>Users</h2>
            <table border="1">
                <tr><th>ID</th><th>Username</th><th>Role</th><th>Name</th></tr>
                <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                    <tr><td><?php echo $row['id']; ?></td><td><?php echo $row['username']; ?></td><td><?php echo $row['role']; ?></td><td><?php echo $row['name']; ?></td></tr>
                <?php } ?>
            </table>
    </div>
</body>
</html>