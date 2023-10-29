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
        <?php
        require_once "database.php";
        if(isset($_POST['srch'])){
          $_SESSION['s_psearch'] = $_POST['psearch'];
        }
        $psearch = $_SESSION['s_psearch'];
         ?>
    <section style="padding-left:300px;padding-right:300px">
      <a style="float:right" href="s_postproject.php">
        <input class="searchbtn" type="submit" name="" value="BACK">
      </a>
      <div class="container">
        <h2 style="text-align:center;" >Search result for ' <?php echo $psearch ?> '</h2>
        <?php

            $sql = "SELECT * FROM thesis WHERE p_date != '' && (title LIKE '%$psearch%' || studentid LIKE '%$psearch%') ORDER BY p_date DESC,p_time DESC";
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
          <h2>
          <img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$simage ?>" alt="Avatar">
          <?php
           echo $sname;echo "(";echo $studentid;echo ")"; ?></h2>
           <h3>Department Of <?php echo $sdepartment; ?></h3>
           <p>Posted On <?php echo $row['p_date']; echo " AT ";echo $row['p_time'];?></p>
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
          <form action="s_postproject.php" method="post">
            <div style="padding-right:400px;padding-top:10px;padding-bottom:5px">
              <input type="hidden" name="studentid" value="<?php echo $row['studentid']; ?>">
              <input class="searchbtn" type="submit" name="join" value="JOIN REQUEST">
            </div>
          </form>
        </div>
        <?php
            }
         ?>
      </div>
    </section>

    <?php
        if(isset($_POST['join'])){
          $mid = $_POST['studentid'];
          $myid = $_SESSION['sstudentid'];
          $sear = "SELECT * FROM thesis_group WHERE leaderid = '$mid'";
          $sear_run = mysqli_query($conn,$sear);
          $rcnt = mysqli_num_rows($sql_run);
          $se = "SELECT * FROM thesis_group WHERE memberid = '$myid'";
          $se_run = mysqli_query($conn,$se);
          $sercnt = mysqli_num_rows($se_run);
          $flag = 0;
          if($sercnt > 0){
            $flag = 1;
          }
          foreach ($sear_run as $rak) {
            if($myid == $rak['memberid']){
              $flag = 1;
            }
          }
          if($myid == $mid){
            $flag = 1;
          }
          if($rcnt >= 5){
            $flag = 1;
          }
          $sui = "SELECT * FROM thesis WHERE studentid = '$mid'";
          $sui_run = mysqli_query($conn,$sui);
          $see = mysqli_fetch_array($sui_run, MYSQLI_ASSOC);
          if($see['status'] != ""){
            $flag = 1;
          }
          if($flag == 0){
            $up = "INSERT INTO thesis_group(leaderid,memberid,request) VALUES ('$mid','$myid','others')";
            $up_run = mysqli_query($conn,$up);
            echo '<script>alert("Request Has Been Sent.")</script>';
            echo "<script>window.location.href ='s_postproject.php'</script>";
          }else{
            echo '<script>alert("Occupied ! ")</script>';
            echo "<script>window.location.href ='s_postproject.php'</script>";
          }
        }
     ?>
  </div>



  <script src="main.js"></script>
</body>
</html>
