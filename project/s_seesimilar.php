<?php
    session_start();
    if(!isset($_SESSION['suser'])){
      session_destroy();
      header('Location: s_login.php');
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
</head>
<body>

     <?php
      require_once "database.php";
      if(isset($_POST['find'])){
        $courseid = $_POST['courseid'];
        $type = $_POST['type'];
        $_SESSION['sp_tmp_courseid'] = $courseid;
        $_SESSION['sp_tmp_type'] = $type;

      }
      $courseid = $_SESSION['sp_tmp_courseid'];
      $type = $_SESSION['sp_tmp_type'];
      $department = $_SESSION['sdepartment'];
      $meid = $_SESSION['sstudentid'];
      $sql = "SELECT * FROM s_application WHERE courseid = '$courseid' && department = '$department' && type = '$type' && associated != 'Pending' && studentid != '$meid'";
      $sql_run = mysqli_query($conn,$sql);

      ?>

      <div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
  <h4 style="text-align:center">Showing Similar Users</h4>
  <table>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Student ID</th>
      <th>Associated with</th>
      <th>View</th>
    </tr>
  <?php
        foreach ($sql_run as $row) {
        $studentid = $row['studentid'];
        $aid = $row['aid'];
        $aimage = "";
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
        $query = "SELECT image FROM s_users WHERE studentid = '$studentid'";
        $query_run = mysqli_query($conn,$query);
        $user = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
        $simage = $user['image'];
   ?>
     <tr>
       <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$simage ?>" alt="Avatar"></td>
       <td><?php echo $row['name'] ?></td>
       <td><?php echo $row['studentid'] ?></td>
       <td><?php
           if($row['associated'] == 'Pending'){
             ?>
             <?php echo $row['associated']; ?>
             <?php
           }else{
             ?>
             <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$aimage ?>" alt="Avatar">
             <?php echo $row['associated']; ?>
             <?php
           }
        ?></td>
        <td>
          <form action="s_seeprofile.php" method="post">
            <input type="hidden" name="studentid" value="<?php echo $row['studentid']; ?>">
            <input type="submit" name="viewp" class="btn btn-primary" value="View Profile">
          </form>
        </td>
     </tr>
     <?php } ?>
   </table>
   <div class="p-2">
     <a href="s_profile.php">
       <label class="btn btn-secondary">Back</label>
     </a>
   </div>
</div>



</body>
</html>
