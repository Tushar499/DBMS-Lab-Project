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
    <link rel="stylesheet" href="s_viewlist.css">
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
    <div style="display: flex; width: 100%">
    </div>
  </div>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
    <?php
        require_once "database.php";
        $id = $_POST['id'];
        $sql = "SELECT * FROM a_recruitment WHERE id = $id";
        $sql_run = mysqli_query($conn,$sql);
        $type = "";
        $department = "";
        $trimester = "";
        foreach ($sql_run as $raw) {
           $type = $raw['title'];
           $department = $raw['department'];
           $trimester = $raw['trimester'];
        }

     ?>
     <a style="float:right" href="s_recruitment.php">
       <input class="studentapplybtn" type="submit" value="BACK">
     </a>
    <h2 style="text-align:center;padding-bottom:30px">List Of Available Courses With Time And Section For Recruiting <?php echo $type ?> </h2>

    <table style="padding:30px">
        <tr>
          <th>Course name</th>
          <th>Course ID</th>
          <th>Department</th>
          <th>Class time</th>
          <th>Section</th>
          <th>Trimester</th>
        </tr>
        <?php
            $query = "SELECT * FROM f_request WHERE type = '$type' && department = '$department' && trimester = '$trimester'";
            $result = mysqli_query($conn,$query);
            foreach ($result as $row) {
         ?>
        <tr>
          <td><?php echo $row['coursename']; ?></td>
          <td><?php echo $row['courseid']; ?></td>
          <td><?php echo $row['department']; ?></td>
          <td><?php echo $row['time']; ?></td>
          <td><?php echo $row['section']; ?></td>
          <td><?php echo $trimester; ?></td>
        </tr>
      <?php } ?>

    </table>
  </div>



  <script src="main.js"></script>
</body>
</html>
