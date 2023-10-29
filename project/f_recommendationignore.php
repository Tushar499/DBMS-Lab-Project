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
       if(isset($_POST['ignore'])){
         $id = $_POST['id'];

         $sql = "DELETE FROM recommendation WHERE id = '$id'";
         $sql_run = mysqli_query($conn,$sql);
         ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong>Deleted!</strong>
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
