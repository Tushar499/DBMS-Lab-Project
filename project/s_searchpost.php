<?php
    session_start();
    if(!isset($_SESSION['suser'])){
      session_destroy();
      header('Location: s_login.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
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
        <img src="<?php echo "upload/".$_SESSION["simage"] ?>" width="40px" alt="image">
      </div>
      <div style="float:right;padding-right:36px">
        <a href="s_profile.php"><?php echo $_SESSION["sname"]; ?></a>
      </div>
    </div>
  <div style="padding-top: 100px;padding-bottom: 20px;">
    <hr>
    <a href="s_home.php">Home</a>
    <a href="s_recruitment.php">Recruitments</a>
    <a href="s_uagrader.php">UA/Grader</a>
    <a href="s_postproject.php">Thesis</a>
  </div>

    <a href="logout.php">Logout</a>
</div>

  <!-- Use any element to open the sidenav -->
  <div class="searchbarWrapper">
    <span onclick="openNav()"><img src="https://cdn4.iconfinder.com/data/icons/wirecons-free-vector-icons/32/menu-alt-512.png" width="40px" style="padding-top: 0px; padding-left: 40px;"></span>
  </div>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
    <section style="padding-left:400px;padding-right:400px">
      <div class="container">
        <?php
            require_once "database.php";
            if(isset($_POST['search'])){
               $_SESSION['jobsearch'] = $_POST['searchbox'];
            }
         ?>
        <div class="" style="display:flex">
          <h3 class="studentHeading" style="text-align:center" >Search result for ' <?php echo $_SESSION['jobsearch']; ?> '</h3>
          <a style="padding-top:50px;padding-left:700px" href="s_home.php">
            <label class="searchbtn">Back</label>
          </a>
        </div>
        <?php
            $search = $_SESSION['jobsearch'];
            $query = "SELECT * FROM job WHERE title LIKE '%$search%' || name LIKE '%$search%'";
            $query_run = mysqli_query($conn,$query);
            foreach ($query_run as $row) {
         ?>
        <hr>
        <div>
          <h2><?php
             if($row['name'] == "UIU"){
               ?>
               <img style="vertical-align:middle" src="upload/uiu.jpg" width="40px" alt="image">
               <?php
             }else {
               ?>
               <img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$row['image'] ?>" alt="Avatar">
               <?php
             }
          echo $row['name']; ?></h2><p><?php echo $row['date']; echo " AT ";echo $row['time'];?></p>
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
    </section>

  </div>



  <script src="main.js"></script>
</body>
</html>
