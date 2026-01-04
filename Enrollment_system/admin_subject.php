<?php
session_start();
include 'config.php';
include 'functions.php';

if (getUserRole() != 'admin') {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ADD SUBJECT
    if (isset($_POST['add_subject'])) {

        $name = sanitize($_POST['name']);
        $desc = sanitize($_POST['description']);
        $facultyId = !empty($_POST['faculty_id']) ? (int)$_POST['faculty_id'] : "NULL";

        mysqli_query($conn, "
            INSERT INTO subjects (name, description, faculty_id)
            VALUES ('$name', '$desc', $facultyId)
        ");
    }

    // ADD PREREQUISITE
    if (isset($_POST['add_prereq'])) {

        $subjectId = (int)$_POST['subject_id'];
        $prereqId  = (int)$_POST['prereq_id'];

        if ($subjectId === $prereqId) {
            die("A subject cannot be its own prerequisite.");
        }

        $check = mysqli_query($conn, "
            SELECT 1 FROM prerequisites
            WHERE subject_id = $subjectId
            AND prerequisite_id = $prereqId
        ");

        if (mysqli_num_rows($check) > 0) {
            die("This prerequisite already exists.");
        }

        mysqli_query($conn, "
            INSERT INTO prerequisites (subject_id, prerequisite_id)
            VALUES ($subjectId, $prereqId)
        ");
    }

    // ASSIGN FACULTY
    if (isset($_POST['assign_faculty'])) {

        $subjectId = (int)$_POST['subject_id'];
        $facultyId = (int)$_POST['faculty_id'];

        mysqli_query($conn, "
            UPDATE subjects
            SET faculty_id = $facultyId
            WHERE id = $subjectId
        ");
    }
}


$subjectsForDropdown = mysqli_query($conn, "SELECT id, name FROM subjects");

$subjectsForTable = mysqli_query($conn, "SELECT 
        subjects.id,
        subjects.name,
        subjects.description,
        users.username AS faculty_name
    FROM subjects
    LEFT JOIN users ON subjects.faculty_id = users.id
");

$users = mysqli_query($conn, "SELECT id, username FROM users WHERE role = 'faculty'");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Subjects</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="title">
        <header><h1>Manage Subjects</h1></header> 
        <nav><a href="dashboard.php">Back to Dashboard</a></nav>
    </div>
    <div class="container"> 
        <h2>Add Subject</h2>
        <form method="POST">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Description: <br><textarea name="description"></textarea></label><br>
            <label>Faculty: <select name="faculty_id" required>
                <?php while ($row = mysqli_fetch_assoc($users)): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                <?php endwhile; ?>
            </select></label><br>
            <button type="submit" name="add_subject">Add Subject</button>
        </form>
        <h3>Add Prerequisite</h3>
        <form method="POST">
            <label>Subject: 
                <select name="subject_id" required>
                    <?php while ($row = mysqli_fetch_assoc($subjectsForDropdown)): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </label>
            <label>Prerequisite: 
                <select name="prereq_id" required>
                    <?php mysqli_data_seek($subjectsForDropdown, 0); while ($row = mysqli_fetch_assoc($subjectsForDropdown)): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </label>
                <button type="submit" name="add_prereq">Add Prerequisite</button>
        </form>
        <h3>Existing Subjects</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Faculty</th>
                <th>Assign Faculty</th>
            </tr>
                <?php while ($row = mysqli_fetch_assoc($subjectsForTable)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['faculty_name'] ?? 'Unassigned'); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="subject_id" value="<?php echo $row['id']; ?>">
                        <select name="faculty_id" required>
                            <?php
                            mysqli_data_seek($users, 0);
                            while ($u = mysqli_fetch_assoc($users)):
                            ?>
                                <option value="<?php echo $u['id']; ?>">
                                    <?php echo htmlspecialchars($u['username']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <button type="submit" name="assign_faculty">Assign</button>
                    </form>
                </td>
            </tr>
                <?php endwhile; ?>
        </table>

    </div>
</body>
</html>