<?php
// Personal Information
$name = "Shean Mae Mejia";
$jobTitle = "Web Designer";
$phone = "09206960240";
$email = "smejia_19ur0263@gmail.com";
$linkedin = "linkedin.com/in/shean-mejia";
$gitlab = "NA";
$address = "#28 Agat, Sison, Pangasinan";
$dob = "23 June 2000";
$gender = "Female";
$nationality = "Filipino";

// Profile Summary
$profileSummary = "Experienced in developing responsive, user-friendly, and visually appealing web interfaces by using modern design tools and frameworks. I am able to make layouts that is an eye catch and adapt to different devices and screen sizes for the best performance. Eager to upscale my programming language to have a high quality design and help the company to grow exponentially";

// Education Details
$education1_year = "20117–2019";
$education1_degree = "Senior High School Diploma";
$education1_school = "Benigno V. Aldana National High School";
$education1_marks = "GWA: 90%";
$education1_activities1 = "NA";

$education2_year = "2019–2025";
$education2_degree = "Bachelor of Information Technology";
$education2_school = "Pangasinan State University - Urdaneta City Pangasinan";
$education2_cgpa = "GPA: NA";
$education2_specialization = "Designing and Implementing System Software";

// Experience Details
$experience_period = "February 2023 – Present";
$experience_position = "Service Crew in Mcdonalds";
$experience_company = "Golden Archers Inc.";
$experience_task1 = "Maintained high standards of customer service during high-volume, fast-paced operations";
$experience_task2 = "Communicated clearly and positively with coworkers and management";
$experience_task3 = "Handled currency and credit transactions quickly and accurately";

// Skills
$skill1 = "Visual Basic";
$skill2 = "C, C++";
$skill3 = "Java, HTML";
$skill4 = "PHP";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resume</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            margin: 20px;
            margin-left: 180px;
            max-width: 900px;
            color: #000000;
        }
        .header {
            background-color: #1f4e79;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header img {
            width: 180px;
            height: 180px;
            margin-right: 20px;
            border-radius: 5px;
            display: flex;
        }
        .header-info {
            flex-grow: 1;
        }
        .header-info h1 {
            margin: 0;
            font-size: 30px;
        }
        .header-info h2 {
            font-weight: normal;
            margin-top: 5px;
            font-size: 20px;
            color: #cfdcec;
        }
        .contact-info {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 16px;
        }
        .contact-info div {
            line-height: 1.5;
        }
         .contact-info1 {
            border-bottom: 1px solid #989898;
        }
        .section-title {
            color: #1f4e79;
            font-size: 30px;
            margin-top: 30px;
            border-bottom: 2px solid #000000;
            padding-bottom: 5px;
        }
        .content {
            margin-top: 10px;
            font-size: 18px;
            line-height: 1.5;
        }
        .education-item, .experience-item {
            margin-top: 15px;
            font-size: 18px;
        }
        .education-year, .experience-period {
            width: 120px;
            font-weight: bold;
            float: left;
        }
        .education-details, .experience-details {
            margin-left: 130px;
        }
        ul {
            margin-top: 5px;
            padding-left: 20px;
        }
        .skills-list {
            padding-left: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="picture.jpg" alt="Profile Picture">
    <div class="header-info">
        <h1><?php echo $name; ?></h1>
        <h2><?php echo $jobTitle; ?></h2>
        <div class="contact-info">
            <div>
                <div class="contact-info1"><strong>Phone:</strong> <?php echo $phone; ?><br></div>
                <strong>Email:</strong> <?php echo $email; ?><br>
                <div class="contact-info1"><strong>LinkedIn:</strong> <?php echo $linkedin; ?><br></div>
                <strong>GitLab:</strong> <?php echo $gitlab; ?>
            </div>
            <div>
                <div class="contact-info1"><strong>Address:</strong> <?php echo $address; ?><br></div>
                <strong>Date of birth:</strong> <?php echo $dob; ?><br>
                <div class="contact-info1"><strong>Gender:</strong> <?php echo $gender; ?><br></div>
                <strong>Nationality:</strong> <?php echo $nationality; ?>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <p><?php echo $profileSummary; ?></p>
</div>

<div class="section-title"><strong>Education</strong></div>

<div class="education-item">
    <div class="education-year"><?php echo $education1_year; ?></div>
    <div class="education-details">
        <strong><?php echo $education1_degree; ?></strong><br>
        <em><?php echo $education1_school; ?></em><br>
        <?php echo $education1_marks; ?><br><br>
        <div>Activities:</div>
        <ul>
            <li><?php echo $education1_activities1; ?></li>
        </ul>
    </div>
</div>

<div class="education-item">
    <div class="education-year"><?php echo $education2_year; ?></div>
    <div class="education-details">
        <strong><?php echo $education2_degree; ?></strong><br>
        <em><?php echo $education2_school; ?></em><br>
        <?php echo $education2_cgpa; ?><br><br>
        <div>Specialization:</div>
        <ul>
            <li><?php echo $education2_specialization; ?></li>
        </ul>
    </div>
</div>

<div class="section-title"><strong>Experience</strong></div>

<div class="experience-item">
    <div class="experience-period"><?php echo $experience_period; ?></div>
    <div class="experience-details">
        <strong><?php echo $experience_position; ?></strong><br>
        <em><?php echo $experience_company; ?></em><br>
        <ul>
            <li><?php echo $experience_task1; ?></li>
            <li><?php echo $experience_task2; ?></li>
            <li><?php echo $experience_task3; ?></li>
        </ul>
    </div>
</div>

<div class="section-title"><strong>Skills</strong></div>
<ul class="skills-list">
    <li><?php echo $skill1; ?></li>
    <li><?php echo $skill2; ?></li>
    <li><?php echo $skill3; ?></li>
    <li><?php echo $skill4; ?></li>
</ul>

</body>
</html>
