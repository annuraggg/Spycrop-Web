<?php
session_start();

include('connection.php');

$otp = '0';

if (isset($_POST['otp'])) {
    $userotp = $_POST['otp'];
}


if (isset($_SESSION['vkey'])) {
    $decstring = $_SESSION['vkey'];
    $cipher = "AES-128-CTR";
    $decryption_key = "34V6VyBza5MPWvj2";
    $options = 0;
    $decryption_iv = '5369498845975729';
    $vkey = openssl_decrypt($decstring, $cipher, $decryption_key, $options, $decryption_iv);
    $otp = $vkey;
    $verifystatus = '0';
} else {
    header('location: signup.php');
}

if (isset($_POST['otp'])) {
    if ($otp == $userotp) {
        $verifytext = " ";
        $verifystatus = '1';
        if ($_SESSION['type'] == 0) {
            header('location: usignup.php');
        } elseif ($_SESSION['type'] == 1) {
            header('location: hsignup.php');
        } else {
            echo "Security Error. Please Try Again";
        }
    }
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="logo/logo.ico">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/loader.css" />
    <link rel="stylesheet" href="css/verify.css" />

    <title>Register - Spycrop</title>
</head>

<body>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <div>

        <form action="" method="post" id="form">

            <div class="mb-6 text-center">
                <h1 class="form__heading">Enter the OTP that was E-Mailed to you.</h1>
                <div id="otp" class="flex justify-center">
                    <form action="" method="post" name="form">
                        <input class="m-2 text-center form-control form-control-solid rounded" type="number" id="first" maxlength="1" onkeyup="combineInput()" autocomplete="off" />
                        <input class="m-2 text-center form-control form-control-solid rounded" type="number" id="second" maxlength="1" onkeyup="combineInput()" autocomplete="off" />
                        <input class="m-2 text-center form-control form-control-solid rounded" type="number" id="third" maxlength="1" onkeyup="combineInput()" autocomplete="off" />
                        <input class="m-2 text-center form-control form-control-solid rounded" type="number" id="fourth" maxlength="1" onkeyup="combineInput()" autocomplete="off" />
                        <input class="m-2 text-center form-control form-control-solid rounded" type="number" id="fifth" maxlength="1" onkeyup="combineInput()" autocomplete="off" />
                        <input class="m-2 text-center form-control form-control-solid rounded" type="number" id="sixth" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeyup="combineInput()" autocomplete="off" />
                        <input class="m-2 text-center form-control form-control-solid rounded" type="number" id="sixth" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onkeyup="combineInput()" hidden autocomplete="off" />
                        <input type="text" name="otp" class="form__submit" id="otpParse" hidden />

                    </form>

                </div><input type="submit" form="form" class="form__submit" />
                <!-- <p id="otperr" style="color:red;"><?php if (isset($_GET["loginValid"]) && $_GET["loginValid"] == 'false') {
            //   echo "<p style='color:red;'>Please Check the OTP</p>";
            // } else {
            //   echo " ";
            } ?></p> -->
            </div>

        </form>


        <script src="https://kit.fontawesome.com/2865d561f1.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/loader.js"></script>
        <script src="js/verify.js"></script>
</body>