<?php

session_start();
include('../connection.php');
error_reporting(0);
if (!isset($_SESSION['vkey'])) {
    header("Location:../index.php");
}

$vkey = $_SESSION['vkey'];

$query    = "SELECT * FROM `user_table` WHERE vkey='$vkey'";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_array($result);

$image_data = $data['displayImg'];
$encoded_image = base64_encode($image_data);
$profileimage = "data:image;base64,{$encoded_image}";
// echo $profileimage;
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../logo/logo.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/loader.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/profile.css" />

    <title>Profile</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
                <div class="container container-large">
                    <div class="row ">
                        <div class="card text-light" style="width: 18rem;">

                            <div class="col-4">
                                <div class="card-body">
                                    <div class="pfp" style="background-image:url(<?php echo $profileimage; ?>); background-size: cover;"></div>

                                </div>
                            </div>

                        </div>

                        <div class="col-4 profile">
                            <h3><?php echo $data['fName'] . " " . $data['lName']; ?></h3>
                            <h6>Student, <?php echo $data['dept'] ?> </h6>
                            <p>Semester <?php echo $data['sem']; ?>, Division <?php echo $data['divi']; ?></p>
                            <form action="" method="post" enctype="multipart/form-data" id="upload-pic">
                                <label for="upload-photo" class="upload-pfp">Change Picture </label>
                                <input type="file" name="uploadpfp" id="upload-photo" accept="image/*" />
                            </form>
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-sm-6">
                            <h6>EMAIL</h6>
                            <p><?php echo $data['email']; ?></p>
                            <h6>PHONE</h6>
                            <p><?php echo $data['phone']; ?></p>
                        </div>
                        <div class="col-sm-6">
                            <h6>Roll No.</h6>
                            <p><?php echo $data['rollNo'] ?></p>
                            <h6>Enrollment Number</h6>
                            <p><?php echo $data['enrollNo'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/2865d561f1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/loader.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/profile.js"></script>
</body>

<?php

$check = getimagesize($_FILES["uploadpfp"]["tmp_name"]);
if ($check !== false) {
    $image = $_FILES['uploadpfp']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    $insert = $con->query("UPDATE user_table
                                  SET displayImg = '$imgContent'
                                  WHERE vkey = '$vkey';");
    if ($insert) {
        header('Location:profile.php');
    }
}
