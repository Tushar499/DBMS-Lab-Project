<?php
    session_start();
    if(!isset($_SESSION['suser'])){
      session_destroy();
      header('Location: s_login.php');
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
</head>
<body>

		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
      <?php
      require_once "database.php";
      if(isset($_POST['choose'])){
        $id = $_POST['id'];
        $point = $_POST['point'];
        $name = $_SESSION['sname'];
        $studentid = $_SESSION['sstudentid'];
        $department = $_SESSION['sdepartment'];
        $c_credit = $_SESSION['sc_credit'];
        $cgpa = $_SESSION['scgpa'];
        $recommendation = "No Recommendation";
        $associated = "Pending";
        $coursename = "";$courseid = "";$type = "";$section = "";$time = "";$trimester = "";
        $sql = "SELECT * FROM f_request WHERE id = '$id'";
        $sql_run = mysqli_query($conn,$sql);
        foreach ($sql_run as $row) {
          $coursename = $row['coursename'];
          $courseid = $row['courseid'];
          $type = $row['type'];
          $section = $row['section'];
          $time = $row['time'];
          $trimester = $row['trimester'];
        }
        $temp = "";
        $ok = "SELECT * FROM s_application WHERE studentid = '$studentid' && grade = '$point'
        && coursename = '$coursename' && courseid = '$courseid' && time = '$time' && type = '$type' && trimester = '$trimester' && section = '$section'";
        $ok_run = mysqli_query($conn,$ok);
        foreach ($ok_run as $raw) {
           $temp = $raw['studentid'];
        }
        if($temp != ""){
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Applications Already Exists!</strong>
          </div>
          <?php
        }else{
           $query = "INSERT INTO s_application(name,studentid,cgpa,c_credit,grade,coursename,courseid,time,department,recommendation,type,trimester,associated,section)
           VALUES('$name','$studentid','$cgpa','$c_credit','$point','$coursename','$courseid','$time','$department','$recommendation','$type','$trimester','$associated','$section')";
           $query_run = mysqli_query($conn,$query);
           ?>
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>Applied Successfully</strong>
           </div>
           <?php
        }

      }
      ?>
       <div class="p-2">
         <a href="s_recruitment.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
