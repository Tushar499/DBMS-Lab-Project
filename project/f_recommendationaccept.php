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
       if(isset($_POST['accept'])){
         $id = $_POST['id'];
         $sid = $_POST['sid'];
         $fid = $_POST['fid'];
         $fname = $_POST['fname'];
         $sql = "UPDATE s_application SET recommendation = '$fname',rid = '$fid' WHERE id = '$sid'";
         $sql_run = mysqli_query($conn,$sql);
         $ok = "DELETE FROM recommendation WHERE id = '$id'";
         $ok_run = mysqli_query($conn,$ok);
         ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong>Recommendation Accepted</strong>
         </div>
         <?php
       }
       ?>
        <div class="p-2">
          <a href="f_recommendation.php">
            <label class="btn btn-secondary">Back</label>
          </a>
        </div>

 		</div>

 </body>
 </html>
