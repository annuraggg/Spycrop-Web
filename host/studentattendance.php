<?php
session_start();
include('../connection.php');
error_reporting(0);
if (!isset($_SESSION['vkey'])) {
   header("Location:../index.php");
}

$vkey = $_SESSION['vkey'];

$query    = "SELECT * FROM `host_table` WHERE vkey='$vkey'";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_array($result);
?>

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" type="image/x-icon" href="../logo/logo.ico">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
   <link rel="stylesheet" href="../css/loader.css" />
   <link rel="stylesheet" href="css/navbar.css" />
   <link rel="stylesheet" href="css/dashboard.css" />

   <title>Student Attendance</title>
</head>

<body>
   <div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
   </div>
   <div class=primary-nav>
      <nav class=menu role=navigation><a href=# class=logotype>SPY<span>CROP</span></a>
         <div class=overflow-container>
            <ul class=menu-dropdown>
               <li><a href="dashboard.php">Dashboard</a><span class=icon><i class="fa fa-dashboard"></i></span>
               <li><a href="profile.php">Your Profile</a><span class=icon><i class="fa-solid fa-user"></i></span>
               <li><a href="attendance.php">Attendance</a><span class=icon><i class="fa-solid fa-user-check"></i></span>
               <li><a href="alerts.php">Mask Alerts</a><span class=icon><i class="fa-solid fa-user-xmark"></i></span>
               <li><a href="studentalerts.php">Student Alerts</a><span class=icon><i class="fa-solid fa-graduation-cap"></i></span>
               <li><a href="studentattendance.php">Student Attendance</a><span class=icon><i class="fa-solid fa-school"></i></span>
               <li ><a href="logout.php">Logout</a><span class=icon><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
            </ul>
         </div>
      </nav>
   </div>

   <div class="new-wrapper">

      <div id="main">

         <div id="main-contents">

            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Student Attendance</li>
               </ol>
            </nav>
            <!-- Attendance Code Here -->
         </div>
      </div>
   </div>

   </div>
   <script src="https://kit.fontawesome.com/2865d561f1.js" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="../js/loader.js"></script>
   <script src="js/navbar.js"></script>
</body>