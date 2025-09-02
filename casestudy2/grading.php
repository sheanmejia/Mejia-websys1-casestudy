<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student Grade Report</title>
<style>
  body {
    margin: 0;
    font-family: 'Inter', Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #2c3e50;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
  }
  .container {
    background: #fff;
    max-width: 480px;
    width: 100%;
    border-radius: 16px;
    padding: 40px 35px;
    text-align: center;
    position: relative;
  }
  h1 {
    font-weight: 700;
    font-size: 2.2rem;
    margin-bottom: 30px;
    color: #34495e;
    letter-spacing: 1.2px;
  }
  .info {
    text-align: left;
    margin-bottom: 35px;
  }
  .info p {
    font-size: 1.15rem;
    margin: 14px 0;
    color: #555;
  }
  .label {
    font-weight: 600;
    color: #7f8c8d;
    display: inline-block;
    width: 90px;
  }
  .grade-badge {
    display: inline-block;
    padding: 14px 36px;
    font-size: 1.5rem;
    font-weight: 700;
    border-radius: 50px;
    color: #fff;
    letter-spacing: 1.3px;
    user-select: none;
  }
  /* Gradient backgrounds for grades */
  .grade-A {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
  }
  .grade-B {
    background: linear-gradient(45deg, #2980b9, #3498db);
  }
  .grade-C {
    background: linear-gradient(45deg, #f39c12, #f1c40f);
  }
  .grade-D {
    background: linear-gradient(45deg, #d35400, #e67e22);
  }
  .grade-F {
    background: linear-gradient(45deg, #c0392b, #e74c3c);
  }
  .remarks {
    margin-top: 40px;
    font-size: 1.2rem;
    font-style: italic;
    color: #34495e;
    border-top: 1px solid #ecf0f1;
    padding-top: 25px;
  }
  .error {
    background: #ffe6e6;
    color: #c0392b;
    border: 1px solid #c0392b;
    padding: 18px 25px;
    border-radius: 12px;
    font-weight: 700;
    max-width: 480px;
    margin: 40px auto;
    text-align: center;
    box-shadow: 0 4px 12px rgba(192, 57, 43, 0.3);
  }

</style>
</head>
<body>
<?php
function gradeColorClass($letter) {
    return match ($letter) {
        "A" => "grade-A",
        "B" => "grade-B",
        "C" => "grade-C",
        "D" => "grade-D",
        "F" => "grade-F",
        default => "",
    };
}

if (isset($_GET['name']) && isset($_GET['score'])) {
    $name = $_GET['name'];
    $score = $_GET['score'];

    if ($score >= 95 && $score <= 100) {
        $grade = "Excellent";
        $letter = "A";
    } elseif ($score >= 90 && $score <= 94) {
        $grade = "Very Good";
        $letter = "B";
    } elseif ($score >= 85 && $score <= 89) {
        $grade = "Good";
        $letter = "C";
    } elseif ($score >= 75 && $score <= 84) {
        $grade = "Needs Improvement";
        $letter = "D";
    } else {
        $grade = "Failed";
        $letter = "F";
    }

    $remarksMap = [
        "A" => "Outstanding Performance!",
        "B" => "Great Job!",
        "C" => "Good effort, keep it up!",
        "D" => "Work harder next time.",
        "F" => "You need to improve."
    ];
    $remarks = $remarksMap[$letter] ?? "";

    $gradeClass = gradeColorClass($letter);
    ?>
    <main class="container" role="main" aria-label="Student Grade Report">
      <h1>Student Grade Report</h1>
      <section class="info">
        <p><span class="label">Name:</span> <?php echo $name; ?></p>
        <p><span class="label">Score:</span> <?php echo $score; ?></p>
      </section>
      <section>
        <span class="grade-badge <?php echo $gradeClass; ?>" aria-label="Grade <?php echo $letter; ?>">
          <?php echo $grade; ?>
        </span>
      </section>
      <p class="remarks"><?php echo $remarks; ?></p>
    </main>
<?php
} else {
    echo "<div class='error' role='alert'>Please provide both 'name' and 'score' parameters in the URL.</div>";
}
?>
</body>
</html>
