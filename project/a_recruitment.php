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
    <h2 style="text-align:center">Manage Recruitment Lists</h2>
    <table>
      <thead>
      <tr>
        <th>Title</th>
        <th>Department</th>
        <th>Required cgpa</th>
        <th>Completed Credit</th>
        <th>Applied Course Grade</th>
        <th>Trimester</th>
        <th>Description</th>
        <th>Deadline</th>
        <th>DELETE</th>
      </tr>
    </thead>
    <?php
       require_once "database.php";
       $sql = "SELECT * FROM a_recruitment";
       $result = mysqli_query($conn,$sql);
       foreach ($result as $row) {
      ?>
    <tbody>

      <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['department']; ?></td>
        <td><?php echo $row['cgpa']; ?></td>
        <td><?php echo $row['c_credit']; ?></td>
        <td><?php echo $row['grade']; ?></td>
        <td><?php echo $row['trimester']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['deadline']; ?></td>
        <form action="a_recruitmentdelete.php" method="post">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <th> <input type="submit" name="delete" class="searchbtn" value="DELETE"></th>
        </form>
      </tr>
      <?php
    }
       ?>
    </tbody>

    </table>
  </div>



  <script src="./main.js"></script>
</body>
</html>
