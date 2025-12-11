<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Handle delete own account
if (isset($_POST['delete_account'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    session_destroy();
    header("Location: register.php");
    exit();
}

// Admin features
$users = [];
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'id';
$order = $_GET['order'] ?? 'ASC';

if ($_SESSION['user_type'] == 'admin') {
    $query = "SELECT * FROM users WHERE name LIKE ? OR username LIKE ? ORDER BY $sort $order";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%$search%", "%$search%"]);
    $users = $stmt->fetchAll();

    // Handle add user
    if (isset($_POST['add_user'])) {
        $new_username = trim($_POST['new_username']);
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $new_email = trim($_POST['new_email']);
        $new_name = trim($_POST['new_name']);
        $new_type = $_POST['new_type'];
        $new_picture = '';
        if (isset($_FILES['new_picture']) && $_FILES['new_picture']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["new_picture"]["name"]);
            if (move_uploaded_file($_FILES["new_picture"]["tmp_name"], $target_file)) {
                $new_picture = $target_file;
            }
        }
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, name, user_type, picture) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$new_username, $new_password, $new_email, $new_name, $new_type, $new_picture]);
        header("Location: dashboard.php");
        exit();
    }

    // Handle delete user
    if (isset($_GET['delete_user'])) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$_GET['delete_user']]);
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div style="text-align: center; margin-top: 50px; background-color: #6eb4c4ff; padding: 20px; border-radius: 10px; width: 50%; margin-left: auto; margin-right: auto;">
    <h2>Welcome <?php echo htmlspecialchars($user['username']); ?>!</h2>
    <img src="<?php echo htmlspecialchars($user['picture']); ?>" alt="Profile Picture" width="100"><br>
    <label>Name: <?php echo htmlspecialchars($user['name']); ?></label><br><br>
    <label>Email: <?php echo htmlspecialchars($user['email']); ?></label><br><br>
    <label>User Type: <?php echo htmlspecialchars($user['user_type']); ?></label><br><br>
    <form method="POST">
        <a href="logout.php">Logout</a><br><br>
    </form>
    <button type="submit" name="delete_account">Delete My Account</button><br><br>
    

    <?php if ($_SESSION['user_type'] == 'admin'): ?>
        <h3>Admin Panel</h3>
        <form method="GET">
            <input type="text" name="search" placeholder="Search by name or username" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        <table border="1" style="margin: 20px auto; width: 80%;">
            <tr>
                <th><a href="?sort=id&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo urlencode($search); ?>">ID</a></th>
                <th><a href="?sort=username&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo urlencode($search); ?>">Username</a></th>
                <th><a href="?sort=name&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo urlencode($search); ?>">Name</a></th>
                <th><a href="?sort=email&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo urlencode($search); ?>">Email</a></th>
                <th><a href="?sort=user_type&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo urlencode($search); ?>">Type</a></th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['username']); ?></td>
                    <td><?php echo htmlspecialchars($u['name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['user_type']); ?></td>
                    <td><a href="?delete_user=<?php echo $u['id']; ?>&search=<?php echo urlencode($search); ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h4>Add New User</h4>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="new_username" placeholder="Username" required><br><br>
            <input type="password" name="new_password" placeholder="Password" required><br><br>
            <input type="email" name="new_email" placeholder="Email" required><br><br>
            <input type="text" name="new_name" placeholder="Full Name" required><br><br>
            <select name="new_type" required>
                <option value="faculty">Faculty</option>
                <option value="admin">Admin</option>
            </select><br>
            <input type="file" name="new_picture" accept="image/*" required><br><br>
            <button type="submit" name="add_user">Add User</button>
        </form>
        </div>
    <?php endif; ?>
</body>
</html>