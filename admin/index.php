 <?php
 session_start();

 include('../connection.php');

 if (isset($_POST['user'])) {
     $user = $_POST['user'];
     $pass1 = $_POST['password'];

     $query    = "SELECT * FROM `admin_table` WHERE username ='$user'";
     $result = mysqli_query($con, $query);
     $rows = mysqli_num_rows($result);

     if ($rows == 1) {
       while ($row = $result->fetch_assoc()) {
         $storedpass = $row['password'];
         $pwVerify = password_verify($pass1, $storedpass);
       }
       if ($pwVerify) {
         header("Location: dashboard.php");
         $_SESSION['vkey'] = $user;
       } else {
         header("location:index.php?loginValid=false");
       }
     }
 }


 ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" type="image/x-icon" href="logo/logo.ico">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
   <link rel="stylesheet" href="../css/loader.css" />
   <link rel="stylesheet" href="css/index.css" />

   <title>Admin Panel</title>
 </head>

 <body>
   <div class="loader-wrapper">
     <span class="loader"><span class="loader-inner"></span></span>
   </div>

   <div class="body__main-outer">
     <div class="body__main">
       <img src="../logo/logo_white_trans.png" />
       <h1>Login to Spycrop.</h1>
       <form action="" method="post">
         <div class="row">
           <div class="col-lg-5 form__inputs">
             <label for="email">USERNAME<span>*</span></label>
             <input type="name" name="user" placeholder="username" required />
             <br/>

             <label for="password">PASSWORD <span>*</span></label>
             <input type="password" name="password" placeholder="Password" required id="pass"/>
             <label class="form__show-password">SHOW PASSWORD<input type="checkbox" onclick="showPass()" hidden/></label>
           </div>

           <div class="col-lg-2 form__seperator">
             <div class="vr"></div>
           </div>

           <div class="col-lg-5 form__buttons">
             <button type="submit" name="hostSubmit">
               <i class="fa-solid fa-chalkboard-user"></i>LOG IN
             </button>
           </div>
         </div>
       </form>
       <div class="login__wrong-password">
         <p><?php if (isset($_GET["loginValid"]) && $_GET["loginValid"] == 'false') {
               echo "<p style='color:red;'>Wrong Username or Password</p>";
             } else {
               echo " ";
             } ?></p>
       </div>
     </div>
   </div>
   <script src="https://kit.fontawesome.com/2865d561f1.js" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="../js/loader.js"></script>
   <script src="../js/index.js"></script>
 </body>

 </html>
