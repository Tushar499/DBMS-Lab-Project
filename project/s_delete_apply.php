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
       if(isset($_POST['delete'])){
          $id = $_POST['id'];
          $query = "SELECT * FROM s_application WHERE id = '$id'";
          $query_run = mysqli_query($conn,$query);
          $fetch = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
          $aid = $fetch['aid'];
          $find = "UPDATE f_request SET aid = 0,assistant = 'Pending' WHERE id = '$aid'";
          $find_run = mysqli_query($conn,$find);
          $sql = "DELETE FROM s_application WHERE id = '$id'";
          $sql_run = mysqli_query($conn,$sql);
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Application Deleted Successfully</strong>
          </div>
          <?php
       }
       ?>
        <div class="p-2">
          <a href="s_uagrader.php">
            <label class="btn btn-secondary">Back</label>
          </a>
        </div>

 		</div>

 </body>
 </html>
