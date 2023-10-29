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
          if(isset($_POST['choose'])){
            $id = $_POST['id'];
            $sid = $_POST['sid'];
            $fname = $_POST['fname'];
            $sname = $_POST['sname'];
            $sqlc = "SELECT aid FROM f_request WHERE id = '$id'";
            $sqlc_run = mysqli_query($conn,$sqlc);
            $findc = mysqli_fetch_array($sqlc_run, MYSQLI_ASSOC);
            $aid = $findc['aid'];
            if($aid > 0){
              $sqlup = "UPDATE s_application SET aid = 0, associated = 'Pending' WHERE id = '$aid'";
              $sqlup_run = mysqli_query($conn,$sqlup);
            }
            $sql = "UPDATE s_application SET aid = '$id',associated = '$fname' WHERE id = '$sid'";
            $sql_run = mysqli_query($conn,$sql);
            $query = "UPDATE f_request SET aid = '$sid',assistant = '$sname' WHERE id = '$id'";
            $query_run = mysqli_query($conn,$query);
            ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Successfully Associated</strong>
          </div>
          <?php
          }
       ?>

      </table>
       <div class="p-2">
         <a href="a_faculty_application.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
