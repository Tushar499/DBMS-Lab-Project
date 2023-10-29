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
    <link rel="stylesheet" href="s_uagrader.css">
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
  <div style="float:right;padding-right:20px;padding-top:5px">
    <a href="s_recruitment.php">
      <button class="searchbtn">BACK</button>
    </a>

  </div>

  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
    <h3 style="text-align:center;padding-bottom:20px">Applied Courses Details</h3>
    <table>
        <tr>
          <th>Course name</th>
          <th>Course ID</th>
          <th>Section</th>
          <th>Applied Course Point</th>
          <th>Trimester</th>
          <th>Class Times</th>
          <th>Assistant Type</th>
          <th>Recommended By</th>
          <th>Associated With</th>
          <th>View Assigned Task</th>
          <th>Delete</th>
        </tr>
        <?php
            require_once "database.php";
            $studentid = $_SESSION['sstudentid'];
            $sql = "SELECT * FROM s_application WHERE studentid = '$studentid'";
            $sql_run = mysqli_query($conn,$sql);
            foreach ($sql_run as $row) {
              $rid = $row['rid'];
              $aid = $row['aid'];
              $rimage = "";
              $aimage = "";
              if($rid != 0){
                $sqlr = "SELECT email FROM f_request WHERE id = '$rid'";
                $sqlr_run = mysqli_query($conn,$sqlr);
                $findr = mysqli_fetch_array($sqlr_run, MYSQLI_ASSOC);
                $remail = $findr['email'];
                $sqlrp = "SELECT image FROM f_users WHERE email = '$remail'";
                $sqlrp_run = mysqli_query($conn,$sqlrp);
                $findrp = mysqli_fetch_array($sqlrp_run, MYSQLI_ASSOC);
                $rimage = $findrp['image'];
              }
              if($aid != 0){
                $sqla = "SELECT email FROM f_request WHERE id = '$aid'";
                $sqla_run = mysqli_query($conn,$sqla);
                $finda = mysqli_fetch_array($sqla_run, MYSQLI_ASSOC);
                $aemail = $finda['email'];
                $sqlap = "SELECT image FROM f_users WHERE email = '$aemail'";
                $sqlap_run = mysqli_query($conn,$sqlap);
                $findap = mysqli_fetch_array($sqlap_run, MYSQLI_ASSOC);
                $aimage = $findap['image'];
              }
         ?>
        <tr>
          <td><?php echo $row['coursename']; ?></td>
          <td><?php echo $row['courseid']; ?></td>
          <td><?php echo $row['section']; ?></td>
          <td><?php echo $row['grade']; ?></td>
          <td><?php echo $row['trimester']; ?></td>
          <td><?php echo $row['time']; ?></td>
          <td><?php echo $row['type']; ?></td>
          <form action="s_ask.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <?php
                if(($row['recommendation'] == 'No Recommendation' || $row['recommendation'] == 'Asked') && $row['associated'] == 'Pending'){
                  ?>
                  <th> <?php
                  if($rimage == ""){
                    echo $row['recommendation'];
                  }else{
                    ?>
                    <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$rimage ?>" alt="Avatar">
                    <?php
                    echo $row['recommendation'];echo " ";
                  }
                      ?>
                    <input class="searchbtn" type="submit" name="ask" class="btn btn-danger" value="ASK"></th>
                  <?php
                }else{
                  ?>
                  <th><?php
                  if($rimage == ""){
                    echo $row['recommendation'];
                  }else{
                    ?>
                    <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$rimage ?>" alt="Avatar">
                    <?php
                    echo $row['recommendation'];
                  }
                  ?>
                </th>
                  <?php
                }
             ?>
          </form>
          <form action="s_fprofile.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <?php
                if($row['associated'] == 'Pending'){
                  ?>
                  <th><?php echo $row['associated']; ?></th>
                  <?php
                }else{
                  ?>
                  <th><?php ?>
                  <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$aimage ?>" alt="Avatar">
                  <?php
                  echo $row['associated']; ?><?php echo " " ?><input class="searchbtn" type="submit" name="profile" value="View Profile"></th>
                  <?php
                }
             ?>
          </form>
          <form action="s_taskprofile.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <?php
                if($row['associated'] == 'Pending'){
                  ?>
                  <th><?php echo "Not Available" ?></th>
                  <?php
                }else{
                  ?>
                  <th><input class="searchbtn" type="submit" name="view" class="btn btn-danger" value="Click To View"></th>
                  <?php
                }
             ?>
          </form>
          <form action="s_delete_apply.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <th> <input class="searchbtn" type="submit" name="delete" class="btn btn-danger" value="DELETE"></th>
          </form>
        </tr>
      <?php } ?>

    </table>
  </div>



  <script src="main.js"></script>
</body>
</html>
