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
    <link rel="stylesheet" href="f_addtask.css">
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

     <?php
           $coursename = $_SESSION['ftmp_coursename'];
           $section = $_SESSION['ftmp_section'];
      ?>

  <div id="main">
    <a style="float:right" href="f_taskprofile.php">
      <input class = "searchbtn" type="submit" value="BACK">
    </a>
    <h3 style="padding-left:400px"><?php echo $coursename;echo " ( ";echo $section;echo " )"; ?></h3>
    <form action="f_addtask.php" class="sturecapply-form facultyapply-form" enctype="multipart/form-data" method="post">
        <input style="width:400px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Task Title" name="tasktitle">
        <input style="width:400px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Topics" name="topics">
        <textarea style="width:500px" name="instructions" placeholder="Instructions" rows="8"></textarea>

        <input style="width:250px" class="sturecapply-form-list facultyapply-form-list" type="date"  placeholder="Deadline" name="deadline">
        <label class="form-label">Add Assessment</label>
        <input style="padding-top:20px" value="" type="file" name="file" class="form-control">
        <input class="sturecapply-form-btn" type="submit"  value="ADD" name = "add">

    </form>
     <?php
          require_once "database.php";
          $sid = $_SESSION['sid'];
          $fid = $_SESSION['fid'];
          if(isset($_POST['add'])){
            $tasktitle = $_POST['tasktitle'];
            $topics = $_POST['topics'];
            $instructions = $_POST['instructions'];
            $deadline = $_POST['deadline'];
            $file = $_FILES['file']['name'];
            if($tasktitle == "" OR $topics == "" OR $instructions == ""){
              echo '<script>alert("At Least TASK TITLE , TOPICS AND INSTRUCTIONS are REQUIRED!!")</script>';
              echo "<script>window.location.href ='f_addtask.php'</script>";
            }else {
              $sql = "INSERT INTO task(tasktitle,topics,instructions,deadline,assessment,sid,fid) VALUES ('$tasktitle','$topics','$instructions','$deadline','$file','$sid','$fid')";
              $sql_run = mysqli_query($conn,$sql);
              move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES["file"]["name"]);
              echo '<script>alert("Task Given Successfully")</script>';
              echo "<script>window.location.href ='f_taskprofile.php'</script>";
            }
          }
      ?>
  </div>



  <script src="main.js"></script>
</body>
</html>
