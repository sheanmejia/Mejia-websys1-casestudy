<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
            background-color: #fff;
            color: #000;
        }

        .container {
            max-width: 900px;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
            height: 100%;
        }

        h1 {
            text-align: center;
            font-weight: bold;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .section-title {
            background-color: #000;
            color: #fff;
            padding: 4px 10px;
            margin-top: 20px;
            font-weight: bold;
            font-size: 16px;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            height: 100%;
        }

        td {
            padding: 5px;
            vertical-align: top;
        }

        td.label {
            width: 25%;
            white-space: nowrap;
            font-weight: normal;
        }

        input[type="text"],
        input[type="date"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            border: none;
            border-bottom: 1px solid #000;
            font-size: 14px;
            padding: 3px 5px;
        }

        input[type="text"].small,
        input[type="date"].small,
        input[type="email"].small,
        input[type="tel"].small {
            width: 60%;
        }

        .small-input {
            width: 45%;
            border: none;
            border-bottom: 1px solid #000;
            font-size: 14px;
            padding: 3px 5px;
        }

        .side-by-side {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
        }

        .signature {
            margin-top: 35px;
            text-align: right;
            font-style: italic;
            font-size: 12px;
        }
        .photo-box {
            border: 1px solid #000;
            width: 120px;
            height: 130px;
            float: right;
            margin-top: -70px;
            margin-bottom: 10px;
            text-align: center;
            line-height: 130px;
            font-size: 14px;
            color: #444;
        }

        .note {
            font-size: 12px;
            font-style: italic;
            margin-top: 6px;
            padding-left: 10px;
        }

        /* For multiline inputs */
        textarea {
            width: 100%;
            border: none;
            border-bottom: 1px solid #000;
            font-family: Arial, sans-serif;
            font-size: 14px;
            resize: none;
            height: 40px;
            padding: 5px 5px;
        }
    </style>
</head>
<body>
    <?php
  $photoPath = "";
  $signaturePath = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
        $position = htmlspecialchars($_POST['position']);
        $date = htmlspecialchars($_POST['datenow']);
        $name = htmlspecialchars($_POST['name']);
        $gender = htmlspecialchars($_POST['gender']);
        $city = htmlspecialchars($_POST['city']);
        $provincial = htmlspecialchars($_POST['provincial']);
        $tel = htmlspecialchars($_POST['tel']);
        $cell = htmlspecialchars($_POST['cell']);
        $email = htmlspecialchars($_POST['email']);
        $dob = htmlspecialchars($_POST['dob']);
        $birthplace = htmlspecialchars($_POST['birthplace']);
        $status = htmlspecialchars($_POST['status']);
        $citizen = htmlspecialchars($_POST['citizen']);
        $height = htmlspecialchars($_POST['height']);
        $weight = htmlspecialchars($_POST['weight']);
        $religion = htmlspecialchars($_POST['religion']);
        $spouse = htmlspecialchars($_POST['spouse']);
        $occupation = htmlspecialchars($_POST['occupation']);
        $children = htmlspecialchars($_POST['children']);
        $children1 = htmlspecialchars($_POST['children1']);
        $children2 = htmlspecialchars($_POST['children2']);
        $childbirth = htmlspecialchars($_POST['childbirth']);
        $childbirth1 = htmlspecialchars($_POST['childbirth1']);
        $childbirth2 = htmlspecialchars($_POST['childbirth2']);
        $fname = htmlspecialchars($_POST['fname']);
        $foccupation = htmlspecialchars($_POST['foccupation']);
        $mname = htmlspecialchars($_POST['mname']);
        $moccupation = htmlspecialchars($_POST['moccupation']);
        $language = htmlspecialchars($_POST['language']);
        $ename = htmlspecialchars($_POST['ename']);
        $pnum = htmlspecialchars($_POST['pnum']);
        $elementary = htmlspecialchars($_POST['elementary']);
        $eyear = htmlspecialchars($_POST['eyear']);
        $highschool = htmlspecialchars($_POST['highschool']);
        $hyear = htmlspecialchars($_POST['hyear']);
        $college = htmlspecialchars($_POST['college']);
        $cyear = htmlspecialchars($_POST['cyear']);
        $graduate = htmlspecialchars($_POST['graduate']);
        $skills= htmlspecialchars($_POST['skills']);
        $cname = htmlspecialchars($_POST['cname']);
        $cposition = htmlspecialchars($_POST['cposition']);
        $from = htmlspecialchars($_POST['from']);
        $to = htmlspecialchars($_POST['to']);
        $cname1 = htmlspecialchars($_POST['cname1']);
        $cposition1 = htmlspecialchars($_POST['cposition1']);
        $from1 = htmlspecialchars($_POST['from1']);
        $to1 = htmlspecialchars($_POST['to1']);
        $rname = htmlspecialchars($_POST['rname']);
        $rcompany = htmlspecialchars($_POST['rcompany']);
        $rposition = htmlspecialchars($_POST['rposition']);
        $rcontact = htmlspecialchars($_POST['rcontact']);
        $rname1 = htmlspecialchars($_POST['rname1']);
        $rcompany1 = htmlspecialchars($_POST['rcompany1']);
        $rposition1 = htmlspecialchars($_POST['rposition1']);
        $rcontact1 = htmlspecialchars($_POST['rcontact1']);
        $cert = htmlspecialchars($_POST['cert']);
        $iat = htmlspecialchars($_POST['iat']);
        $ion = htmlspecialchars($_POST['ion']);
        $sss = htmlspecialchars($_POST['sss']);
        $tin = htmlspecialchars($_POST['tin']);
        $nbi = htmlspecialchars($_POST['nbi']);
        $passport = htmlspecialchars($_POST['passport']);
    }

     if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['picture']['type'], $allowedTypes)) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $photoPath = $uploadDir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $photoPath);
        }
    }
    // Handle signature upload
    if (isset($_FILES['signUpload']) && $_FILES['signUpload']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['signUpload']['type'], $allowedTypes)) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $signaturePath = $uploadDir . basename($_FILES['signUpload']['name']);
            move_uploaded_file($_FILES['signUpload']['tmp_name'], $signaturePath);
        }
    }

