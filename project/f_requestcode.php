<?php
     session_start();
     if(!isset($_SESSION['fuser'])){
       session_destroy();
       header('Location: f_login.php');
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
       if(isset($_POST['apply'])){
         $name = $_SESSION['fname'];
         $email = $_SESSION['femail'];
         $type = $_POST['type'];
         $coursename = $_POST['coursename'];
         $courseid = $_POST['courseid'];
         $department = $_POST['department'];
         $section = $_POST['section'];
         $trimester = $_POST['trimester'];
         $time = $_POST['time'];
         $assistant = "Pending";

         if(empty($type) || empty($coursename) || empty($courseid) || empty($department) || empty($section) || empty($time) || empty($trimester)){
           ?>
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>All Fields are required</strong>
           </div>
           <?php
         }else{
           $query = "SELECT * FROM f_request WHERE type = '$type' && courseid = '$courseid' && department = '$department' && section = '$section' && time = '$time' && trimester = '$trimester'";
           $query_run = mysqli_query($conn,$query);
           $temp = mysqli_num_rows($query_run);
           if($temp > 0){
             ?>
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong>Already Applied!</strong>
             </div>
             <?php
           }else{
             $sql = "INSERT INTO f_request(name,email,coursename,courseid,department,section,type,time,assistant,trimester) VALUES('$name','$email','$coursename','$courseid','$department','$section','$type','$time','$assistant','$trimester')";
             $result = mysqli_query($conn,$sql);
             ?>
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong>Successfully Applied!</strong>
             </div>
             <?php
           }
         }
       }
       ?>
        <div class="p-2">
          <a href="f_home.php">
            <label class="btn btn-secondary">Back</label>
          </a>
        </div>

 		</div>

 </body>
 </html>
