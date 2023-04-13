<?php
include('connection.php');
session_start();

if (isset($_SESSION['vkey'])) {
    $decstring = $_SESSION['vkey'];
    $cipher = "AES-128-CTR";
    $decryption_key = "34V6VyBza5MPWvj2";
    $options = 0;
    $decryption_iv = '5369498845975729';
    $vkey = openssl_decrypt($decstring, $cipher, $decryption_key, $options, $decryption_iv);
    $verifystatus = '0';
} else {
    header('location: uregister.php');
}
?>
<!DOCTYPE HTML>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="logo/logo.ico">

    <link rel="stylesheet" href="css/loader.css" />
    <link rel="stylesheet" href="css/signup.css" />

    <title>Signup - Spycrop</title>
</head>

<body>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <div class="container">
        <header>SpyCrop</header>
        <div class="progress-bar">
            <div class="step">
                <p>Name</p>
                <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Contact</p>
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Birth Info</p>
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Class</p>
                <div class="bullet">
                    <span>4</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Identifiers</p>
                <div class="bullet">
                    <span>5</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Password</p>
                <div class="bullet">
                    <span>6</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
        </div>
        <div class="form-outer">
            <form action="usignupparse.php" method="post" name="form1">
                <div class="page slide-page">
                    <div class="title">What Should we Call You?</div>
                    <div class="field">
                        <div class="label">First Name</div>
                        <input type="text" name="fname" required />
                    </div>
                    <div class="field">
                        <div class="label">Last Name</div>
                        <input type="text" name="lname" required />
                    </div>
                    <div class="field">
                        <button class="first-next next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">How should we contact you?</div>
                    <div class="field">
                        <div class="label">Email Address</div>
                        <input type="email" name="email" placeholder="<?php echo $_SESSION['email']; ?>" disabled />
                    </div>
                    <div class="field">
                        <div class="label">Phone Number</div>
                        <input type="number" name="phone" id='phone' onkeyup="phonenumber()" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required />
                    </div>
                    <div class="field1">
                        <p id='phmessage'></p>
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">Previous</button>
                        <button class="next-1 next" id="phvalid">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">Birth Information</div>
                    <div class="field">
                        <div class="label">Date</div>
                        <input type="date" name="dob" required />
                    </div>
                    <div class="field">
                        <div class="label">Gender</div>
                        <select name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="field btns">
                        <button class="prev-4 prev">Previous</button>
                        <button class="next-4 next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">Class Information</div>
                    <div class="field">
                        <div class="label">Department</div>
                        <select name="dept" required>
                            <option value="INFT">Information Technology</option>
                            <option value="COEN">Computer Engineering</option>
                            <option value="ET">Electronics and TeleCommunication</option>
                        </select>
                    </div>
                    <div class="field">
                        <div class="label">Division</div>
                        <select name="div" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <div class="field">
                        <div class="label">Semester</div>
                        <select name="sem" required>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                            <option value="5">5th</option>
                            <option value="6">6th</option>
                        </select>
                    </div>
                    <div class="field btns">
                        <button class="prev-4 prev">Previous</button>
                        <button class="next-4 next">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">Personal Identifiers</div>
                    <div class="field">
                        <div class="label">Roll Number</div>
                        <input type="text" name="rollno" id="rollno" onkeyup="rollnumber()" maxlength="10" required />
                    </div>
                    <div class="field1">
                        <p id='romessage'></p>
                    </div>
                    <div class="field">
                        <div class="label">Enrollment Number</div>
                        <input type="number" name="enrollno" maxlength="10" id='enrollno' onkeyup="enrollnumber()" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required />
                    </div>
                    <div class="field1">
                        <p id='enmessage'></p>
                    </div>
                    <div class="field btns">
                        <button class="prev-4 prev">Previous</button>
                        <button class="next-4 next" id="enrovalid">Next</button>
                    </div>
                </div>
                <div class="page">
                    <div class="title" id='pwmessage'>Make a <span style="font-weight:bolder;">Strong</span> and <span style="font-weight:bolder;">Memorable</span> Password that you will not use anywhere else.</div>
                    <div class="field">
                        <div class="label">Password</div>
                        <input type="password" name="pass" id="password" onkeyup='pwcheck(); pwValidation();' required />
                    </div>
                    <div class="field">
                        <div class="label">Confirm Password</div>
                        <input type="password" name="cpass" id="conpassword" onkeyup='pwcheck();' required /><br>
                    </div>
                    <div class="field1">
                        <p id="pwErrorField"></p>
                        <a class="eyeparent" onclick="showPass()" id="passeye">Show Password</a>
                    </div>
                    <div class="field btns">
                        <button class="prev-5 prev">Previous</button>
                        <button type="submit" class="submit" id="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Main JS Libarary -->
        <script src="https://kit.fontawesome.com/2865d561f1.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/loader.js"></script>
        <script src="js/signup.js"></script>
    </div>
</body>

</html>
</body>

</html>