?>


    <form>
        <div class="container">

    <h1>BIO-DATA</h1>

    <?php
        if ($photoPath) {
            echo '<div class="photo-box"><img src="' . $photoPath . '" alt="Photo" style="width: 100%; height: 100%; object-fit: cover;"></div>';
        } else {
            echo '<div class="photo-box">Photo<br>Here</div>';
        }
    ?>
    <div class="section-title">Bio Data</div>
    <form enctype="multipart/form-data">
        <table>
            <!-- First row -->
            <tr>
                <td class="label">Position Desired :</td>
                <td><?php echo $position; ?></td>
                <td class="label" style="width: 5%;">Date</td>
                <td><?php echo $date; ?></td>
            </tr>
            <tr>
                <td class="label">Name :</td>
                <td><?php echo $name; ?></td>
                <td class="label">Gender</td>
                <td><?php echo $gender; ?></td>
            </tr>
            <tr>
                <td class="label">City Address :</td>
                <td colspan="3"><?php echo $city; ?></td>
            </tr>
            <tr>
                <td class="label">Provincial Address :</td>
                <td colspan="3"><?php echo $provincial; ?></td>
            </tr>
            <tr>
                <td class="label">Telephone :</td>
                <td><?php echo $tel; ?></td>
                <td class="label">Cellphone</td>
                <td><?php echo $cell; ?></td>
            </tr>
            <tr>
                <td class="label">E-mail Address :</td>
                <td colspan="3"><?php echo $email; ?></td>
            </tr>
            <tr>
                <td class="label">Date of Birth :</td>
                <td><?php $dob ?></td>
                <td class="label">Birth of Place</td>
                <td><?php echo $birthplace; ?></td>
            </tr>
            <tr>
                <td class="label">Civil Status :</td>
                <td><?php echo $status;?></td>
                <td class="label">Citizenship</td>
                <td><?php echo $citizen;?></td>
            </tr>
            <tr>
                <td class="label">Height :</td>
                <td><?php echo $height;?></td>
                <td class="label">Weight</td>
                <td><?php echo $weight;?></td>
            </tr>
            <tr>
                <td class="label">Religion :</td>
                <td><?php echo $religion;?></td>
            </tr>
            <tr>
                <td class="label">Spouse</td>
                <td><?php echo $spouse;?></td>
                <td class="label">Occupation</td>
                <td><?php echo $occupation;?></td>
            </tr>
            <tr>
                <td class="label">Name of Children :</td>
                <td><?php echo $children;?></td>
                <td><?php echo $children1;?></td>
                <td><?php echo $children2;?></td>
                <td class="label">Date of Birth</td>
                <td><?php echo $childbirth;?></td>
                <td><?php echo $childbirth1;?></td>
                <td><?php echo $childbirth2;?></td>
            </tr>


            <tr>
                <td class="label">Father's Name :</td>
                <td><?php echo $fname;?></td>
                <td class="label">Occupation</td>
                <td><?php echo $foccupation;?></td>
            </tr>
            <tr>
                <td class="label">Mother's Name :</td>
                <td><?php echo $mname;?></td>
                <td class="label">Occupation</td>
                <td><?php echo $moccupation;?></td>
            </tr>
            <tr>
                <td class="label">Language or dialect spoken and written :</td>
                <td colspan="3"><?php echo $language;?></td>
            </tr>
            <tr>
                <td class="label">Person to be contacted in case of emergency :</td>
                <td colspan="3"><?php echo $ename;?></td>
            </tr>
            <tr>
                <td class="label">His or her address and telephone :</td>
                <td colspan="3"><?php echo $pnum;?></td>
            </tr>
        </table>


        <!-- EDUCATIONAL BACKGROUND -->
        <div class="section-title">EDUCATIONAL BACKGROUND</div>
        <table>
            <tr>
                <td class="label">Elementary :</td>
                <td><?php echo $elementary;?></td>
                <td class="label">Year Graduated</td>
                <td><?php echo $eyear;?></td>
            </tr>
            <tr>
                <td class="label">High School :</td>
                <td><?php echo $highschool;?></td>
                <td class="label">Year Graduated</td>
                <td><?php echo $hyear;?></td>
            </tr>
            <tr>
                <td class="label">College :</td>
                <td><?php echo $college;?></td>
                <td class="label">Year Graduated</td>
                <td><?php echo $cyear;?></td>
            </tr>
            <tr>
                <td class="label">Degree Received :</td>
                <td colspan="3"><?php echo $graduate;?></td>
            </tr>
            <tr>
                <td class="label">Special Skills :</td>
                <td colspan="3"><?php echo $skills;?></td>
            </tr>
        </table>

        <!-- EMPLOYMENT RECORD -->
        <div class="section-title">EMPLOYMENT RECORD</div>
        <table>
            <tr>
                <td class="label">Company Name :</td>
                <td><?php echo $cname;?></td>
                <td class="label" style="width: 7%;">From:</td>
                <td><?php echo $from;?></td>
                <td class="label" style="width: 5%;">To:</td>
                <td><?php echo $to;?></td>
            </tr>
            <tr>
                <td class="label">Position :</td>
                <td colspan="5"><?php $cposition;?></td>
            </tr>
            <tr>
                <td class="label">Company Name :</td>
                <td><?php echo $cname1;?></td>
                <td class="label">From:</td>
                <td><?php echo $from1;?></td>
                <td class="label">To:</td>
                <td><?php echo $to1;?></td>
            </tr>
            <tr>
                <td class="label">Position :</td>
                <td colspan="5"><?php echo $cposition1;?></td>
            </tr>
        </table>

        <!-- CHARACTER REFERENCE -->
        <div class="section-title">CHARACTER REFERENCE</div>
        <table>
            <tr>
                <td class="label">Name :</td>
                <td><?php echo $rname;?></td>
                <td class="label">Company :</td>
                <td><?php echo $rcompany;?></td>
            </tr>
            <tr>
                <td class="label">Position :</td>
                <td><?php echo $rposition;?></td>
                <td class="label">Contact No. :</td>
                <td><?php echo $rcontact;?></td>
            </tr>
            <tr>
                <td class="label">Name :</td>
                <td><?php echo $rname1;?></td>
                <td class="label">Company :</td>
                <td><?php echo $rcompany1;?></td>
            </tr>
            <tr>
                <td class="label">Position :</td>
                <td><?php echo $rposition1;?></td>
                <td class="label">Contact No. :</td>
                <td><?php echo $rcontact1;?></td>
            </tr>
        </table>

        <!-- RES CERTIFICATE -->
        <div class="section-title" style="width: 45%;">Res. Cert. No.</div>

        <table style="width: 45%; float: left;">
            <tr>
                <td class="label">Issued at</td>
                <td><?php echo $iat;?></td>
            </tr>
            <tr>
                <td class="label">Issued on</td>
                <td><?php echo $ion;?></td>
            </tr>
            <tr>
                <td class="label">SSS</td>
                <td><?php echo $sss;?></td>
            </tr>
            <tr>
                <td class="label">TIN</td>
                <td><?php echo $tin;?></td>
            </tr>
            <tr>
                <td class="label">NBI No.</td>
                <td><?php echo $nbi;?></td>
            </tr>
            <tr>
                <td class="label">Passport No.</td>
                <td><?php echo $passport;?></td>
            </tr>
        </table>

        <!-- Declaration -->
        <div style="width: 50%; float: right; margin-top: 0; font-size: 12px;">
            <p>I here certify that the above information is true and correct to the best of my knowledge and belief. I also understand that any misinterpretation will be considered reason for withdrawal of an offer or subsequent dismissal if employed.</p>
            <?php
                if ($signaturePath) {
                    echo '<p><img src="' . $signaturePath . '" alt="Signature" style="width: 150px; height: auto;"></p>';
                } else {
                    echo '<p>Applicant Signature</p>';
                }
            ?>
        </div>
              </table>
      </form>
        

</body>
</html>
