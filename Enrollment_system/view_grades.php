<?php
session_start();
include 'config.php';
include 'functions.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: dashboard.php");
    exit();
}

$studentId = $_SESSION['user_id'];

$query = "SELECT 
        s.name AS subject_name,
        e.grade,
        e.status
    FROM enrollments e
    JOIN subjects s ON e.subject_id = s.id
";


$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Grades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="title">
    <h1>My Grades</h1>
    <nav>
        <a href="dashboard.php">Back to Dashboard</a>
    </nav>
</div>

<div class="container">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table class="grades-table">
    <tr>
        <th>Subject</th>
        <th>Grade</th>
        <th>Status</th>
    </tr>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= htmlspecialchars($row['subject_name']) ?></td>
        <td><?= $row['grade'] !== null ? htmlspecialchars($row['grade']) : 'Not yet posted' ?></td>
        <td><?= htmlspecialchars($row['status'] ?: 'Enrolled') ?></td>
    </tr>
<?php endwhile; ?>
</table>

    <?php else: ?>
        <p class="message">You are not enrolled in any subjects yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
