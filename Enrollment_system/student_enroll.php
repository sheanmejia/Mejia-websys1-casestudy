<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
    header("Location: dashboard.php");  
    exit();
}

include 'config.php';
include 'functions.php';

$subjects = getSubjectsWithPrereqs($conn);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Enrollment</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="title">
    <h1>Enroll in Subjects</h1>
    <nav><a href="dashboard.php">Back to Dashboard</a></nav>  
</div>

<div id="subjects">
    <?php foreach ($subjects as $subject): ?>
        <div class="subject">
            <h3><?= htmlspecialchars($subject['name']); ?></h3>
            <p>Description: <?= htmlspecialchars($subject['description'] ?: 'N/A'); ?></p>
            <p>Prerequisites: <?= htmlspecialchars($subject['prereqs'] ?: 'None'); ?></p>
            <button onclick="enroll(<?= $subject['id']; ?>)">Enroll</button>
        </div>
    <?php endforeach; ?>
</div>

<div id="message" class="message"></div>

<script>
function enroll(subjectId) {
    $('#message').text('Processing...');

    $.post(
        'enroll_action.php',
        { subjectId: subjectId },
        function (data) {
            $('#message').text(data.message);
            if (data.success) {
                location.reload();
            }
        },
        'json'
    ).fail(function () {
        $('#message').text('Error: Could not process request.');
    });
}
</script>

</body>
</html>
