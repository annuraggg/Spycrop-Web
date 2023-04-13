<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="logo/logo.ico">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/loader.css" />
  <link rel="stylesheet" href="css/register.css" />

  <title>Register - Spycrop</title>
</head>

<body>
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>
  <div class="body__main" id="divMain">
    <img src="logo/logo_white_trans.png" />
    <h1>
      <p><?php if (isset($_GET["eData"]) && $_GET["eData"] == 'false') {
            echo "<h1 style='color:red;'>Account with that email already exists</h1>";
          } else {
            echo "Choose Your Role";
          } ?></p>
    </h1>
    <button class="form__button" id="triggerUser" onclick="showUser()">USER</button>
    <button class="form__button" id="triggerHost" onclick="showHost()">HOST</button>
  </div>

  <div id="divUserGreet">
    <h1>Welcome to SpyCrop.</h1>
  </div>
  <div id="divHostGreet">
    <h1>Welcome to SpyCrop</h1>
  </div>

  <div id="divUser">
    <h1>What is Your Email?</h1>
    <form action="" method="post">
      <input type="email" name="email" class="form__button" />
      <input type="hidden" name="type" value="User" />
      <input type="submit" name="submit" class="form__button" onclick="pageExit()">
    </form>
  </div>
  <div id="divHost">
    <h1>What is Your Email?</h1>
    <form action="" method="post">
      <input type="email" name="email" class="form__button" />
      <input type="hidden" name="type" value="Host" />
      <input type="submit" name="submit" class="form__button" onclick="pageExit()">
    </form>
  </div>

  <div id="endCard">
    <h1>Please Wait</h1>
  </div>

  <script src="https://kit.fontawesome.com/2865d561f1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/loader.js"></script>
  <script src="js/register.js"></script>
</body>

</html>

<?php
include('connection.php');
session_start();
if (isset($_POST['email'])) {
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['type'] = $_POST['type'];
  if ($_POST['type'] == "User") {
    $table = "0";
    $table1 = "user_table";
    $_SESSION['type'] = $table;
  }

  if ($_POST['type'] == "Host") {
    $table = "1";
    $table1 = "host_table";
    $_SESSION['type'] = $table;
  }
}



