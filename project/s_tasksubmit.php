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

  <?php
       if(isset($_POST['tasksubmit'])){
         $id = $_POST['id'];
         $_SESSION['stmp_id'] = $id;
       }
       require_once "database.php";
       if(isset($_POST['submit'])){
             date_default_timezone_set("Asia/Dhaka");
             $t = date_default_timezone_get() . date("H:i");
             $len = strlen($t);
             $tim = substr("$t",10,$len)."<br>";
             $date = date('d-m-y');
             $l_submission = $date. ' AT ' . $tim;
            $id = $_SESSION['stmp_id'];
            $sql = "SELECT * FROM task WHERE id = '$id'";
            $sql_run = mysqli_query($conn,$sql);
            $find = mysqli_fetch_array($sql_run, MYSQLI_ASSOC);
            $tmp_comments = $find['submissioncomment'];
            $tmp_file = $find['submittedassessment'];
            $comments = $_POST['comments'];
            $file = $_FILES['file']['name'];
            if($comments == ""){
              $comments = $tmp_file;
            }
            if($file == ""){
              $file = $tmp_file;
            }
            $query = "UPDATE task SET submissioncomment = '$comments', submittedassessment = '$file',l_submission = '$l_submission' WHERE id = '$id'";
            $query_run = mysqli_query($conn,$query);
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES["file"]["name"]);
            echo '<script>alert("Submitted Successfully")</script>';
            echo "<script>window.location.href ='s_taskprofile.php'</script>";
        }

   ?>

		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
      <h3 style="text-align:center">Submit Assessment To <?php echo $_SESSION['stmp_associated']; ?><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$_SESSION['stmp_image'] ?>" alt="Avatar"></h3>
      <h4 style="text-align:center"><?php echo "Course - "; echo $_SESSION['stmp_coursename']; echo " | Section - "; echo $_SESSION['stmp_section'];?></h4>
      <section style="padding-top:100px">
        <form class="" action="s_tasksubmit.php" method="post" enctype="multipart/form-data">
          <label  class="form-label">Add Assessment</label>
          <input style="width:500px" value="" type="file" name="file" class="form-control">
          <div style="padding-top:20px">
            <textarea style="width:500px" name="comments" placeholder="Comments..." rows="8"></textarea>
          </div>
          <input type="submit" name="submit" class="btn btn-danger" value="SUBMIT">
        </form>
      </section>
      <?php
      require_once "database.php";
      ?>

       <div class="p-2">
         <a href="s_taskprofile.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
