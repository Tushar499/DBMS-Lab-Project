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
    <link rel="stylesheet" href="s_taskprofile.css">
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

    <div style="text-align: center;">

      <?php
            require_once "database.php";
            if(isset($_POST['view'])){
              $sid = $_POST['id'];
              $_SESSION['stmp_sid'] = $sid;
            }
            $sid = $_SESSION['stmp_sid'];
            $sql = "SELECT * FROM s_application WHERE id = '$sid'";
            $sql_run = mysqli_query($conn,$sql);
            $find = mysqli_fetch_array($sql_run, MYSQLI_ASSOC);
            $associated = $find['associated'];
            $coursename = $find['coursename'];
            $section = $find['section'];
            $type = $find['type'];
            $fid = $find['aid'];
            $ok = "SELECT * FROM f_request WHERE id = '$fid'";
            $ok_run = mysqli_query($conn,$ok);
            $have = mysqli_fetch_array($ok_run, MYSQLI_ASSOC);
            $femail = $have['email'];
            $im = "SELECT * FROM f_users WHERE email = '$femail'";
            $im_run = mysqli_query($conn,$im);
            $imm = mysqli_fetch_array($im_run, MYSQLI_ASSOC);
            $image = $imm['image'];
            $_SESSION['stmp_image'] = $image;
            $_SESSION['stmp_coursename'] = $coursename;
            $_SESSION['stmp_section'] = $section;
            $_SESSION['stmp_associated'] = $associated;
       ?>
       <a style="float:right" href="s_uagrader.php">
         <input class="searchbtn" type="submit" value="BACK">
       </a>

        <img style="height:120px;width:120px" src="<?php echo "upload/".$_SESSION["simage"] ?>" alt="">
        <div class="">
          <table>
            <h4><?php echo $_SESSION['sname']; echo " | "; echo "Department Of "; echo $_SESSION['sdepartment'];?></h4>
            <h4><?php echo $type; ?> At United International University</h4>
            <h4>Associated With <?php echo $associated;?> <img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$image ?>" alt="Avatar"><?php echo " | Course - "; echo $coursename; echo " | Section - "; echo $section;?></h4>
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
          <th>Feedback</th>
          <th>Status</th>
        </tr>
        <?php
             $query = "SELECT * FROM task WHERE sid = '$sid'";
             $query_run = mysqli_query($conn,$query);
             foreach ($query_run as $row) {
         ?>
        <tr>
          <td><?php echo $row['tasktitle']; ?></td>
          <td><?php echo $row['topics']; ?></td>
          <td><textarea style="height:70px;width:270px"><?php echo $row['instructions'] ?></textarea></td>
          <td>
            <?php echo $row['deadline'];?><br><br>
            <?php
                //$date1 = DateTime::createFromFormat('d/m/Y', $row['deadline']);
                $dat = $row['deadline'];
                $cur = date('Y/m/d');
                $date1 = date_create($dat);
                $date2 = date_create($cur);
                $diff1 = date_diff($date1,$date2);
                $daysdiff = $diff1->format("%R%a");
                $daysdiff = abs($daysdiff);
                echo $daysdiff;echo " days left";
             ?>
          </td>
          <td>
            <?php
                if($row['assessment'] == ""){
                  echo "No File";
                }else{
                  ?>
                  <a href="upload/<?php echo $row['assessment']; ?>" target="_blank">View Assessment</a>
                  <?php
                }
             ?>
          </td>

          <td>
            <form class="" action="s_tasksubmit.php" method="post">
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <input class="searchbtn" type="submit" name="tasksubmit" value="Add Submission">
            </form>
            <br>
             <?php
                 if($row['submittedassessment'] == ""){
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
          <td>
            <textarea style="height:70px;width:270px"><?php echo $row['feedback'] ?></textarea>
            <br>
            <?php
                 if($row['l_feedback'] != ""){
                   echo "Last Updated : ";echo $row['l_feedback'];
                 }
             ?>
          </td>
          <td>
            <?php
                if($row['status'] == ""){
                  echo "In Progress";
                }else{
                  echo $row['status'];
                }
            ?>
          </td>
        </tr>
      <?php
            }
        ?>
    </table>
  </div>



  <script src="main.js"></script>
</body>
</html>
