<?php
    session_start();
    if(!isset($_SESSION['fuser'])){
      session_destroy();
      header('Location: f_login.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="f_recommendation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div>
       <div style="float:left;padding-left:36px">
        <img src="<?php echo "upload/".$_SESSION["fimage"] ?>" width="40px" alt="image">
      </div>
      <div style="float:right;padding-right:36px">
        <a href="f_profile.php"><?php echo $_SESSION["fname"]; ?></a>
      </div>
    </div>
  <div style="padding-top: 100px;padding-bottom: 20px;">
    <hr>
    <a href="f_home.php">Home</a>
    <a href="f_recommendation.php">Recommendation</a>
    <a href="f_thesis.php">Thesis Supervisor</a>
    <a href="f_postjob.php">Post Job</a>
  </div>

    <a href="logout.php">Logout</a>
</div>

  <!-- Use any element to open the sidenav -->
  <div class="searchbarWrapper">
    <span onclick="openNav()"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png" width="40px" style="padding-top: 0px; padding-left: 40px;"></span>
  </div>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
    <a style = "float:right" href="f_home.php">
      <input class="searchbtn" type="submit" value="HOME">
    </a>
    <table>
  <h3 style="text-align:center">Lists Of Recent Asked Recommendations From Student</h3>
    <tr>
      <th>Image</th>
      <th>Student Name</th>
      <th>Student ID</th>
      <th>Student Profile</th>
      <th>Course Name</th>
      <th>Course ID</th>
      <th>Messege</th>
      <th>Accept</th>
      <th>Reject</th>
    </tr>
    <?php

    require_once "database.php";
    $email = $_SESSION['femail'];
    $name = $_SESSION['fname'];
    $query = "SELECT * FROM recommendation WHERE email = '$email' && status = 'Asked'";
    $query_run = mysqli_query($conn,$query);
    foreach ($query_run as $raw) {
      $sid = $raw['sid'];
      $sql = "SELECT * FROM s_application WHERE id = '$sid'";
      $sql_run = mysqli_query($conn,$sql);
      $fetch = mysqli_fetch_array($sql_run, MYSQLI_ASSOC);
      $ssid = $fetch['studentid'];
      $sims = "SELECT * FROM s_users WHERE studentid = '$ssid'";
      $sims_run = mysqli_query($conn,$sims);
      $simsft = mysqli_fetch_array($sims_run);
     ?>
    <tr>
      <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$simsft['image'] ?>"></td>
      <td><?php echo $simsft['name']; ?></td>
      <td><?php echo $simsft['studentid']; ?></td>
      <form action="f_sprofile.php" method="post">
        <input type="hidden" name="studentid" value="<?php echo $simsft['studentid']; ?>">
        <th> <input class="searchbtn" type="submit" name="view" class="btn btn-danger" value="View Profile"></th>
      </form>
      <td><?php echo $fetch['coursename']; ?></td>
      <td><?php echo $fetch['courseid']; ?></td>
      <td><?php echo $simsft['name']; ?> Asked For Your Recommendation to be a <?php echo $fetch['type']; ?></td>
      <form action="f_recommendationaccept.php" method="post">
        <input type="hidden" name="fname" value="<?php echo $name; ?>">
        <input type="hidden" name="sid" value="<?php echo $raw['sid']; ?>">
        <input type="hidden" name="fid" value="<?php echo $raw['fid']; ?>">
        <input type="hidden" name="id" value="<?php echo $raw['id']; ?>">
        <th> <input class="searchbtn" type="submit" name="accept" class="btn btn-danger" value="Accept"></th>
      </form>
      <form action="f_recommendationignore.php" method="post">
        <input type="hidden" name="id" value="<?php echo $raw['id']; ?>">
        <th> <input class="searchbtn" type="submit" name="ignore" class="btn btn-danger" value="Ignore"></th>
      </form>
    </tr>
  <?php
      }
  ?>
</table>
  </div>



  <script src="main.js"></script>
</body>
</html>