if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $email = mysqli_real_escape_string($con, $email);

  $query1 = "SELECT * FROM $table1 WHERE email= '$email' and verified = 1";
  $result = mysqli_query($con, $query1);
  $rows = mysqli_num_rows($result);



  if ($rows == 1) {

    header("location:register.php?eData=false");
  } else {
    // Send Verification Mail
    $vkey1 = rand(100000, 999999);

    $encstring = $vkey1;
    $cipher = "AES-128-CTR";
    $encryption_key = "34V6VyBza5MPWvj2";
    $options = 0;
    $encryption_iv = '5369498845975729';
    $vkey = openssl_encrypt($encstring, $cipher, $encryption_key, $options, $encryption_iv);
    $_SESSION['vkey'] = $vkey;

    $to = $email;
    $subject = "Verify Your Spycrop Email";
    $message = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'> <head> <xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch></o:PixelsPerInch> </o:OfficeDocumentSettings> </xml> <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <meta name='x-apple-disable-message-reformatting'> <meta http-equiv='X-UA-Compatible' content='IE=edge'> <title></title> <style type='text/css'> table, td{color: #000000;}@media only screen and (min-width: 660px){.u-row{width: 640px !important;}.u-row .u-col{vertical-align: top;}.u-row .u-col-100{width: 640px !important;}}@media (max-width: 660px){.u-row-container{max-width: 100% !important; padding-left: 0px !important; padding-right: 0px !important;}.u-row .u-col{min-width: 320px !important; max-width: 100% !important; display: block !important;}.u-row{width: calc(100% - 40px) !important;}.u-col{width: 100% !important;}.u-col > div{margin: 0 auto;}}body{margin: 0; padding: 0;}table, tr, td{vertical-align: top; border-collapse: collapse;}p{margin: 0;}.ie-container table, .mso-container table{table-layout: fixed;}*{line-height: inherit;}a[x-apple-data-detectors='true']{color: inherit !important; text-decoration: none !important;}</style> <link href='https://fonts.googleapis.com/css?family=Cabin:400,700&display=swap' rel='stylesheet' type='text/css'> </head> <body class='clean-body u_body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000'> <div class='ie-container'> <div class='mso-container'> <table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%' cellpadding='0' cellspacing='0'> <tbody> <tr style='vertical-align: top'> <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'> <table width='100%' cellpadding='0' cellspacing='0' border='0'> <tr> <td align='center' style='background-color: #ffffff;'> <div class='u-row-container' style='padding: 0px;background-color: transparent'> <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;'> <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'> <table width='100%' cellpadding='0' cellspacing='0' border='0'> <tr> <td style='padding: 0px;background-color: transparent;' align='center'> <table cellpadding='0' cellspacing='0' border='0' style='width:640px;'> <tr style='background-color: transparent;'> <td align='center' width='640' style='width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'> <div class='u-col u-col-100' style='max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;'> <div style='width: 100% !important;'> <div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'> <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'> <tbody> <tr> <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'> <table width='100%' cellpadding='0' cellspacing='0' border='0'> <tr> <td style='padding-right: 0px;padding-left: 0px;' align='center'> <img align='center' border='0' src='https://s3.amazonaws.com/unroll-images-production/projects%2F0%2F1643809941498-Screenshot+2022-02-02+192212.png' alt='' title='' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 35%;max-width: 217px;' width='217'/> </td></tr></table> </td></tr></tbody> </table> <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'> <tbody> <tr> <td style='overflow-wrap:break-word;word-break:break-word;padding:12px;font-family:arial,helvetica,sans-serif;' align='left'> <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'> <tbody> <tr style='vertical-align: top'> <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'> <span> </span> </td></tr></tbody> </table> </td></tr></tbody> </table> <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'> <tbody> <tr> <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'> <div style='line-height: 160%; text-align: center; word-wrap: break-word;'> <p style='font-size: 14px; line-height: 160%;'><span style='font-family: 'trebuchet ms', geneva; font-size: 14px; line-height: 22.4px;'><strong><span style='font-size: 20px; line-height: 32px;'>Welcome to the Club! Your One Time Password for Creating Your SpyCrop Account<span style='line-height: 32px; font-size: 20px;'> </span>is:</span></strong></span></p></div></td></tr></tbody> </table> <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'> <tbody> <tr> <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'> <h2 style='margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: 'Cabin',sans-serif; font-size: 30px;'>"
      . $vkey1 .
      "</h2> </td></tr></tbody> </table> <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'> <tbody> <tr> <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'> <div style='line-height: 140%; text-align: left; word-wrap: break-word;'> <p style='font-size: 14px; line-height: 140%;'><span style='font-family: 'andale mono', times; font-size: 14px; line-height: 19.6px;'>In these difficult times, we wish everyone a happy and safe times. It's been one of the most difficult years in recent history. Staying at home makes a difference and may be the reason a family member, friend, roommate, or neighbour remains healthy—which is always valuable. Remember that the pandemic will not persist indefinitely. </span></p><p style='font-size: 14px; line-height: 140%;'> </p><p style='font-size: 14px; line-height: 140%;'><span style='font-family: 'andale mono', times; font-size: 14px; line-height: 19.6px;'>However, until then, continue to use masks as a critical precaution to minimise transmission and preserve lives. Maintaining physical distance, avoiding crowded, confined, and close-contact situations, ensuring proper ventilation of interior places, wiping hands regularly, and concealing sneezes and coughs with a bent elbow tissue should all be part of a complete 'Do it all!' strategy. </span></p><p style='font-size: 14px; line-height: 140%;'> </p><p style='font-size: 14px; line-height: 140%;'><span style='font-family: 'andale mono', times; font-size: 14px; line-height: 19.6px;'>- Team SpyCrop</span></p></div></td></tr></tbody> </table> <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'> <tbody> <tr> <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'> <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'> <tbody> <tr style='vertical-align: top'> <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'> <span> </span> </td></tr></tbody> </table> </td></tr></tbody> </table> <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'> <tbody> <tr> <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'> <div style='color: #f30000; line-height: 140%; text-align: center; word-wrap: break-word;'> <p style='font-size: 14px; line-height: 140%;'>Please disregard the OTP if you did not request it. Avoid Sharing it with anyone else.</p></div></td></tr></tbody> </table> </div></div></div></td></tr></table> </td></tr></table> </div></div></div></td></tr></table> </td></tr></tbody> </table> </div></div></body></html>";

    $headers = "From: spycrop@outlook.com \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to, $subject, $message, $headers);
    header('location: verify.php');
  }
}
?>
