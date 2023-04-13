<?php
session_start();
include('../connection.php');

if (!isset($_SESSION['vkey'])) {
   header("Location:../index.php");
}

$vkey = $_SESSION['vkey'];

if (isset($_GET['searchquery'])) {
   $searchquery = $_GET['searchquery'];
   $query    = "SELECT * FROM `host_alerts` WHERE staffid = $searchquery";
   $result = mysqli_query($con, $query);
} else {
   $query    = "SELECT * FROM `host_alerts`";
   $result = mysqli_query($con, $query);
}
?>

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" type="image/x-icon" href="../logo/logo.ico">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
   <link rel="stylesheet" href="../css/loader.css" />
   <link rel="stylesheet" href="css/navbar.css" />
   <link rel="stylesheet" href="css/alerts.css" />

   <title>Staff Alerts</title>
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
               <li><a href="attendance.php">Staff Attendance</a><span class=icon><i class="fa-solid fa-user-check"></i></span>
               <li><a href="alerts.php">Staff Alerts</a><span class=icon><i class="fa-solid fa-user-xmark"></i></span>
               <li><a href="students.php">Enrolled Student List</a><span class=icon><i class="fa-solid fa-graduation-cap"></i></span>
               <li><a href="staff.php">Enrolled Staff List</a><span class=icon><i class="fa-solid fa-school"></i></span>
               <li><a href="logout.php">Logout</a><span class=icon><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
            </ul>
         </div>
      </nav>
   </div>

   <div class="new-wrapper">

      <div id="main">

         <div id="main-contents">

            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Staff Alerts</li>
               </ol>
            </nav>
            <form action="">
               <p class="form-p">Enter the Staff ID to Search Records For:</p>
               <input type="text" placeholder="Search ID Here" name="searchquery" />
               <input type="submit" value="Submit">
            </form>
            <table>
               <table>
                  <tr>
                     <th>ID</th>
                     <th>Staff ID</th>
                     <th>Datestamp</th>
                     <th>Timestamp</th>
                  </tr>

                  <?php

                  if ($result->num_rows >= 0) {
                     while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["userid"] . "</td><td>" . $row["staffid"] . "</td><td>" . $row["datestamp"] . "</td><td>" . $row["timestamp"] . "</td>" . "</tr>";
                     }
                  }
                  ?>
               </table>
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