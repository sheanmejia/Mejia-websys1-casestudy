<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$studentId = $_SESSION['user']['id'];
$subjectId = intval($_POST['subjectId']);

if (!$subjectId) {
    echo json_encode(['success' => false, 'message' => 'Invalid subject ID.']);
    exit;
}

$conn = connectDB();  // Ensure connectDB is called

// Check if already enrolled
$query = "SELECT * FROM enrollments WHERE student_id = $studentId AND subject_id = $subjectId";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    mysqli_close($conn);
    echo json_encode(['success' => false, 'message' => 'Already enrolled in this subject.']);
    exit;
}

// Check prerequisites (updated to pass $conn)
if (!checkPrerequisites($conn, $studentId, $subjectId)) {
    mysqli_close($conn);
    echo json_encode(['success' => false, 'message' => 'Prerequisites not met. Cannot enroll.']);
    exit;
}

// Enroll the student (updated to pass $conn)
if (enrollStudent($conn, $studentId, $subjectId)) {
    mysqli_close($conn);
    echo json_encode(['success' => true, 'message' => 'Enrolled successfully!']);
} else {
    mysqli_close($conn);
    echo json_encode(['success' => false, 'message' => 'Enrollment failed.']);
}
?>