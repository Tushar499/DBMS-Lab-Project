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
    <link rel="stylesheet" href="s_recruitment.css">
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
    <div class="container">
      <div style="text-align: center;">
        <label class="studentHeading" style="text-align:center; color: #2974e5d7;" >Recent Recruitments</label>
        <a style="float:right" href="s_home.php">
          <input class="apply-btn" type="submit" value="BACK">
        </a>
    </div>

      <hr>
     <section style="padding-left: 500px;padding-right: 500px">
       <?php
            require_once "database.php";
            $department = $_SESSION['sdepartment'];
            $sql = "SELECT * FROM a_recruitment WHERE department = '$department'";
            $result = mysqli_query($conn,$sql);
            foreach ($result as $row) {
              ?>
              <div style="padding:10px">
                <h3 style="padding-left:200px">Department Of <?php echo $row['department']; ?></h3>
                <div >
                  <h4>Title</h4>
                  <span><?php echo $row['title']; ?></span>
                  <h4>Description</h4>
                  <span><?php echo $row['description']; ?></span>
                  <h4>Deadline</h4>
                  <span><?php echo $row['deadline']; ?></span>
                </div>
                <h3 style="padding-left:310px">Requirements</h3>
                <div style="display:flex;">
                  <h4>CGPA :  <?php echo $row['cgpa'];echo " | ";?>Completed Credit : <?php echo $row['c_credit'];echo " | ";?>Applied Course Grade : <?php echo $row['grade']; ?></h4>
                </div>
                <div style="display:flex">
                  <form action="s_recruitmentapply.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <input class="apply-btn" type="submit" name="view" class="btn btn-success" value="Apply">
                  </form>
                  <form style="padding-left:10px" action="s_viewlist.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <input class="apply-btn" type="submit" name="view" class="btn btn-success" value="View List">
                  </form>
                </div>
              </div>
              <hr>
              <?php
            }
        ?>

     </section>
    </div>

  </div>



  <script src="main.js"></script>
</body>
</html>
