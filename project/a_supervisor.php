<?php
    session_start();
    if(!isset($_SESSION['admin'])){
      session_destroy();
      header('Location:a_login.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="./a_recruitment.css">
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
  <div id="main">
    <h2 style="text-align:center">Thesis Informations</h2>
    <table>
      <thead>
      <tr>
        <th>SL</th>
        <th>Image</th>
        <th>Supervisor Name</th>
        <th>Final Year Design Project</th>
        <th>Deliverable</th>
      </tr>
    </thead>
    <?php
       require_once "database.php";
       $sql = "SELECT * FROM thesis WHERE status != ''";
       $result = mysqli_query($conn,$sql);
       $sl = 1;
       foreach ($result as $row) {
         $email = $row['req'];
         $query = "SELECT * FROM f_users WHERE email = '$email'";
         $query_run = mysqli_query($conn,$query);
         $use = mysqli_fetch_array($query_run);
      ?>
    <tbody>

      <tr>
        <td><?php echo $sl; ?></td>
        <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$use['image'] ?>" alt="Avatar"></td>
        <td><?php echo $use['name']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['details']; ?></td>
      </tr>
      <?php
      $sl++;
    }
       ?>
    </tbody>

    </table>
    <div style="padding-left:800px;padding-top:50px">
      <form action="a_pdf.php" method="post">
        <input class="searchbtn" type="submit" name="pdf" value="GENERATE PDF">
      </form>
    </div>

  </div>



  <script src="main.js"></script>
</body>
</html>
