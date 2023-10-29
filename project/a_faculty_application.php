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
    <link rel="stylesheet" href="a_faculty_application.css">
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

<div id="main">
  <a style="float:right" href="a_home.php">
    <input type="submit" class="searchbtn" value="BACK">
  </a>

  <section style="padding-left:800px;padding-top:40px">
    <form class="show" action="a_faculty_application.php" method="post">
      <select style="width:160px;height:30px" name="department" class="form-select form-select mb-3" aria-label=".form-select-lg example">
        <option value="">Select Department</option>
        <option value="Computer Science And Engineering">CSE</option>
        <option value="Electrical And Electronics Engineering">EEE</option>
        <option value="Civil Engineering">CE</option>
      </select>
        <input class="searchbtn" type="Submit" value="Select" name="select">
    </form>
    <?php
        require_once "database.php";
        if(isset($_POST['select'])){
          $_SESSION['department'] = $_POST['department'];
        }
        $department = $_SESSION['department'];
     ?>
  </section>
<section style="padding:30px">
  <h2 style="text-align:center">List Of Faculty Applications For Assistant</h2>
  <h3 style="text-align:center">Department Of <?php echo $department; ?></h3>

    <div style="padding-top:10px">
        <table>
            <tr>
              <th>Faculty Image</th>
              <th>Faculty Name</th>
              <th>Course Name</th>
              <th>Department</th>
              <th>Section</th>
              <th>Course ID</th>
              <th>Time</th>
              <th>Trimester</th>
              <th>Assistant Type</th>
              <th>Assistant</th>
              <th>SELECT Assistant</th>
            </tr>
            <?php
                 require_once "database.php";
                 if($department != ""){
                   $query = "SELECT * FROM f_request WHERE department = '$department' ORDER BY assistant = 'Pending' DESC";
                   $query_run = mysqli_query($conn,$query);
                   foreach ($query_run as $row) {
                     $email = $row['email'];
                     $aid = $row['aid'];
                     $sqlf = "SELECT image FROM f_users WHERE email = '$email'";
                     $sqlf_run = mysqli_query($conn,$sqlf);
                     $findf = mysqli_fetch_array($sqlf_run, MYSQLI_ASSOC);
                     $fimage = $findf['image'];
                     $simage = "";
                     if($aid != 0){
                       $sqls = "SELECT studentid FROM s_application WHERE id = '$aid'";
                       $sqls_run = mysqli_query($conn,$sqls);
                       $rowcnt = mysqli_num_rows($sqls_run);
                       if($rowcnt > 0){
                         $finds = mysqli_fetch_array($sqls_run, MYSQLI_ASSOC);
                         $studentid = $finds['studentid'];
                         $sqlsi = "SELECT image FROM s_users WHERE studentid = '$studentid'";
                         $sqlsi_run = mysqli_query($conn,$sqlsi);
                         $findsp = mysqli_fetch_array($sqlsi_run, MYSQLI_ASSOC);
                         $simage = $findsp['image'];
                       }
                     }
               ?>
              <tr>
                <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$fimage ?>" alt="Avatar"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['coursename']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['courseid']; ?></td>
                <th><?php echo $row['time']; ?></th>
                <td><?php echo $row['trimester']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <th>
                  <?php
                      if($simage != ""){
                        ?>
                        <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$simage ?>" alt="Avatar">
                        <?php
                      }
                      echo $row['assistant'];
                    ?>
                </th>
                <form action="a_select.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <input type="hidden" name="assistant" value="<?php echo $row['assistant']; ?>">
                  <th> <input type="submit" name="select" class="searchbtn" value="SELECT"></th>
                </form>
              </tr>
            <?php
               }
             }
             ?>
        </table>
    </div>
  </div>

</section>


  <script src="main.js"></script>
</body>
</html>
