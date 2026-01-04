<?php
session_start();
include 'config.php';
include 'functions.php';


if (!is_logged_in()) {
    header("Location: login.php");
    exit;
}

$role = getUserRole();
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id=$user_id";
$user = mysqli_fetch_assoc(mysqli_query($conn, $query));
?>
<?php
$totalUsers = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users"));
$totalStudents = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE role='student'"));
$totalFaculty = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE role='faculty'"));
$totalAdmins = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE role='admin'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 20px;
    margin-top: 20px;
}

.stat-card {
    background: #f8d564ff;
    color: #0a0909ff;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}

.stat-card p {
    font-size: 24px;
    margin: 5px 0 0;
    font-weight: bold;
}
    </style>
</head>
<body>
    <div class="title">
        <div class="title-left">
         <img src="<?php echo $user['profile_pic']; ?>" class="profile-img" alt="Profile Picture" style="
            width: 100px;
            height: 100px;
            margin-top: -15px;
            margin-right: 15px;
            float: right;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #000000ff;
            margin-bottom: 10px;">
        </div>
    <header><h1>Welcome, <?php echo ucfirst($role); ?></h1></header>  
    <nav> 
        <?php if ($role == 'admin'): ?>
            <a href="admin_subject.php">Manage Subjects</a> | <a href="admin_manage_user.php">Manage Users</a> | <a href="admin_override.php">Overrides</a>  <!-- Adjusted to flat files -->
        <?php elseif ($role == 'faculty'): ?>
            <a href="faculty_classes.php">View Classes</a> | <a href="faculty_grades.php">Manage Grades</a> 
        <?php elseif ($role == 'student'): ?>
            <a href="student_enroll.php">Enroll in Subjects</a> | <a href="view_grades.php">View My Grades</a>
        <?php endif; ?>
        | <a href="logout.php">Logout</a>

    </nav>
    </div>
    <?php if ($user['role'] == 'admin'): ?>
        <div class="stats">
    <div class="stat-card">
        <h3>Total Users</h3>
        <p><?php echo $totalUsers; ?></p>
    </div>
    <div class="stat-card">
        <h3>Students</h3>
        <p><?php echo $totalStudents; ?></p>
    </div>
    <div class="stat-card">
        <h3>Faculty</h3>
        <p><?php echo $totalFaculty; ?></p>
    </div>
    <div class="stat-card">
        <h3>Admins</h3>
        <p><?php echo $totalAdmins; ?></p>
    </div>
</div>
    <?php endif; ?>
    <?php if ($user['role'] == 'faculty'):?>
         <h2>Your Enrolled Student</h2>
        <ul>
        <div class="stat-card">
            <h3>Students</h3>
            <p><?php echo $totalStudents; ?></p>
        </div>
        </ul>
     <?php endif; ?>
     <?php if ($user['role'] == 'student'):?>
         <h2>Your Enrolled Subjects</h2>
        <ul>
            <?php if (empty($enrolled)): ?>
                <li>Mathemathics Research</li>
            <?php else: ?>
                <?php foreach ($enrolled as $subject): ?>
                    <li><?php echo htmlspecialchars($subject); ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
     <?php endif; ?>
        </div>
    </div>
</body>
</html>