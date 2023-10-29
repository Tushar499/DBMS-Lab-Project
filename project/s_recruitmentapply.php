<?php
    session_start();
    if(!isset($_SESSION['suser'])){
      session_destroy();
      header('Location: s_login.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="s_recruitmentapply.css">
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
        <img src="<?php echo "upload/".$_SESSION["simage"] ?>" width="40px" alt="image">
      </div>
      <div style="float:right;padding-right:36px">
        <a href="s_profile.php"><?php echo $_SESSION["sname"]; ?></a>
      </div>
    </div>
  <div style="padding-top: 100px;padding-bottom: 20px;">
    <hr>
    <a href="s_home.php">Home</a>
    <a href="s_recruitment.php">Recruitments</a>
    <a href="s_uagrader.php">UA/Grader</a>
    <a href="s_postproject.php">Thesis</a>
  </div>

    <a href="logout.php">Logout</a>
  </div>

  <!-- Use any element to open the sidenav -->
  <div class="searchbarWrapper">
    <span onclick="openNav()"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png" width="40px" style="padding-top: 0px; padding-left: 40px;"></span>
  </div>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
    <a style="float:right;padding-bottom:50px" href="s_recruitment.php">
      <input style="width:100px" class="sturecapply-form-btn" type="submit" value="BACK" >
    </a>
    <h2 style="text-align: center;">Fill up the following form For Finding Suitable Section</h2>

    <?php
        require_once "database.php";
        $id = $_POST['id'];
     ?>

    <form class="sturecapply-form" action="s_applymore.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div style="padding-left:450px">
        <input style="width:150px" class="sturecapply-form-list" type="text"  placeholder="Enter Course ID" name="courseid">
        <br>
        <input style="width:150px" class="sturecapply-form-list" type="text"  placeholder="Point Of Applied Course" name="grade">
        <br>
        <input style="width:160px" class="sturecapply-form-btn" type="submit"  value="Find" name="apply">

      </div>
    </form>


  </div>



  <script src="./main.js"></script>
</body>
</html>
