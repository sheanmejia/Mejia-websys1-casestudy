<?php
session_start();
if ($_SESSION['role'] != 'faculty') {
    header("Location: dashboard.php");
    exit();
}
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enrollment_id = $_POST['enrollment_id'];
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    mysqli_query($conn, "UPDATE enrollments SET grade='$grade', status='completed' WHERE id=$enrollment_id");
}
$enrollments = mysqli_query($conn, "SELECT 
                e.*, s.name AS subject_name, 
                u.name AS student_name, 
                u.profile_pic, 
                u.signature 
                FROM enrollments e 
                JOIN subjects s ON e.subject_id=s.id 
                JOIN users u ON e.student_id=u.id");
?>
<!DOCTYPE html>
<html>
<head>
  
    <title>Manage Grades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="title">
    <h1>Manage Grades</h1>
    <nav><a href="dashboard.php">Back to Dashboard</a></nav>
    </div>
    <div class="container">
        <table>
            <tr><th>Subject</th><th>Student</th><th>Profile Pic</th><th>Signature</th><th>Grade</th><th>Action</th></tr>
            <?php while ($row = mysqli_fetch_assoc($enrollments)) { ?>
                <tr>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><img src="<?php echo $row['profile_pic']; ?>" width="50"></td>
                    <td><img src="<?php echo $row['signature']; ?>" width="50"></td>
                    <td><?php echo $row['grade']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="enrollment_id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="grade" placeholder="Grade">
                            <button type="submit">Submit Grade</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>