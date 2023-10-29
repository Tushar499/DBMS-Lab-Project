<?php
    session_start();
    if(!isset($_SESSION['fuser'])){
      session_destroy();
      header('Location: f_login.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="s_recruitmentapply.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div>
       <div style="float:left;padding-left:36px">
        <img src="<?php echo "upload/".$_SESSION["fimage"] ?>" width="40px" alt="image">
      </div>
      <div style="float:right;padding-right:36px">
        <a href="f_profile.php"><?php echo $_SESSION["fname"]; ?></a>
      </div>
    </div>
  <div style="padding-top: 100px;padding-bottom: 20px;">
    <hr>
    <a href="f_home.php">Home</a>
    <a href="f_recommendation.php">Recommendation</a>
    <a href="f_thesis.php">Thesis Supervisor</a>
    <a href="f_postjob.php">Post Job</a>
  </div>

    <a href="logout.php">Logout</a>
</div>

  <!-- Use any element to open the sidenav -->
  <div class="searchbarWrapper">
    <span onclick="openNav()"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png" width="40px" style="padding-top: 0px; padding-left: 40px;"></span>
  </div>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->

  <?php
      require_once "database.php";
      if(isset($_POST['edit'])){
        $_SESSION['f_postid'] = $_POST['id'];
      }
      $id = $_SESSION['f_postid'];
   ?>
  <div id="main">
    <section>
      <a style="float:right" href="f_postjob.php">
        <input class="searchbtn" type="submit" value="BACK">
      </a>
     <?php
         $query = "SELECT * FROM job WHERE id = '$id'";
         $query_run = mysqli_query($conn,$query);
         foreach ($query_run as $row) {
           if(isset($_POST['postedit'])){
             $title = $_POST['title'];
             if(empty($title)){
               $title = $row['title'];
             }
             $sitelink = $_POST['sitelink'];
             if(empty($sitelink)){
               $sitelink = $row['sitelink'];
             }
             $description = $_POST['description'];
             if(empty($description)){
               $description = $row['description'];
             }
             $picture = $_FILES['picture']['name'];
             if(empty($picture)){
               $picture = $row['picture'];
             }
             date_default_timezone_set("Asia/Dhaka");
             $t = date_default_timezone_get() . date("H:i");
             $len = strlen($t);
             $time = substr("$t",10,$len);
             $date = date('d-m-y');
             $sql = "UPDATE job SET title = '$title',sitelink = '$sitelink',description = '$description',picture = '$picture',date = '$date',time = '$time' WHERE id = '$id'";
             $sql_run = mysqli_query($conn,$sql);
             if($picture != ""){
               move_uploaded_file($_FILES["picture"]["tmp_name"], "upload/".$_FILES["picture"]["name"]);
             }
             echo '<script>alert("Post Updated.")</script>';
             echo "<script>window.location.href ='f_postjob.php'</script>";
           }
      ?>

    <h2 style="text-align:center">Update Posted Job</h2>
    <div style="padding-left:300px">
      <form action="f_postedit.php" class="sturecapply-form facultyapply-form" method="post" enctype="multipart/form-data">
        <label>Job Title</label>
        <input style="width:600px" class="sturecapply-form-list facultyapply-form-list" type="text"  value="<?php echo $row['title']; ?>" name = "title">
        <label>Link</label>
        <input style="width:600px" class="sturecapply-form-list facultyapply-form-list" type="text"  value="<?php echo $row['sitelink']; ?>" name="sitelink">
        <label>Description</label>
        <textarea style="height:110px;width:650px" name = "description"><?php echo $row['description']; ?> </textarea>
        <label style="padding-top:20px;padding-bottom:10px">Add Image</label>
        <input value="" type="file" name="picture" class="form-control">
        <input class="sturecapply-form-btn" type="submit" name="postedit" value="POST">
    </form>
    </div>
  <?php } ?>
</section>

  </div>



  <script src="main.js"></script>
</body>
</html>
