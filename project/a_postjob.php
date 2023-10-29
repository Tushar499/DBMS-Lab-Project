<?php
    session_start();
    if(!isset($_SESSION['admin'])){
      session_destroy();
      header('Location: a_login.php');
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
        <img src="upload/uiu.jpg" width="40px" alt="image">
      </div>
      <div style="padding-right:20px">
        <a>UIU</a>
      </div>
    </div>
  <div style="padding-top: 20px;padding-bottom: 20px;">
    <a href="a_home.php">Home</a>
    <a href="a_recruitment.php">Manage Recruitments</a>
    <a href="a_faculty_application.php">Faculty Applications</a>
    <a href="a_student_application.php">Student Applications</a>
    <a href="a_supervisor.php">Thesis Info.</a>
    <a href="a_postjob.php">Post Job</a>

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
      if(isset($_POST['post'])){
        $name = "UIU";
        $title = $_POST['title'];
        $sitelink = $_POST['sitelink'];
        $description = $_POST['description'];
        $picture = $_FILES['picture']['name'];
        date_default_timezone_set("Asia/Dhaka");
        $t = date_default_timezone_get() . date("H:i");
        $len = strlen($t);
        $time = substr("$t",10,$len);
        $date = date('d-m-y');
        if($title == "" || $description == ""){
          echo '<script>alert("At Least job title and description are required !")</script>';
          echo "<script>window.location.href ='a_postjob.php'</script>";
        }else{
          $sql = "INSERT INTO job(name,title,description,sitelink,picture,time,date) VALUES('$name','$title','$description','$sitelink','$picture','$time','$date')";
          $sql_run = mysqli_query($conn,$sql);
          if($picture != ""){
            move_uploaded_file($_FILES["picture"]["tmp_name"], "upload/".$_FILES["picture"]["name"]);
          }
          echo '<script>alert("Job Posted Successfully.")</script>';
          echo "<script>window.location.href ='a_postjob.php'</script>";
        }
      }
   ?>
  <div id="main">
    <section>
      <a style="float:right" href="a_home.php">
        <input class="searchbtn" type="submit" value="BACK">
      </a>
    <h3 style="text-align:center">Post Job For Student</h3>
    <div style="padding-left:300px">
    <form action="a_postjob.php" class="sturecapply-form facultyapply-form" method="post" enctype="multipart/form-data">
      <input style="width:600px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Job Title" name = "title">
      <input style="width:600px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Site Link" name="sitelink">
      <label>Description</label>
      <textarea style="height:110px;width:650px" name = "description"> </textarea>
      <label style="padding-top:20px;padding-bottom:10px">Add Image</label>
      <input value="" type="file" name="picture" class="form-control">
      <input class="sturecapply-form-btn" type="submit" name="post" value="POST">
  </form>
</div>
</section>
<section style="padding-top:70px;padding-left:400px;padding-right:400px">
  <div class="container">
    <h2 style="text-align:center" >My Posted Jobs</h2>
    <?php
        $sql = "SELECT * FROM job WHERE name = 'UIU' ORDER BY date ASC,time DESC";
        $sql_run = mysqli_query($conn,$sql);
        foreach ($sql_run as $row) {
     ?>
    <hr>
    <div>
      <div style="float:right;display:flex">
        <form action="a_postedit.php" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <input class="searchbtn" type="submit" name="edit" value="edit">
        </form>
        <form style="padding-left:10px" action="a_postjob.php" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <input class="searchbtn" type="submit" name="delete" value="delete">
        </form>
      </div>
      <h2>
      <img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="upload/uiu.jpg">
      <?php echo $row['name']; ?></h2><p><?php echo $row['date']; echo " AT ";echo $row['time'];?></p>

      <h4>Job Title</h4>
      <span><?php echo $row['title']; ?></span>
      <h4>Description</h4>
      <span><?php echo $row['description']; ?></span>
      <h4>Link</h4>
      <span><a href="<?php echo $row['sitelink']; ?>"><?php echo $row['sitelink']; ?></a></span>
      <div>
      <?php
          if($row['picture']!=""){
            ?>
            <img style="height:400px;width:1045px;padding-top:20px" src="<?php echo "upload/".$row['picture'] ?>" alt="image">
            <?php
          }
       ?>
     </div>

    </div>
    <?php
        }
     ?>
  </div>

  <?php
      if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM job WHERE id = '$id'";
        $sql_run = mysqli_query($conn,$sql);
        echo '<script>alert("Post Deleted !")</script>';
        echo "<script>window.location.href ='a_postjob.php'</script>";
      }
   ?>

</section>
  </div>



  <script src="main.js"></script>
</body>
</html>
