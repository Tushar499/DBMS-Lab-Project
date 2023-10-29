<?php
     session_start();
     if(!isset($_SESSION['admin'])){
       session_destroy();
       header('Location: a_login.php');
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
        $sql = "SELECT * FROM a_recruitment WHERE id = '$id'";
        $sql_run = mysqli_query($conn,$sql);
        $department = "";
        $title = "";
        $excel = "";
        $trimester = "";
        foreach ($sql_run as $row) {
          $department = $row['department'];
          $title = $row['title'];
          $excel = $row['excel'];
          $trimester = $row['trimester'];
        }
        $ch = "SELECT * FROM f_request WHERE fromxl = '$excel' && type = '$title' && department = '$department'";
        $ch_run = mysqli_query($conn,$ch);
        foreach ($ch_run as $row) {
          $id = $row['aid'];
          if($id > 0){
            $oks = "DELETE FROM s_application WHERE id = '$id'";
            $oks_run = mysqli_query($conn,$oks);
          }
        }
        $query = "DELETE FROM f_request WHERE fromxl = '$excel' && type = '$title' && department = '$department'";
        $query_run = mysqli_query($conn,$query);
        $ok = "DELETE FROM a_recruitment WHERE id = '$id'";
        $ok_run = mysqli_query($conn,$ok);
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Recruitment Deleted Successfully</strong>
        </div>
        <?php
      }
       ?>
        <div class="p-2">
          <a href="a_recruitment.php">
            <label class="btn btn-secondary">Back</label>
          </a>
        </div>

 		</div>

 </body>
 </html>
