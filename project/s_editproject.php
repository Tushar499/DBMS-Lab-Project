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
         $title = "";$details = "";
         $studentid = $_SESSION['sstudentid'];
         $query = "SELECT * FROM thesis WHERE studentid = '$studentid'";
         $query_run = mysqli_query($conn,$query);
         foreach ($query_run as $row) {
      ?>

      <h3 style="text-align:center">Start A Project</h3>
      <form class="form-control" action="s_editproject.php" method="post">
        <section style="padding-top:50px">
          <form class="" action="s_startproject.php" method="post">
            <div style="padding-left:300px">
              <label  class="form-label">Project Title</label>
              <input style="width:600px" value="<?php echo $row['title'];$title = $row['title']; ?>" type="text" name="title" class="form-control">
              <div style="padding-top:20px">
                <label  class="form-label">Deliverable Details</label>
              </div>
              <div style="padding-top:20px">
                <textarea style="width:600px" name="details" rows="4"><?php echo $row['details'];$title = $row['details']; ?></textarea>
              </div>
            </div>
            <div style="padding-left:550px;padding-top:30px">
              <input type="submit" name="update" class="btn btn-primary" value="UPDATE">
            </div>
          </form>
        </section>
        <?php
      }
             if(isset($_POST['update'])){
               $c_title = $_POST['title'];
               $c_details = $_POST['details'];
               if(empty($c_title)){
                 $c_title = $title;
               }
               if(empty($c_details)){
                 $c_details = $details;
               }
               $sql = "UPDATE thesis SET title = '$c_title',details = '$c_details'";
               $sql_run = mysqli_query($conn,$sql);
               echo '<script>alert("Project Updated Successfully.")</script>';
               echo "<script>window.location.href ='s_profile.php'</script>";
             }
         ?>
      </form>
       <div class="p-2">
         <a href="s_profile.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
