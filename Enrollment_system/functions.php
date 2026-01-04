<?php

function sanitize($data) {
    global $conn; // Assumes $conn is available from config.php
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

function connectDB() {
    $conn = mysqli_connect("localhost", "root", "", "enrollment_system");
    if (!$conn) die("Connection failed: " . mysqli_connect_error());
    return $conn;
}
// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to redirect if not logged in
function require_login() {
    if (!is_logged_in()) {
        header("Location: dashboard.php");
        exit();
    }
}

// Function to check user role
function has_role($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

// Function to get user data by ID
function get_user($user_id) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = " . (int)$user_id);
    return mysqli_fetch_assoc($result);
}

function getUserRole() {
    if (!is_logged_in()) return null;
    global $conn;  // Access the mysqli connection from config.php
    $user_id = $_SESSION['user_id'];
    $query = "SELECT role FROM users WHERE id=$user_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['role'] ?? null;
}

// Function to upload file (for profile pic/signature) - Updated to camelCase: uploadFile
function uploadFile($file_input, $target_dir = "uploads/") {
    if (!isset($_FILES[$file_input]) || $_FILES[$file_input]['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    $file_name = basename($_FILES[$file_input]["name"]);
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, ['jpg', 'png', 'gif'])) {
        return false; // Only allow image types
    }
    return move_uploaded_file($_FILES[$file_input]["tmp_name"], $target_file) ? $target_file : false;
}

// Function to check if student can enroll (prerequisites)
function can_enroll($student_id, $subject_id) {
    global $conn;
    $prereqs = mysqli_query($conn, "SELECT prerequisite_id FROM prerequisites WHERE subject_id = " . (int)$subject_id);  // Fixed table name
    while ($prereq = mysqli_fetch_assoc($prereqs)) {
        $completed = mysqli_query($conn, "SELECT * FROM enrollments WHERE student_id = " . (int)$student_id . " AND subject_id = " . (int)$prereq['prerequisite_id'] . " AND status = 'completed'");
        if (mysqli_num_rows($completed) == 0) {
            return false;
        }
    }
    return true;
}

function getSubjectsWithPrereqs($conn) {
    $query = "SELECT s.id, s.name, s.description, GROUP_CONCAT(prereq.name SEPARATOR ', ') AS prereqs
              FROM subjects s
              LEFT JOIN prerequisites p ON s.id = p.subject_id
              LEFT JOIN subjects prereq ON p.prerequisite_id = prereq.id
              GROUP BY s.id, s.name, s.description";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function checkPrerequisites($conn, $studentId, $subjectId) {
    $query = "SELECT p.prerequisites_id FROM prerequisites p WHERE p.subject_id = $subjectId";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $prereqId = $row['prerequisites_id'];
        $check = "SELECT * FROM enrollments WHERE student_id = $studentId AND subject_id = $prereqId AND status = 'completed'";
        if (!mysqli_num_rows(mysqli_query($conn, $check))) {
            return false;
        }
    }
    return true;
}

function enrollStudent($conn, $studentId, $subjectId) {
    $query = "INSERT INTO enrollments (student_id, subject_id, status) VALUES ($studentId, $subjectId, 'enrolled')";
    return mysqli_query($conn, $query);
}
?>

