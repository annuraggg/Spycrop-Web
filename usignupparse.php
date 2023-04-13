<?php
include('connection.php');
session_start();

if (!isset($_SESSION['email'])) {
    echo "<h2>Something Went Wrong. That's all the Information we have :(</h2>";
    die();
}

/***********************************************/

// Initialize all post data from the form
$fname = $lname = $email = $phone = $dob = $gender = $dept = $div = $sem = $rollno = $enrollno = $pass = $cpass = $tokenkey = $token = " ";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_SESSION['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$dept = $_POST['dept'];
$div = $_POST['div'];
$sem = $_POST['sem'];
$rollno = $_POST['rollno'];
$enrollno = $_POST['enrollno'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$verifystatus = $_SESSION['verifystatus'];
$tokenkey = openssl_random_pseudo_bytes(32);
$token = bin2hex($tokenkey);

/***********************************************/
// Data Formatting
$fnError = $lnError = $emailError = $phoneError = $rollError = $enrollError = $passError = $cpassError = "";

function test_input($data)
{ //test the data and remove unneccesary content
    include('connection.php');
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($con, $data);
    return $data;
}

/***********************************************/
// Data Filtering
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
        $fnError = "First Name";
    } else {
        $fname = test_input($_POST["fname"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["lname"])) {
        $lnError = "Last Name";
    } else {
        $lname = test_input($_POST["lname"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["phone"])) {
        $phoneError = "Phone";
    } else {
        $phone = test_input($_POST["phone"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["rollno"])) {
        $rollError = "Roll Number";
    } else {
        $rollid = test_input($_POST["rollno"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["enrollno"])) {
        $enrollError = "Enrollment Number";
    } else {
        $enrollno = test_input($_POST["enrollno"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["pass"])) {
        $passError = "Password";
    } else {
        $pass = test_input($_POST["pass"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["cpass"])) {
        $cpassError = "Password";
    } else {
        $cpass = test_input($_POST["cpass"]);
    }
}

/***********************************************/
$query1 = "SELECT * FROM user_table WHERE email= '$email' and verified = 1";
$result = mysqli_query($con, $query1);
$rows = mysqli_num_rows($result);
if ($rows == 1) {
    echo "Account with this email already exists.";
} else {

    if (isset($fname) && ($lname) && ($email) && ($phone) && ($dob) && ($gender) && ($dept) && ($div) && ($sem) && ($rollno) && ($enrollno) && ($pass)) {
        // Check for password confirm match
        if ($cpass == $pass) {
            // Check if email format is correct
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check password length
                if (strlen($pass) >= 8 && strlen($cpass) <= 20) {
                    // Encrypt password
                    $password = password_hash($pass, PASSWORD_DEFAULT);
                    // Add data
                    $query = "INSERT into `user_table` (fName, lName, email, phone, rollNo, enrollNo, dept, divi, sem, dob, gender, password, verified, vkey)
                					VALUES ('$fname', '$lname', '$email', '$phone', '$rollno', '$enrollno', '$dept', '$div', '$sem', '$dob', '$gender', '$password', '$verifystatus', '$token')";
                    $result = mysqli_query($con, $query);
                    session_destroy();
                    header("Location: index.php");
                } else {
                    echo '<h1>Error!</h1>
                      <hr>
                      <h4>Passwords must be between 8 and 20 characters long</h4>';
                    echo "<h4>Click <a href='register.php'>Here</a> to register again.</h4>";
                }
            } else { //checks if email format is correct
                echo '<h1>Error!</h1>
                      <hr>
                      <h4>Invalid Email Format</h4>';
                echo "<h4>Click <a href='register.php'>Here</a> to register again.</h4>";
            }
        } else {
            echo '<h1>Error!</h1>
                      <hr>
                      <h4>The password and confirm password fields do not match</h4>';
            echo "<h4>Click <a href='register.php'>Here</a> to register again.</h4>";
        };
    } else { //else display missing parameters
        echo '<h1>Error!</h1>
                      <hr>
                      <h2 style="font-weight:normal">The following fields are empty:</h2>';
        echo '<h3 style="font-weight:normal">', $fnError, ' ', $lnError, ' ', $passError, ' ', $emailError, ' ', $phoneError, ' ', $rollError, ' ', $enrollError;
        echo "<h4>Click <a href='register.php'>Here</a> to register again.</h4>";
    }
}
