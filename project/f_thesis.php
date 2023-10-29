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
    <a style="float:right" href="f_home.php">
      <input class="searchbtn" type="submit" value="BACK">
    </a>
    <section style="padding-left:400px;padding-right:300px">
      <div class="container">
        <h2 style="text-align:center" >Thesis Supervising Request</h2>
        <?php
            require_once "database.php";
            $email = $_SESSION['femail'];
            $sql = "SELECT * FROM thesis WHERE req = '$email' && status = ''";
            $sql_run = mysqli_query($conn,$sql);
            foreach ($sql_run as $row) {
              $studentid = $row['studentid'];
              $query = "SELECT * FROM s_users WHERE studentid = '$studentid'";
              $query_run = mysqli_query($conn,$query);
              $user = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
              $simage = $user['image'];
              $sname = $user['name'];
              $sdepartment = $user['department'];
         ?>
        <hr>
        <div>
           <h3>Department Of <?php echo $sdepartment; ?></h3>
          <ul>

            <li class="studentlistitem">Project Title</li>
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
              <span><?php echo $row['title']; ?></span>
            </div>
            <li class="studentlistitem">Deliverable </li>
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
              <span><?php echo $row['details']; ?></span>
            </div>

            <li class="studentlistitem">Group Members</li>
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
            <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$simage; ?>"> <?php echo $sname;echo "(";echo $user['studentid'];echo ")";echo " - Team Leader"; ?>
            </div>
                <?php
                 $sqlmem = "SELECT * FROM thesis_group WHERE leaderid = '$studentid' && request = 'me'";
                 $sqlmem_run = mysqli_query($conn,$sqlmem);
                 foreach ($sqlmem_run as $raw) {
                   $studentidm = $raw['memberid'];
                   $query = "SELECT * FROM s_users WHERE studentid = '$studentidm'";
                   $query_run = mysqli_query($conn,$query);
                   $user = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
                   ?>
                   <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
                   <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$user['image']; ?>"> <?php echo $user['name'];echo "(";echo $user['studentid'];echo ")"; ?>
                   </div>
                   <?php
                 }
                ?>
          </ul>
        </div>
        <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
          <form action="f_thesis.php" method="post">
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
              <input type="hidden" name="studentid" value="<?php echo $row['studentid']; ?>">
              <input class="searchbtn" type="submit" name="accept" value="ACCEPT">
              <input class="searchbtn" type="submit" name="delete" value="DELETE">
            </div>
          </form>
        </div>
        <?php
            }
         ?>
      </div>
      <?php
        if(isset($_POST['accept'])){
          $leaderid = $_POST['studentid'];
          $sts = "UPDATE thesis SET status = 'done'";
          $sts_run = mysqli_query($conn,$sts);
          echo '<script>alert("Team Request Accepted !")</script>';
          echo "<script>window.location.href ='f_thesis.php'</script>";
        }
        if(isset($_POST['delete'])){
          $leaderid = $_POST['studentid'];
          $sts = "UPDATE thesis SET req = ''";
          $sts_run = mysqli_query($conn,$sts);
          echo '<script>alert("Team Request Rejected !")</script>';
          echo "<script>window.location.href ='f_thesis.php'</script>";
        }
       ?>
    </section>

  <section style="padding-top:150px">

    <section style="padding-left:400px;padding-right:300px">
      <div class="container">
        <h2 style="text-align:center" >Ongoing Thesis</h2>
        <?php
            require_once "database.php";
            $email = $_SESSION['femail'];
            $sql = "SELECT * FROM thesis WHERE req = '$email' && status != ''";
            $sql_run = mysqli_query($conn,$sql);
            foreach ($sql_run as $row) {
              $studentid = $row['studentid'];
              $query = "SELECT * FROM s_users WHERE studentid = '$studentid'";
              $query_run = mysqli_query($conn,$query);
              $user = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
              $simage = $user['image'];
              $sname = $user['name'];
              $sdepartment = $user['department'];
         ?>
        <hr>
        <div>
           <h3>Department Of <?php echo $sdepartment; ?></h3>
          <ul>

            <li class="studentlistitem">Project Title</li>
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
              <span><?php echo $row['title']; ?></span>
            </div>
            <li class="studentlistitem">Deliverable </li>
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
              <span><?php echo $row['details']; ?></span>
            </div>

            <li class="studentlistitem">Group Members</li>
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
            <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$simage; ?>"> <?php echo $sname;echo "(";echo $user['studentid'];echo ")";echo " - Team Leader"; ?>
            </div>
                <?php
                 $sqlmem = "SELECT * FROM thesis_group WHERE leaderid = '$studentid' && request = 'me'";
                 $sqlmem_run = mysqli_query($conn,$sqlmem);
                 foreach ($sqlmem_run as $raw) {
                   $studentidm = $raw['memberid'];
                   $query = "SELECT * FROM s_users WHERE studentid = '$studentidm'";
                   $query_run = mysqli_query($conn,$query);
                   $user = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
                   ?>
                   <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
                   <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$user['image']; ?>"> <?php echo $user['name'];echo "(";echo $user['studentid'];echo ")"; ?>
                   </div>
                   <?php
                 }
                ?>
          </ul>
        </div>
        <div style="padding-right:400px;padding-top:5px;padding-bottom:5px">
          <h3>Currently Supervising</h3>
        </div>
        <?php
            }
         ?>
      </div>
    </section>
</div>



  <script src="main.js"></script>
</body>
</html>
