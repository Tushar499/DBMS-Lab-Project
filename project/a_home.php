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
    <link rel="stylesheet" href="a_home.css">
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

  <!-- Use any element to open the sidenav -->
<section class="sec1">
  <?php
       require_once "database.php";
       $query = "SELECT * FROM s_application";
       $query_run = mysqli_query($conn,$query);
       $_SESSION['as_application'] = mysqli_num_rows($query_run);
       $query = "SELECT * FROM s_application WHERE associated != 'Pending' && type = 'Undergraduate Assistant'";
       $query_run = mysqli_query($conn,$query);
       $_SESSION['as_ua'] = mysqli_num_rows($query_run);
       $query = "SELECT * FROM s_application WHERE associated != 'Pending' && type = 'Grader'";
       $query_run = mysqli_query($conn,$query);
       $_SESSION['as_grader'] = mysqli_num_rows($query_run);
       if(isset($_POST['show'])){
         $department = $_POST['department'];
         $sql = "SELECT * FROM s_application WHERE department = '$department'";
         if($result = mysqli_query($conn,$sql)){
           $_SESSION['as_application'] = mysqli_num_rows($result);
         }
         $sql = "SELECT * FROM s_application WHERE department = '$department' && type = 'Undergraduate Assistant'";
         if($result = mysqli_query($conn,$sql)){
           $_SESSION['as_ua'] = mysqli_num_rows($result);
         }
         $sql = "SELECT * FROM s_application WHERE department = '$department' && type = 'Grader'";
         if($result = mysqli_query($conn,$sql)){
           $_SESSION['as_grader'] = mysqli_num_rows($result);
         }
       }
   ?>
  <div class="count">
    <div>
      <h5 id="application-count"><?php echo $_SESSION['as_application'];?></h5>
      <p>Student Applications</p>
    </div>
    <div>
      <h5 id="ta-count"><?php echo $_SESSION['as_ua']; ?></h5>
      <p>Undergraduate Assistant</p>
    </div>
    <div>
      <h5 id="grader-count"><?php echo $_SESSION['as_grader']; ?></h5>
      <p>Grader</p>
    </div>

  </div>
  <div class="showdept">
    <div>
    <form class="show" action="a_home.php" method="post">
      <select style="width:160px;" name="department" class="form-select form-select mb-3" aria-label=".form-select-lg example">
        <option value="">Select Department</option>
        <option value="Computer Science And Engineering">CSE</option>
        <option value="Electrical And Electronics Engineering">EEE</option>
        <option value="Civil Engineering">CE</option>
      </select>
        <input class="Submit" type="Submit" value="Show" name="show">
    </form>
    </div>
  </div>

</section>

<section class="sec2">

  <h2 style="text-align:center">Add Recruitments</h2>

  <div style="padding-left:200px"class="container">
    <form action="a_recruitmentcode.php" method="post" enctype="multipart/form-data">
    <div class="row">

      <div class="col-75">
        <div>
          <select style="width:150px" name="title" class="form-select form-select mb-3" aria-label=".form-select-lg example">
            <option value="">Select Title</option>
            <option value="Undergraduate Assistant">UA</option>
            <option value="Grader">Grader</option>
          </select>

        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-75">
        <input style="width:200px" type="text" name="c_credit" placeholder="required completed credit">
        <input style="width:200px" type="text" name="cgpa" placeholder="required cgpa">
        <input style="width:200px" type="text" name="grade" placeholder="required point of applied courses">
      </div>
    </div>
    <div>
      <select style="width:150px" name="trimester" class="form-select form-select mb-3" aria-label=".form-select-lg example">
        <option value="">Select Trimester</option>
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
      </select>

    </div>
    <div>
      <select style="width:150px" name="department" class="form-select form-select mb-3" aria-label=".form-select-lg example">
        <option value="">Select Department</option>
        <option value="Computer Science And Engineering">CSE</option>
        <option value="Electrical And Electronics Engineering">EEE</option>
        <option value="Civil Engineering">CE</option>
      </select>

    </div>
    <div class="row">

      <div class="col-75">
        <input type="date" name="deadline" placeholder="deadline">
      </div>
    </div>
    <div class="row">
      <div class="col-75">
        <input name="description" placeholder="Write description.." style="height:50px;width:840px">
      </div>
    </div>
    <div class="row">
      <label for="formFile" class="form-label">Click to add excel file</label>
      <input value="" type="file" name="excel" class="form-control">

    </div>
      <br>
    <div style="padding-right:700px"class="row">
        <input class="Submit" type="Submit" name="submit">
    </div>
    </form>
  </div>

</section>

<script src="main.js"></script>
</body>
</html>
