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
      if(isset($_POST['viewproject'])){
        $leaderid = $_POST['studentid'];
        $query = "SELECT * FROM thesis WHERE studentid = '$leaderid'";
        $query_run = mysqli_query($conn,$query);
        $fet = mysqli_fetch_array($query_run);
        $ssi = "SELECT * FROM s_users WHERE studentid = '$leaderid'";
        $ssi_run = mysqli_query($conn,$ssi);
        $fat = mysqli_fetch_array($ssi_run);
      }
      ?>
      <h3 style="text-align:center;padding-bottom:30px;padding-top:70px">Thesis/Final Projects Info.</h3>
      <div style="padding-left:500px;padding-right:500px;padding-top:30px">
      <h5 style="padding-top:20px;padding-bottom:5px">Project Title</h5>
      <label ><?php  echo $fet['title'];?></label>
      <h5 style="padding-top:20px;padding-bottom:5px">Description</h5>
      <label><?php echo $fet['details']; ?></label>
      <h5 style="padding-top:20px;padding:bottom:5px">Group Members</h5>
      <h6><img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$fat['image']; ?>"> <?php echo $fat['name'];echo "(";echo $fat['studentid'];echo ")"; ?>
      </h6>
      <?php
      $sql = "SELECT * FROM thesis_group WHERE leaderid = '$leaderid' && request = 'me'";
      $sql_run = mysqli_query($conn,$sql);
      foreach ($sql_run as $row) {
        $memid = $row['memberid'];
        $find = "SELECT * FROM s_users WHERE studentid = '$memid'";
        $find_run = mysqli_query($conn,$find);
        $result = mysqli_fetch_array($find_run, MYSQLI_ASSOC);
        ?>
        <h6><img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$result['image']; ?>"> <?php echo $result['name'];echo "(";echo $result['studentid'];echo ")"; ?>
        </h6>
        <?php
      }
      ?>
    </div>

   <div style="padding-left:500px;padding-top:30px">
     <a href="s_profile.php">
       <label class="btn btn-secondary">Back</label>
     </a>
   </div>
</div>



</body>
</html>
