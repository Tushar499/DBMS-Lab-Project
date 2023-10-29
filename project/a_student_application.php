<?php
    session_start();
    if(!isset($_SESSION['admin'])){
      session_destroy();
      header('Location: a_login.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="a_student_application.css">
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
        <img src="upload/uiu.jpg" width="40px" alt="image">
      </div>
      <div style="padding-right:20px">
        <a>UIU</a>
      </div>
    </div>
  <div style="padding-top: 20px;padding-bottom: 20px;">
    <a href="a_home.php">Home</a>
    <a href="a_recruitment.php">Manage Recruitments</a>
    <a href="a_faculty_application.php">Faculty Applications</a>
    <a href="a_student_application.php">Student Applications</a>
    <a href="a_supervisor.php">Thesis Info.</a>
    <a href="a_postjob.php">Post Job</a>

  </div>
    <a href="logout.php">Logout</a>
</div>

<!-- Use any element to open the sidenav -->
<div class="searchbarWrapper">
  <span onclick="openNav()"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png" width="40px" style="padding-top: 0px; padding-left: 40px;"></span>

</div>

<div id="main">
  <a style="float:right" href="a_home.php">
    <input type="submit" class="searchbtn" value="BACK">
  </a>

  <section style="padding-left:700px;padding-top:40px">
    <form class="show" action="a_student_application.php" method="post">
      <select style="width:160px;height:30px" name="department" class="form-select form-select mb-3" aria-label=".form-select-lg example">
        <option value="">Select Department</option>
        <option value="Computer Science And Engineering">CSE</option>
        <option value="Electrical And Electronics Engineering">EEE</option>
        <option value="Civil Engineering">CE</option>
      </select>
        <select style="width:160px;height:30px" name="title" class="form-select form-select mb-3" aria-label=".form-select-lg example">
          <option value="">Select Title</option>
          <option value="Undergraduate Assistant">UA</option>
          <option value="Grader">Grader</option>
        </select>
        <input class="a_btn1" type="submit" value="Select" name="select">
    </form>
  </section>
<section style="padding:30px">
  <?php

      require_once "database.php";
      if(isset($_POST['select'])){
        $_SESSION['a_application_department'] = $_POST['department'];
        $_SESSION['a_application_title'] = $_POST['title'];
      }
   ?>
  <h2 style="text-align:center">List Of Students Applications</h2>

    <div>
        <table>
            <tr>
              <th>Student image</th>
              <th>Student Name</th>
              <th>Student ID</th>
              <th>Course Name</th>
              <th>Course ID</th>
              <th>Department</th>
              <th>CGPA</th>
              <th>Completed Credtid</th>
              <th>Applied Course Grade</th>
              <th>Trimester</th>
              <th>Section</th>
              <th>Class Times</th>
              <th>Assistant Type</th>
              <th>Recommended by</th>
              <th>Associated With</th>
            </tr>
            <?php
                 $department = $_SESSION['a_application_department'];
                 $title = $_SESSION['a_application_title'];
                 $query = "";
                 if($department == "" && $title == ""){
                   $query = "SELECT * FROM s_application";
                 }else if($department == "" && $title != ""){
                   $query = "SELECT * FROM s_application WHERE type = '$title'";
                 }else if($title == "" && $department != ""){
                   $query = "SELECT * FROM s_application WHERE department = '$department'";
                 }else if($title != "" && $department != ""){
                   $query = "SELECT * FROM s_application WHERE department = '$department' && type = '$title'";
                 }
                 $query_run = mysqli_query($conn,$query);
                 foreach ($query_run as $row) {
                   $aid = $row['aid'];
                   $rid = $row['rid'];
                   $studentid = $row['studentid'];
                   $aimage = "";
                   $rimage = "";
                   if($aid != 0){
                     $sqla = "SELECT email FROM f_request WHERE id = '$aid'";
                     $sqla_run = mysqli_query($conn,$sqla);
                     $finda = mysqli_fetch_array($sqla_run, MYSQLI_ASSOC);
                     $aemail = $finda['email'];
                     $sqlap = "SELECT image FROM f_users WHERE email = '$aemail'";
                     $sqlap_run = mysqli_query($conn,$sqlap);
                     $findap = mysqli_fetch_array($sqlap_run, MYSQLI_ASSOC);
                     $aimage = $findap['image'];
                   }

                   if($rid != 0){
                     $sqlr = "SELECT email FROM f_request WHERE id = '$rid'";
                     $sqlr_run = mysqli_query($conn,$sqlr);
                     $findr = mysqli_fetch_array($sqlr_run, MYSQLI_ASSOC);
                     $remail = $findr['email'];
                     $sqlrp = "SELECT image FROM f_users WHERE email = '$remail'";
                     $sqlrp_run = mysqli_query($conn,$sqlrp);
                     $findrp = mysqli_fetch_array($sqlrp_run, MYSQLI_ASSOC);
                     $rimage = $findrp['image'];
                   }

                   $pr = "SELECT image FROM s_users WHERE studentid = '$studentid'";
                   $pr_run = mysqli_query($conn,$pr);
                   $findpr = mysqli_fetch_array($pr_run, MYSQLI_ASSOC);
                   $simage = $findpr['image'];
             ?>
            <tr>
              <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$simage ?>" alt="Avatar"></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['studentid']; ?></td>
              <td><?php echo $row['coursename']; ?></td>
              <td><?php echo $row['courseid']; ?></td>
              <td><?php echo $row['department']; ?></td>
              <td><?php echo $row['cgpa']; ?></td>
              <td><?php echo $row['c_credit']; ?></td>
              <td><?php echo $row['grade'] ?></td>
              <td><?php echo $row['trimester']; ?></td>
              <td><?php echo $row['section']; ?></td>
              <td><?php echo $row['time']; ?></td>
              <td><?php echo $row['type']; ?></td>
              <th><?php
                 if($rimage != ""){
                   ?>
                   <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$rimage ?>" alt="Avatar">
                   <?php
                 }
              ?>
              <?php echo $row['recommendation']; ?></th>
              <th> <?php
                  if($aimage != ""){
                    ?>
                    <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$aimage ?>" alt="Avatar">
                    <?php
                  }
               ?>
                <?php echo $row['associated']; ?></th>

            </tr>
          <?php } ?>
        </table>
    </div>
  </div>

</section>


  <script src="main.js"></script>
</body>
</html>
