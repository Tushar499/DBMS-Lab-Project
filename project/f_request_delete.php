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
            if(isset($_POST['delete'])){
              $id = $_POST['id'];
              $aid = $_POST['aid'];
              $coin = "UPDATE s_application SET aid = 0,associated = 'Pending' WHERE id = '$aid'";
              $coin_run = mysqli_query($conn,$coin);
              $co = "SELECT * FROM s_application WHERE rid = '$id'";
              $co_run = mysqli_query($conn,$co);
              foreach ($co_run as $row) {
                $sid = $row['id'];
                $up = "UPDATE s_application SET rid = 0, recommendation = 'No Recommendation' WHERE id = '$sid'";
                $up_run = mysqli_query($conn,$up);
              }
              $query = "DELETE FROM f_request WHERE id = '$id'";
              $query_run = mysqli_query($conn,$query);
              $sql = "DELETE FROM task WHERE fid = '$id'";
              $sql_run = mysqli_query($conn,$sql);
              ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Application Deleted!</strong>
              </div>
              <?php
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
