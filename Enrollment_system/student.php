<?php
include 'config.php';
include 'functions.php';

if (getUserRole() != 'student') {
    header("Location: dashboard.php");
}

$studentId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subjectId = $_POST['subject_id'];
    if (checkPrerequisites($conn, $studentId, $subjectId)) {
        $query = "INSERT INTO enrollments (student_id, subject_id) VALUES ($studentId, $subjectId)";
        mysqli_query($conn, $query);
        echo "Enrolled!";
    } else {
        echo "Prerequisites not met.";
    }
}

$query = "SELECT * FROM subjects";
$subjects = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <div class="title">
    <title>Enroll</title>
</div>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Enroll in Subjects</h2>
    <form action="" method="post">
        Subject: <select name="subject_id">
            <?php while ($row = mysqli_fetch_assoc($subjects)): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Enroll</button>
    </form>
</body>
</html>