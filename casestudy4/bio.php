<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bio Data</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px auto;
        max-width: 900px;
        background-color: #f8f9fa;
        color: #333;
        padding: 20px 30px;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    h1 {
        text-align: center;
        font-weight: 900;
        font-size: 2.5em;
        letter-spacing: 2px;
        margin-bottom: 30px;
    }

    form {
        position: relative;
    }

    label[for="picture"]::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 90px;
        height: 90px;
        border: 1px solid #333;
        box-sizing: border-box;
        background: #fff;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 12px;
        gap: 10px;
    }

    label {
        width: 120px;
        font-weight: 600;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="number"],
    select,
    textarea {
        flex-grow: 1;
        padding: 6px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 0.95em;
        box-sizing: border-box;
    }

    textarea {
        min-height: 60px;
        resize: vertical;
    }

    fieldset {
        margin-top: 30px;
        border: none;
        border-top: 3px solid #222;
        padding-top: 20px;
    }

    fieldset legend {
        font-weight: 700;
        background-color: #222;
        color: white;
        padding: 6px 14px;
        border-radius: 4px;
        width: fit-content;
        font-size: 1.1em;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 1px 1px 5px rgba(0,0,0,0.15);
    }
    
    .error {
        color: #d93025;
        font-size: 0.9em;
        margin-left: 190px;
        display: block;
        margin-top: -10px;
        margin-bottom: 10px;
    }


    .rows input[type="radio"] {
        margin-left: 80px;
        margin-right: 4px;
        transform: scale(1.1);
        margin-bottom: 10px;
        
    }

    .declaration {
        font-style: italic;
        margin-bottom: 20px;
    }

    .sign input[type="file"] {
        margin-left: 10px;
    }

    button[type="submit"] {
        background-color: #222;
        color: white;
        font-weight: 700;
        font-size: 1.1em;
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 30px;
        display: block;
        width: 200px;
        margin-left: auto;
        margin-right: auto;
        transition: background-color 0.3s ease;
        letter-spacing: 1.2px;
    }

    button[type="submit"]:hover {
        background-color: #555;
    }

    small {
        font-size: 0.8em;
        color: #666;
        margin-left: 100px;
    }

    #signUpload {
        margin-top: 8px;
    }

    .row > label, .row > input{
        margin-right: 10px;
        
    }



    @media (max-width: 700px) {
        .row {
            flex-direction: column;
            align-items: flex-start;
        }

        label {
            width: 100%;
            margin-bottom: 4px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="number"],
        select,
        textarea {
            width: 100% !important;
            margin-bottom: 10px;
            flex-grow: 0;
        }

        .error {
            margin-left: 0;
        }
    }
</style>

