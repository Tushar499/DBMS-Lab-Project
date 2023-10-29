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
    <link rel="stylesheet" href="f_taskprofile.css">
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

    <?php
          require_once "database.php";
          if(isset($_POST['view'])){
            $fid = $_POST['id'];
            $_SESSION['fid'] = $fid;
          }
          $fid = $_SESSION['fid'];
          $sql = "SELECT * FROM f_request WHERE id = '$fid'";
          $sql_run = mysqli_query($conn,$sql);
          $find = mysqli_fetch_array($sql_run, MYSQLI_ASSOC);
          $_SESSION['ftmp_department'] = $find['department'];
          $_SESSION['ftmp_assistant'] = $find['assistant'];
          $_SESSION['ftmp_coursename'] = $find['coursename'];
          $_SESSION['ftmp_section'] = $find['section'];
          $_SESSION['ftmp_type'] = $find['type'];
          $sid = $find['aid'];
          $_SESSION['sid'] = $sid;
          $ok = "SELECT * FROM s_application WHERE id = '$sid'";
          $ok_run = mysqli_query($conn,$ok);
          $have = mysqli_fetch_array($ok_run, MYSQLI_ASSOC);
          $sstudentid = $have['studentid'];
          $im = "SELECT * FROM s_users WHERE studentid = '$sstudentid'";
          $im_run = mysqli_query($conn,$im);
          $imm = mysqli_fetch_array($im_run, MYSQLI_ASSOC);
          $image = $imm['image'];
          $_SESSION['ftmp_image'] = $image;
     ?>

    <div style="text-align: center;">
      <a style = "float:right" href="f_home.php">
        <input class="searchbtn" type="submit" value="BACK">
      </a>

        <img style="height:120px;width:120px" src="<?php echo "upload/".$_SESSION["fimage"] ?>" alt="">
        <div class="">
          <table>
            <h4> <?php echo $_SESSION['fname']; echo " | "; echo $_SESSION['ftype'] ?> At United International University</h4>
            <h4>Department Of <?php echo $_SESSION['ftmp_department']; ?></h4>
            <h4><?php echo $_SESSION['ftmp_type']; ?> - <?php echo $_SESSION['ftmp_assistant']?><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$_SESSION['ftmp_image'] ?>" alt="Avatar">
              <?php echo " | "; ?>Course - <?php echo $_SESSION['ftmp_coursename'] ?><?php echo " | " ?>Section - <?php echo $_SESSION['ftmp_section']; ?></h4>
          </table>
        </div>
    </div>

    <table>
      <h2 style="text-align:center">List Of Assigned Task</h2>
        <tr>
          <th>Task Title</th>
          <th>Topics</th>
          <th>Instructions</th>
          <th>Deadline</th>
          <th>Assessment</th>
          <th>Submitted Assessment</th>
          <th>Submission Comments</th>
          <th>Status</th>
          <th>Accept</th>
          <th>Redo</th>
          <th>Delete</th>
        </tr>
        <?php
             $fid = $_SESSION['fid'];
             $sid = $_SESSION['sid'];
             $query = "SELECT * FROM task WHERE fid = '$fid'";
             $query_run = mysqli_query($conn,$query);
             foreach ($query_run as $row) {
         ?>
        <tr>
          <td><?php echo $row['tasktitle'] ?></td>
          <td><?php echo $row['topics'] ?></td>
          <td><textarea style="height:70px;width:270px"><?php echo $row['instructions'] ?></textarea></td>
          <td><?php echo $row['deadline'] ?></td>

          <td>
            <?php echo $row['assessment'] ?>
            <br>
            <a href="upload/<?php echo $row['assessment']; ?>" target="_blank">View</a>
          </td>
          <td>
            <?php
                if($row['submittedassessment']  == ""){
                  echo "No Submission Yet";
                }else {
                  echo "Last Submission : ";echo $row['l_submission'];
                  ?>
                  <br>
                  <a href="upload/<?php echo $row['submittedassessment']; ?>" target="_blank">View Submission</a>
                  <?php
                }
             ?>
          </td>

          <td><textarea style="height:60px;width:210px"><?php echo $row['submissioncomment'] ?></textarea></td>

          <td>
            <?php
              if($row['status']==""){
               echo "In Progress";
             }else{
               echo $row['status'];
             }
             ?>

          </td>
          <form action="f_feedback.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <th> <input type="submit" name="accept" class="searchbtn" value="Accept"></th>
          </form>
          <form action="f_feedback.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <th> <input type="submit" name="redo" class="searchbtn" value="Redo"></th>
          </form>
          <form action="#" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <th> <input type="submit" name="delete" class="searchbtn" value="Delete"></th>
          </form>
        </tr>
      <?php } ?>

    </table>
    <section style="padding-top:50px;">
      <form class="" action="f_addtask.php" style="padding-left:900px">
        <input class="searchbtn" type="submit" name="addtask" value="ADD TASK">
      </form>
    </section>

    <?php
        if(isset($_POST['delete'])){
          $id = $_POST['id'];
          $del = "DELETE FROM task WHERE id = '$id'";
          $del_run = mysqli_query($conn,$del);
          echo '<script>alert("Task Deleted ! ")</script>';
          echo "<script>window.location.href ='f_taskprofile.php'</script>";
        }
     ?>

    </div>
  </div>



  <script src="main.js"></script>
</body>
</html>
