<?php
session_start();
include 'config.php';
include 'functions.php';

if (getUserRole() != 'faculty') {
    header("Location: dashboard.php");
    exit();
}

$facultyId = $_SESSION['user_id'];

$enrollments = mysqli_query($conn, "SELECT 
        e.*, s.name AS subject_name,
        u.name AS student_name,
        u.profile_pic,
        u.signature,
        e.grade,
        e.status
    FROM enrollments e
    JOIN subjects s ON e.subject_id = s.id
    JOIN users u ON e.student_id = u.id
");

if (!$enrollments) {
    die("SQL Error: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Class Lists</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="title">
    <h1>My Class Lists</h1>
    <nav>
        <a href="dashboard.php">Back to Dashboard</a>
    </nav>
</div>


<div class="container">
<table>
    <tr>
        <th>Subject</th>
        <th>Student</th>
        <th>Profile Pic</th>
        <th>Signature</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

<?php while ($row = mysqli_fetch_assoc($enrollments)): ?>
    <tr>
        <td><?= htmlspecialchars($row['subject_name']) ?></td>
        <td><?= htmlspecialchars($row['student_name']) ?></td>
        <td><img src="<?= htmlspecialchars($row['profile_pic']) ?>" width="50"></td>
        <td><img src="<?= htmlspecialchars($row['signature']) ?>" width="50"></td>
        <td><?= htmlspecialchars($row['grade'] ?? 'N/A') ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
    </tr>
<?php endwhile; ?>
</table>
</div>

</body>
</html>
