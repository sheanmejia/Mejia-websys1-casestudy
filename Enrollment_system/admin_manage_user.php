<?php
session_start();
include 'config.php';
include 'functions.php';

if (getUserRole() != 'admin') {
    header("Location: dashboard.php");
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_user'])) {
        $username = sanitize($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = sanitize($_POST['role']);
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        
        // Handle file uploads
        $profile_pic = uploadFile('profile_pic');
        $signature = uploadFile('signature');
        
        if ($profile_pic && $signature) {
            $query = "INSERT INTO users (username, password, role, profile_pic, signature, name, email) VALUES ('$username', '$password', '$role', '$profile_pic', '$signature', '$name', '$email')";
            if (mysqli_query($conn, $query)) {
                $message = "User added successfully.";
            } else {
                $message = "Error adding user: " . mysqli_error($conn);
            }
        } else {
            $message = "File upload failed. Ensure files are JPEG/PNG and under 2MB.";
        }
    } elseif (isset($_POST['edit_user'])) {
        $user_id = (int)$_POST['user_id'];
        $username = sanitize($_POST['username']);
        $role = sanitize($_POST['role']);
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        
        // Optional password update
        $password_part = '';
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $password_part = ", password='$password'";
        }
        
        // Optional file updates
        $profile_pic = uploadFile('profile_pic');
        $signature = uploadFile('signature');
        $pic_part = $profile_pic ? ", profile_pic='$profile_pic'" : '';
        $sig_part = $signature ? ", signature='$signature'" : '';
        
        $query = "UPDATE users SET username='$username', role='$role', name='$name', email='$email' $password_part $pic_part $sig_part WHERE id=$user_id";
        if (mysqli_query($conn, $query)) {
            $message = "User updated successfully.";
        } else {
            $message = "Error updating user: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['delete_user'])) {
        $user_id = (int)$_POST['delete_user_id'];
        mysqli_query($conn, "DELETE FROM users WHERE id=$user_id");
        $message = "User deleted successfully.";
    }
}

$users = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script>
        function loadUserData(userId) {
            if (userId == '') return;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_user_data.php?user_id=' + userId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('edit_username').value = data.username;
                    document.getElementById('edit_role').value = data.role;
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_email').value = data.email;
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <div class="title">
        <h1>Manage Users</h1>
        <nav><a href="dashboard.php">Back to Dashboard</a></nav>
    </div>
        <?php if ($message): ?>
            <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
        <?php endif; ?>
        <div class="container">
            <h2>Add New User</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="file" name="profile_pic" accept="image/*" required>
                <input type="file" name="signature" accept="image/*" required>
                <button type="submit" name="add_user">Add User</button>
            </form>
        
            <h2>Edit User</h2>
            <form method="POST" enctype="multipart/form-data">
                <select name="user_id" onchange="loadUserData(this.value)" required>
                    <option value="">Select User</option>
                    <?php mysqli_data_seek($users, 0); while ($row = mysqli_fetch_assoc($users)): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                    <?php endwhile; ?>
                </select>
                <input type="text" id="edit_username" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="New Password (leave blank to keep)">
                <select id="edit_role" name="role" required>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="text" id="edit_name" name="name" placeholder="Full Name" required>
                <input type="email" id="edit_email" name="email" placeholder="Email" required>
                <input type="file" name="profile_pic" accept="image/*">
                <input type="file" name="signature" accept="image/*">
                <button type="submit" name="edit_user">Update User</button>
            </form>
        
            <h2>Delete User</h2>
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                <select name="delete_user_id" required>
                    <option value="">Select User</option>
                    <?php mysqli_data_seek($users, 0); while ($row = mysqli_fetch_assoc($users)): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="delete_user">Delete User</button>
            </form>
      
            <h2>All Users</h2>
            <table border="1">
                <tr><th>ID</th><th>Username</th><th>Role</th><th>Name</th><th>Email</th><th>Profile Pic</th><th>Signature</th></tr>
                <?php mysqli_data_seek($users, 0); while ($row = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><img src="<?php echo $row['profile_pic']; ?>" class="profile-img" alt="Profile" style = "width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ddd; display: block; margin: auto;"></td>
                        <td><img src="<?php echo $row['signature']; ?>" class="signature-img" alt="Signature" style = "width: 100px; height: 50px; object-fit: contain; border: 1px solid #ccc; background-color: #fff; padding: 2px; display: block; margin: auto;"></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
</body>
</html>