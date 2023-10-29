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

    <?php

         require_once "database.php";
         if(isset($_POST['accept'])){
           $_SESSION['s'] = 2;
           $_SESSION['id'] = $_POST['id'];
         }
         if(isset($_POST['redo'])){
           $_SESSION['s'] = 1;
           $_SESSION['id'] = $_POST['id'];
         }
         if(isset($_POST['submit'])){
           $feedback = $_POST['comments'];
           date_default_timezone_set("Asia/Dhaka");
           $t = date_default_timezone_get() . date("H:i");
           $len = strlen($t);
           $tim = substr("$t",10,$len)."<br>";
           $date = date('d-m-y');
           $l_feedback = $date. ' AT ' . $tim;
           $s = $_SESSION['s'];
           $id = $_SESSION['id'];
           if($s == 1){
             $sql = "UPDATE task SET feedback = '$feedback',l_feedback = '$l_feedback' WHERE id = '$id'";
             $sql_run = mysqli_query($conn,$sql);
             echo '<script>alert("Feedback Updated Successfully")</script>';
             echo "<script>window.location.href ='f_taskprofile.php'</script>";
           }else if($s == 2){
             $sql = "UPDATE task SET feedback = '$feedback',l_feedback = '$l_feedback',status = 'Completed' WHERE id = '$id'";
             $sql_run = mysqli_query($conn,$sql);
             echo '<script>alert("Feedback Updated Successfully")</script>';
             echo "<script>window.location.href ='f_taskprofile.php'</script>";
           }
         }
     ?>

		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
      <h3 style="text-align:center">Feddback About Last Submission</h3>
      <section style="padding-top:100px">
        <form class="" action="f_feedback.php" method="post">
          <label  class="form-label">Add Feedback</label>
          <div style="padding-top:20px">
            <textarea style="width:500px" name="comments" placeholder="Start Writting..." rows="8"></textarea>
          </div>
          <input type="submit" name="submit" class="btn btn-danger" value="SUBMIT">
        </form>
      </section>
      <?php
      require_once "database.php";
      ?>

       <div class="p-2">
         <a href="f_taskprofile.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
