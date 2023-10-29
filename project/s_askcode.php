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
             if(isset($_POST['ask'])){
               require_once "database.php";
               $id = $_POST['id'];
               $sid = $_POST['sid'];
               $use = "SELECT * FROM f_request WHERE id = '$id'";
               $use_run = mysqli_query($conn,$use);
               $fetch = mysqli_fetch_array($use_run, MYSQLI_ASSOC);
               $femail = $fetch['email'];
               $find = "SELECT * FROM recommendation WHERE sid = '$sid' && fid = '$id'";
               $find_run = mysqli_query($conn,$find);
               $rcnt = mysqli_num_rows($find_run);
               if($rcnt > 0){
                 ?>
                 <div class="alert alert-warning alert-dismissible fade show" role="alert">
                   <strong>Already Asked ! </strong>
                 </div>
                 <?php
               }else{
                 $query = "INSERT INTO recommendation(fid,sid,status,email) VALUES ('$id','$sid','Asked','$femail')";
                 $query_run = mysqli_query($conn,$query);
                 $ok = "UPDATE s_application SET recommendation = 'Asked' WHERE id = '$sid'";
                 $ok_run = mysqli_query($conn,$ok);
                 ?>
                 <div class="alert alert-warning alert-dismissible fade show" role="alert">
                   <strong>Successfully Asked Recommendation</strong>
                 </div>
                 <?php
               }
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
