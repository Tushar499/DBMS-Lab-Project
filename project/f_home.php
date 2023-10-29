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
    <link rel="stylesheet" href="f_home.css">
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
  <div id="main">
  <section style="padding:30px">
    <h2 style="text-align:center">List Of Applied Courses For Assistant</h2>

      <div>
          <table>
              <tr>
                <th>Course Name</th>
                <th>Department</th>
                <th>Section</th>
                <th>Course ID</th>
                <th>Time</th>
                <th>Trimester</th>
                <th>Assistant Type</th>
                <th>Assistant</th>
                <th>View</th>
                <th>Delete</th>
              </tr>
              <?php
                   $email = $_SESSION['femail'];
                   require_once "database.php";
                   $query = "SELECT * FROM f_request WHERE email = '$email'";
                   $query_run = mysqli_query($conn,$query);
                   foreach ($query_run as $row) {
                     $asid = $row['aid'];
                     if($asid > 0){
                       $sqlas = "SELECT * FROM s_application WHERE id = '$asid'";
                       $sqlas_run = mysqli_query($conn,$sqlas);
                       $firstuse = mysqli_fetch_array($sqlas_run);
                       $stuid = $firstuse['studentid'];
                       $sqlsec = "SELECT * FROM s_users WHERE studentid = '$stuid'";
                       $sqlsec_run = mysqli_query($conn,$sqlsec);
                       $use = mysqli_fetch_array($sqlsec_run);
                     }
               ?>
              <tr>
                <td><?php echo $row['coursename']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td><?php echo $row['section']; ?></td>
                <td><?php echo $row['courseid']; ?></td>
                <th><?php echo $row['time']; ?></th>
                <td><?php echo $row['trimester'] ?></td>
                <th><?php echo $row['type']; ?></th>
                <form action="f_assistantprofile.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <?php
                      if($row['assistant'] == 'Pending'){
                        ?>
                        <th><?php echo $row['assistant']; ?></th>
                        <?php
                      }else{
                        ?>

                        <th> <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$use['image'] ?>" alt="Avatar"><?php echo $row['assistant']; ?><?php echo " " ?><input class="searchbtn" type="submit" name="profile" value="View Profile"></th>
                        <?php
                      }
                   ?>
                </form>
                <form action="f_taskprofile.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <?php
                      if($row['assistant'] == 'Pending'){
                        ?>
                        <th><?php echo "Not Available" ?></th>
                        <?php
                      }else{
                        ?>
                        <br>
                        <br>
                        <th> <input type="submit" name="view" class="searchbtn" value="Click To View"></th>
                        <?php
                      }
                   ?>
                </form>
                <form action="f_request_delete.php" method="post">
                  <input type="hidden" name="aid" value="<?php echo $row['aid'] ?>">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <th> <input type="submit" name="delete" class="searchbtn" value="DELETE"></th>
                </form>
              </tr>
            <?php } ?>
          </table>
      </div>

  </section>

  <section style="padding-top:150px">

      <h2 style="text-align:center"> Ask For UA/Grader </h2>
      <form action="f_requestcode.php" class="sturecapply-form facultyapply-form" method="post">

          <div>
            <select style="width:200px;height:40px" name="type" class="form-select form-select mb-3" aria-label=".form-select-lg example">
              <option value="">Select Assistant Type</option>
              <option value="Undergraduate Assistant">UA</option>
              <option value="Grader">Grader</option>
            </select>

          </div>
          <div>
          <input style="width:400px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Course Name" name="coursename">
          <input style="width:250px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Course ID" name="courseid">
          <div>
            <select style="width:200px;height:40px" name="department" class="form-select form-select mb-3" aria-label=".form-select-lg example">
              <option value="">Select Department</option>
              <option value="Computer Science And Engineering">CSE</option>
              <option value="Electrical And Electronics Engineering">EEE</option>
              <option value="Civil Engineering">CE</option>
            </select>

          </div>
          <input style="width:200px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Section" name="section">
          <input style="width:200px" class="sturecapply-form-list facultyapply-form-list" type="text"  placeholder="Time" name="time">

          <div>
            <select style="width:200px;height:40px" name="trimester" class="form-select form-select mb-3" aria-label=".form-select-lg example">
              <option value="">Select Trimester</option>
              <option value="Fall">Fall</option>
              <option value="Spring">Spring</option>
              <option value="Summer">Summer</option>
            </select>

          </div>
        </div>
          <input class="sturecapply-form-btn" type="submit"  value="Apply" name="apply">
      </form>
  </section>
</div>



  <script src="main.js"></script>
</body>
</html>
