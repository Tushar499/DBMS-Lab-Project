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
         if(isset($_POST['create'])){
           $title = $_POST['title'];
           $details = $_POST['details'];
           if(empty($title) OR empty($details)){
             echo '<script>alert("All Fields are required !")</script>';
             echo "<script>window.location.href ='s_startproject.php'</script>";
           }else{
             $studentid = $_SESSION['sstudentid'];
             $sql = "INSERT INTO thesis(studentid,title,details) VALUES ('$studentid','$title','$details')";
             $sql_run = mysqli_query($conn,$sql);
             echo '<script>alert("Successfully Created.")</script>';
             echo "<script>window.location.href ='s_profile.php'</script>";
           }
         }
      ?>

      <h3 style="text-align:center">Start A Project</h3>
      <form class="form-control" action="s_startproject.php" method="post">
        <section style="padding-top:50px">
          <form class="" action="s_startproject.php" method="post">
            <div style="padding-left:300px">
              <label  class="form-label">Project Title</label>
              <input style="width:600px" value="" type="text" name="title" class="form-control">
              <div style="padding-top:20px">
                <label  class="form-label">Deliverable Details</label>
              </div>
              <div style="padding-top:20px">
                <textarea style="width:600px" name="details" rows="4"></textarea>
              </div>
            </div>
            <div style="padding-left:550px;padding-top:30px">
              <input type="submit" name="create" class="btn btn-primary" value="CREATE">
            </div>
          </form>
        </section>
      </form>
       <div class="p-2">
         <a href="s_profile.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
