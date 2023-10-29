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
      $leaderid = $_SESSION['sstudentid'];
      if(isset($_POST['search'])){
        $_SESSION['gsearch'] = $_POST['members'];
          $_SESSION['gview'] = 0;
      }
      if(isset($_POST['view'])){
        $_SESSION['gview'] = 1;
        $_SESSION['gsearch'] = "";
      }

      ?>

      <div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
   <?php
       $search = $_SESSION['gsearch'];
       $view = $_SESSION['gview'];
       if($search != "" && $view == 0){
         ?>
         <h4 style="text-align:center;padding-bottom:30px">Search Result For '<?php echo $search; ?>'</h4>
         <?php
       }else{
         ?>
         <h4 style="text-align:center;padding-bottom:30px">Showing All Available Members</h4>
         <?php
       }
    ?>
  <table>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Student ID</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
    <?php
        if($search != "" && $view == 0){
          $query = "SELECT * FROM s_users WHERE (name LIKE '%$search%' || studentid LIKE '%$search%') && studentid != '$leaderid'";
        }else{
          $department = $_SESSION['sdepartment'];
          $query = "SELECT * FROM s_users WHERE department = '$department' && studentid != '$leaderid'";
        }
        $query_run = mysqli_query($conn,$query);
        foreach ($query_run as $row) {
     ?>
    <tr>
      <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$row['image']; ?>" alt="Avatar"></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['studentid'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <th><form action="s_selectmembers.php" method="post">
        <input type="hidden" name="memberid" value="<?php echo $row['studentid']; ?>">
        <input type="submit" name="addmem" class="btn btn-success" value="ADD">
      </form></th>
    </tr>
  <?php } ?>
   </table>
   <?php
      if(isset($_POST['addmem'])){

        $memberid = $_POST['memberid'];
        $request = "do";
        $check = "SELECT memberid FROM thesis_group WHERE memberid = '$memberid'";
        $check_run = mysqli_query($conn,$check);
        $rcnt = mysqli_num_rows($check_run);
        if($rcnt == 0 ){
          $sql = "INSERT INTO thesis_group(leaderid,memberid,request) VALUES ('$leaderid','$memberid','$request')";
          $sql_run = mysqli_query($conn,$sql);
          echo '<script>alert("Member Added.")</script>';
          echo "<script>window.location.href ='s_profile.php'</script>";
        }else{
          echo '<script>alert("Member Already Added !")</script>';
          echo "<script>window.location.href ='s_selectmembers.php'</script>";
        }
      }
    ?>

   <div class="p-2">
     <a href="s_profile.php">
       <label class="btn btn-secondary">Back</label>
     </a>
   </div>
</div>



</body>
</html>