</head>
<body>
    <h1>BIO-DATA</h1>
    <form method="POST" action="display.php" enctype="multipart/form-data" >
        
    <div class="row">
            <label>2x2 Picture: </label>
            <input type="file" id="picture" name="picture" accept="image/*" />
            <span class="error" id="pictureError"></span>
        </div>

        <fieldset>
            <legend>Personal Information</legend>
            <div class="row">
                <label>Position Desired:</label>
                <input type="text" id="position" name="position" />
                <span class="error" id="positionError"></span>
            </div>

            <div class="row">
                <label>Date:</label>
                <input type="date" id="datenow" name="datenow" />
                <span class="error" id="datenowError"></span>
            </div>

            <div class="row">
                <label>Full Name:</label>
                <input type="text" id="name" name="name" />
                <small>(Last Name, First Name, Middle Name)</small>
                <span class="error" id="nameError"></span>
            </div>

            <div class="rows">
                <label>Gender:</label>
                <input type="radio" id="male" name="gender" value="male" />
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" />
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="other" />
                <label for="other">Others</label>
                <span class="error" id="genderError"></span>
            </div>

            <div class="row">
                <label>City Address:</label>
                <input type="text" id="city" name="city" />
                <label>Provincial Address:</label>
                <input type="text" id="provincial" name="provincial" />
                <span class="error" id="cityProvError"></span>
            </div>

            <div class="row">
                <label>Telephone:</label>
                <input type="number" id="tel" name="tel" />
                <label>Cellphone:</label>
                <input type="number" id="cell" name="cell" />
                <span class="error" id="telCellError"></span>
            </div>

            <div class="row">
                <label>E-mail Address:</label>
                <input type="email" id="email" name="email" />
                <span class="error" id="emailError"></span>
            </div>

            <div class="row">
                <label>Date of Birth:</label>
                <input type="date" id="dob" name="dob" />
                <label>Birthplace:</label>
                <input type="text" id="birthplace" name="birthplace" />
                <span class="error" id="dobPlaceError"></span>
            </div>

            <div class="row">
                <label>Civil Status:</label>
                <select name="status" id="status">
                    <option value="">--Select--</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="widowed">Widowed</option>
                    <option value="separated">Separated</option>
                    <option value="divorced">Divorced</option>
                </select>
                <span class="error" id="statusError"></span>
            </div>

            <div class="row">
                <label>Citizenship:</label>
                <input type="text" id="citizen" name="citizen" />
                <span class="error" id="citizenError"></span>
            </div>

            <div class="row">
                <label>Height (cm):</label>
                <input type="number" id="height" name="height" min="0" />
                <label>Weight (kg):</label>
                <input type="number" id="weight" name="weight" min="0" />
                <span class="error" id="heightWeightError"></span>
            </div>

            <div class="row">
                <label>Religion:</label>
                <input type="text" id="religion" name="religion" />
            </div>

            <div class="row">
                <label>Spouse:</label>
                <input type="text" id="spouse" name="spouse" />
                <label>Occupation:</label>
                <input type="text" id="occupation" name="occupation" />
            </div>

            <div class="row">
                <label>Name of children:</label>
                <input type="text" id="children" name="children" />
                <input type="text" id="children1" name="children" />
                <input type="text" id="children2" name="children" />
                <label>Date of Birth:</label>
                <input type="date" id="childbirth" name="childbirth" />
                <input type="date" id="childbirth1" name="childbirth" />
                <input type="date" id="childbirth2" name="childbirth" />
            </div>

            <div class="row">
                <label>Father’s name:</label>
                <input type="text" id="fname" name="fname" />
                <label>Occupation:</label>
                <input type="text" id="foccupation" name="foccupation" />
            </div>

            <div class="row">
                <label>Mother’s name:</label>
                <input type="text" id="mname" name="mname" />
                <label>Occupation:</label>
                <input type="text" id="moccupation" name="moccupation" />
            </div>

            <div class="row">
                <label>Language or dialect spoken and written:</label>
                <input type="text" id="language" name="language" />
            </div>

            <div class="row">
                <label>Person to be contact in case of emergency:</label>
                <input type="text" id="ename" name="ename" />
                <span class="error" id="enameError"></span>
            </div>

            <div class="row">
                <label>Phone Number:</label>
                <input type="text" id="pnum" name="pnum" />
                <span class="error" id="pnumError"></span>
            </div>
        </fieldset>

        <fieldset>
        <legend>Educational Background</legend>
        <div class="row">
            <label>Elementary:</label>
            <input type="text" id="elementary" name="elementary">
            <label>Year Graduated:</label>
            <input type="text" id="eyear" name="eyear">
        </div>

        <div class="row">
            <label>High School:</label>
            <input type="text" id="highschool" name="highschool">
            <label>Year Graduated:</label>
            <input type="text" id="hyear" name="hyear">
        </div>

        <div class="row">
            <label>Vocational/College:</label>
            <input type="text" id="college" name="college">
            <label>Year Graduated:</label>
            <input type="text" id="cyear" name="cyear">
        </div>

        <div class="row">
            <label>Degree Recived:</label>
            <input type="text" id="graduate" name="graduate">
        </div>

        <div class="row">
            <label>Special Skills:</label>
             <textarea name="skills" id="skills"></textarea>
        </div>
    </fieldset>
    <fieldset>
        <legend>Employment Record</legend>
        <div class="row">
            <label>Company Name:</label>
            <input type="text" id="cname" name="cname">
            <label>Position:</label>
            <input type="text" id="cposition" name="cposition">
        </div>

        <div class="row">
            <label>From:</label>
            <input type="text" id="from" name="from">
            <label>To:</label>
            <input type="text" id="to" name="to">
        </div>

        <div class="row">
            <label>Company Name:</label>
            <input type="text" id="cname1" name="cname1">
               <label>Position:</label>
            <input type="text" id="cposition1" name="cposition1">
        </div>

        <div class="row">
            <label>From:</label>
            <input type="text" id="from1" name="from1">
            <label>To:</label>
            <input type="text" id="to1" name="to1">
        </div>
    </fieldset>
    <fieldset>
        <legend>Character Reference</legend>
        <div class="row">
            <label>Name:</label>
            <input type="text" id="rname" name="rname">
            <label>Company:</label>
            <input type="text" id="rcompany" name="rcompany">
        </div>

        <div class="row">
            <label>Position:</label>
            <input type="text" id="rposition" name="rposition">
            <label>Contact Number:</label>
            <input type="text" id="rcontact" name="rcontact">
        </div>

        <div class="row">
            <label>Name:</label>
            <input type="text" id="rname1" name="rname1">
            <label>Company:</label>
            <input type="text" id="rcompany1" name="rcompany1"> 
        </div>

        <div class="row">
            <label>Position:</label>
            <input type="text" id="rposition1" name="rposition1">
            <label>Contact Number:</label>
            <input type="text" id="rcontact1" name="rcontact1">
        </div>
    </fieldset>

    <fieldset>
        <legend>Other Information</legend>
        <div class="row">
            <label>Res. Cert. Number:</label>
            <input type="number" id="cert" name="cert">
        </div>

        <div class="row">
            <label>Issued at:</label>
            <input type="date" id="iat" name="iat">
            <label>Issued on:</label>
            <input type="date" id="ion" name="ion">
        </div>

        <div class="row">
            <label>SSS:</label>
            <input type="number" id="sss" name="sss">
        </div>

        <div class="row">
            <label>Tin:</label>
            <input type="number" id="tin" name="tin">
        </div>

        <div class="row">
            <label>NBI No.:</label>
            <input type="text" id="nbi" name="nbi">
        </div>

        <div class="row">
            <label>Passport No.:</label>
            <input type="text" id="passport" name="passport">
        </div>
    </fieldset>


        <fieldset>
            <legend>Declaration</legend>
            <div class="declaration">
                <label>I here certify that the above information is true and correct to the 
                    best of my knowledge and belief. I also understand that any misinterpretation
                    will be considered reason for withdrawal of an offer or subsequent dismissal if employed.</label>
            </div>
            <div class="sign">
                <label>Applicant's Signature:</label>
                <input type="file" id="signUpload" name="signUpload" accept="image/*" />
                <span class="error" id="signUploadError"></span>
            </div>
        </fieldset>

        <button type="submit" name="submit" onclick="return validateForm()">Submit</button>
    </form>

    <script>
        function validateForm() {
            document.getElementById('pictureError').textContent = '';
            document.getElementById('positionError').textContent = '';
            document.getElementById('datenowError').textContent = '';
            document.getElementById('nameError').textContent = '';
            document.getElementById('genderError').textContent = '';
            document.getElementById('cityProvError').textContent = '';
            document.getElementById('telCellError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('dobPlaceError').textContent = '';
            document.getElementById('statusError').textContent = '';
            document.getElementById('citizenError').textContent = '';
            document.getElementById('heightWeightError').textContent = '';
            document.getElementById('enameError').textContent = '';
            document.getElementById('pnumError').textContent = '';
            document.getElementById('signUploadError').textContent = '';

            let valid = true;

            // Validate 2x2 Picture (required and must be image)
            const picture = document.getElementById('picture');
            if (picture.files.length === 0) {
                document.getElementById('pictureError').textContent = 'Please upload your 2x2 picture.';
                valid = false;
            } else {
                const picFile = picture.files[0];
                if (!picFile.type.startsWith('image/')) {
                    document.getElementById('pictureError').textContent = 'File must be an image.';
                    valid = false;
                }
            }

            // Position Desired (required)
            const position = document.getElementById('position').value.trim();
            if (position === '') {
                document.getElementById('positionError').textContent = 'Position desired is required.';
                valid = false;
            }

            // Date (required)
            const datenow = document.getElementById('datenow').value;
            if (datenow === '') {
                document.getElementById('datenowError').textContent = 'Date is required.';
                valid = false;
            }

            // Full Name (required)
            const name = document.getElementById('name').value.trim();
            if (name === '') {
                document.getElementById('nameError').textContent = 'Full name is required.';
                valid = false;
            }

            // Gender (required)
            const male = document.getElementById('male').checked;
            const female = document.getElementById('female').checked;
            const other = document.getElementById('other').checked;
            if (!male && !female && !other) {
                document.getElementById('genderError').textContent = 'Please select your gender.';
                valid = false;
            }

            // City and Provincial Address (at least one required)
            const city = document.getElementById('city').value.trim();
            const provincial = document.getElementById('provincial').value.trim();
            if (city === '' && provincial === '') {
                document.getElementById('cityProvError').textContent = 'Please enter city or provincial address.';
                valid = false;
            }

            // Telephone and Cellphone (at least one required)
            const tel = document.getElementById('tel').value.trim();
            const cell = document.getElementById('cell').value.trim();
            if (tel === '' && cell === '') {
                document.getElementById('telCellError').textContent = 'Please enter telephone or cellphone number.';
                valid = false;
            }

            // Email (required and valid format)
            const email = document.getElementById('email').value.trim();
            if (email === '') {
                document.getElementById('emailError').textContent = 'Email is required.';
                valid = false;
            } else {
                // Simple email regex
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                    valid = false;
                }
            }

            // Date of Birth and Birthplace (both required)
            const dob = document.getElementById('dob').value;
            const birthplace = document.getElementById('birthplace').value.trim();
            if (dob === '' || birthplace === '') {
                document.getElementById('dobPlaceError').textContent = 'Date of birth and birthplace are required.';
                valid = false;
            }

            // Civil Status (required)
            const status = document.getElementById('status').value;
            if (status === '') {
                document.getElementById('statusError').textContent = 'Please select your civil status.';
                valid = false;
            }

            // Citizenship (required)
            const citizen = document.getElementById('citizen').value.trim();
            if (citizen === '') {
                document.getElementById('citizenError').textContent = 'Citizenship is required.';
                valid = false;
            }

            // Height and Weight (both required and positive numbers)
            const height = document.getElementById('height').value;
            const weight = document.getElementById('weight').value;
            if (height === '' || weight === '') {
                document.getElementById('heightWeightError').textContent = 'Height and weight are required.';
                valid = false;
            } else if (height <= 0 || weight <= 0) {
                document.getElementById('heightWeightError').textContent = 'Height and weight must be positive numbers.';
                valid = false;
            }

            // Person to contact in case of emergency (required)
            const ename = document.getElementById('ename').value.trim();
            if (ename === '') {
                document.getElementById('enameError').textContent = 'Please enter emergency contact person.';
                valid = false;
            }

            // Phone number of emergency contact (required)
            const pnum = document.getElementById('pnum').value.trim();
            if (pnum === '') {
                document.getElementById('pnumError').textContent = 'Please enter emergency contact phone number.';
                valid = false;
            }

            // Applicant's Signature (required and must be image)
            const signUpload = document.getElementById('signUpload');
            if (signUpload.files.length === 0) {
                document.getElementById('signUploadError').textContent = 'Please upload your signature.';
                valid = false;
            } else {
                const signFile = signUpload.files[0];
                if (!signFile.type.startsWith('image/')) {
                    document.getElementById('signUploadError').textContent = 'Signature file must be an image.';
                    valid = false;
                }
            }

            return valid;
        }
    </script>
</body>
</html>
