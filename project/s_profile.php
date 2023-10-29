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
          $studentid = $_SESSION['sstudentid'];
          $sql = "SELECT * FROM s_users WHERE studentid = '$studentid'";
          $sql_run = mysqli_query($conn,$sql);
          foreach ($sql_run as $row) {
      ?>

		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
			<div class="col-md-4 text-center">
				<img src="<?php echo "upload/".$row["image"] ?>" class="img-fluid rounded" style="width: 180px;height:180px;object-fit: cover;">
				<div>

						<a href="s_profile_edit.php">
							<button class="mx-auto m-1 btn-sm btn btn-primary">Edit</button>
						</a>
						<a href="logout.php">
							<button class="mx-auto m-1 btn-sm btn btn-info text-white">Logout</button>
						</a>
            <a href="s_home.php">
							<button class="mx-auto m-1 btn-sm btn btn-info text-success">Home</button>
						</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="h2">User Profile</div>
				<table class="table table-hover">
					<tr><th colspan="2">User Details:</th></tr>
					<tr><th><i class="bi bi-person-circle"></i> Name</th><td><?php echo $row['name']; ?></td></tr>
					<tr><th><i class="bi bi-pen"></i> Student ID</th><td> <?php echo $row["studentid"]; ?></td></tr>
					<tr><th><i class="bi bi-envelope"></i> Email</th><td> <?php echo $row["email"]; ?> </td></tr>
          <tr><th><i class="bi bi-envelope"></i> CGPA</th><td> <?php echo $row["cgpa"]; ?> </td></tr>
          <tr><th><i class="bi bi-envelope"></i> Completed Credit</th><td> <?php echo $row["c_credit"]; ?> </td></tr>
          <tr><th><i class="bi bi-envelope"></i> Department</th><td> <?php echo $row["department"]; ?> </td></tr>
					<tr><th><i class="bi bi-gender-ambiguous"></i> Gender</th><td> <?php echo $row["gender"]; ?> </td></tr>
					<tr><th><i class="bi bi-link"></i> Website</th><td><a href="<?php echo $row["website"]; ?>"><?php echo $row["website"]; ?></a></td></tr>
					<tr><th><i class="bi bi-github"></i> Github</th><td><a href="<?php echo $row["github"]; ?>"><?php echo $row["github"]; ?></a></td></tr>
					<tr><th><i class="bi bi-facebook"></i> Facebook</th><td><a href="<?php echo $row["facebook"]; ?>"><?php echo $row["facebook"]; ?></a></td></tr>
					<tr><th><i class="bi bi-linkedin"></i> Linkedin</th><td><a href="<?php echo $row["linkedin"]; ?>"><?php echo $row["linkedin"]; ?></a></td></tr>
				</table>
			</div>
		</div>
  <?php } ?>
    <div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
        <h4 style="text-align:center">Recent Status</h4>
        <table>
          <?php
              $query = "SELECT * FROM s_application WHERE studentid = '$studentid' && associated != 'Pending'";
              $query_run = mysqli_query($conn,$query);
              foreach ($query_run as $raw) {
                $type = $raw['type'];
                $coursename = $raw['coursename'];
                $section = $raw['section'];
           ?>
           <tr>
          <td style="padding-left:400px"><?php echo $type;echo " Of ";echo $coursename;echo " ($section)";?></td>
          <td><form action="s_seesimilar.php" method="post">
            <input type="hidden" name="courseid" value="<?php echo $raw['courseid']; ?>">
            <input type="hidden" name="type" value="<?php echo $raw['type']; ?>">
            <th style="padding-right:300px"> <input type="submit" name="find" class="btn btn-primary" value="Find"></th>
          </form></td>
        </tr>
        <?php } ?>
      </tr>
        </table>
      </div>

      <div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
        <h4 style="text-align:center;padding-bottom:30px">Thesis/Final Projects Info.</h4>


          <?php
              $sql = "SELECT * FROM thesis WHERE studentid = '$studentid'";
              $sql_run = mysqli_query($conn,$sql);
              $rcnt = mysqli_num_rows($sql_run);
              $project = mysqli_fetch_array($sql_run, MYSQLI_ASSOC);
              $checkme = "SELECT * FROM thesis_group WHERE memberid = '$studentid'";
              $checkme_run = mysqli_query($conn,$checkme);
              $myrcnt = mysqli_num_rows($checkme_run);

              $coca = mysqli_fetch_array($checkme_run);
              $flag = 0;
              if($myrcnt > 0){
                if($coca['request'] == 'me'){
                  $flag = 1;
                }
              }
              if($rcnt == 0 && $flag == 0){
                ?>
                <form class="" action="s_startproject.php" method="post">
                <div style="padding-left:550px">
                  <input type="submit" name="start" class="btn btn-success" value="Start Project">
                </div>
                </form>
                <?php
              }else if($rcnt>0){

                ?>
                <div style="padding-left:200px;padding-right:200px">
                  <div>
                    <form action="s_profile.php" method="post">
                      <input type="submit" name="edit" class="btn btn-primary" value="EDIT">
                      <input type="submit" name="done" class="btn btn-success" value="DONE">
                    </form>
                  </div>
                  <?php
                     $edit = 0;

                     if(isset($_POST['edit'])){
                       $edit = 1;
                     }
                     if(isset($_POST['done'])){
                       $edit = 0;
                     }
                     if($edit == 1){
                       ?>
                       <div style="padding-top:30px">
                           <form action="s_profile.php" method="post">
                             <input type="submit" name="removex" class="btn btn-danger" value="REMOVE PROJECT">
                           </form>
                         </div>
                         <?php
                     }
                     if(isset($_POST['removex'])){
                       $del = "DELETE FROM thesis WHERE studentid = '$studentid'";
                       $del_run = mysqli_query($conn,$del);
                       $delmor = "DELETE FROM thesis_group WHERE leaderid = '$studentid'";
                       $delmor_run = mysqli_query($conn,$delmor);
                       echo '<script>alert("Project Deleted.")</script>';
                       echo "<script>window.location.href ='s_profile.php'</script>";
                     }
                   ?>
                  <br>
                  <form action="s_editproject.php" method="post">

                  <h5 style="padding-top:20px;padding-bottom:5px">Project Title
                    <?php if($edit == 1){
                    ?>
                    <input type="submit" name="editp" class="btn btn-primary" value="edit project info.">
                    <?php
                  } ?></h5>
                  <label ><?php  echo $project['title'];?></label>
                  <h5 style="padding-top:20px;padding-bottom:5px">Description</h5>
                  <label><?php echo $project['details']; ?></label>
                </form>
                  <?php
                      if($project['status'] == ""){
                        $sql = "SELECT * FROM thesis_group WHERE leaderid = '$studentid' && request != 'others'";
                      }else{
                        $sql = "SELECT * FROM thesis_group WHERE leaderid = '$studentid' && request = 'me'";
                      }
                      $sql_run = mysqli_query($conn,$sql);
                      $rcnt = mysqli_num_rows($sql_run);
                      ?>
                      <h5 style="padding-top:20px;padding:bottom:5px">Group Members</h5>
                      <h6><img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$_SESSION['simage']; ?>"> <?php echo $_SESSION['sname'];echo "(";echo $_SESSION['sstudentid'];echo ")"; ?>
                        <img style="clip-path: circle();height:20px;width:20px;vertical-align:middle;" src="upload/acceptok.jpg">
                      </h6>
                      <?php
                      ?>
                      <form action="s_profile.php" method="post">

                      <?php
                      if($rcnt > 0){
                        foreach ($sql_run as $row) {
                          $memid = $row['memberid'];
                          $find = "SELECT * FROM s_users WHERE studentid = '$memid'";
                          $find_run = mysqli_query($conn,$find);
                          $result = mysqli_fetch_array($find_run, MYSQLI_ASSOC);
                          ?>
                          <h6><img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$result['image']; ?>"> <?php echo $result['name'];echo "(";echo $result['studentid'];echo ")"; ?>
                            <?php
                               $rein = $row['request'];
                               if($rein != 'me'){
                                 ?>
                                 <img style="clip-path: circle();height:20px;width:20px;vertical-align:middle;" src="upload/pendingok.jpg">
                                 <?php
                               }else{
                                 ?>
                                 <img style="clip-path: circle();height:20px;width:20px;vertical-align:middle;" src="upload/acceptok.jpg">
                                 <?php
                               }
                               if($edit == 1 && $project['status'] == ""){
                                 ?>
                                  <input type="hidden" name="memberid" value="<?php echo $result['studentid']; ?>">
                                  <input type="submit" name="remove" class="btn btn-danger" value="REMOVE">
                                 <?php
                               }
                             ?>
                          </h6>
                          <?php
                        }
                    }
                   ?>
                 </form>
                 <?php
                 if(isset($_POST['remove'])){
                   $memberid = $_POST['memberid'];
                   $sqlremove = "DELETE FROM thesis_group WHERE memberid = '$memberid'";
                   $sqlremove_run = mysqli_query($conn,$sqlremove);
                   echo '<script>alert("Member Deleted.")</script>';
                   echo "<script>window.location.href ='s_profile.php'</script>";
                 }
                if($project['status'] != ""){
                  ?>
                  <h5 style="padding-top:20px;padding:bottom:5px">Supervisor</h5>
                  <?php
                  $req = $project['req'];
                  $lead = "SELECT * FROM f_users WHERE email = '$req'";
                  $lead_run = mysqli_query($conn,$lead);
                  $lede = mysqli_fetch_array($lead_run);
                  ?>
                  <h6><img style="clip-path: circle();height:35px;width:35px;vertical-align:middle;" src="<?php echo "upload/".$lede['image']; ?>"> <?php echo $lede['name'];echo " ";;echo $lede['type'];echo " at united international university"; ?></h6>
                  <?php
                }


                 $groupvalid = "SELECT * FROM thesis_group";
                 $groupvalid_run = mysqli_query($conn,$groupvalid);
                 $valid = mysqli_num_rows($groupvalid_run);
                 if($valid <= 5){
                  ?>
                  <form action="s_profile.php" method="post">
                    <?php
                        if(!isset($_POST['add']) && $project['status'] == ""){
                          ?>
                          <div style="padding-left:300px;padding-top:20px">
                            <input type="submit" name="add" class="btn btn-success" value="Add Group Members">
                          </div>
                          <?php
                        }
                     ?>
                  </form>
                  <?php
                 }
                  if(isset($_POST['add']) && $project['status'] == ''){
                    ?>
                    <form action="s_selectmembers.php" method="post">
                      <div style="padding-left:200px;padding-top:20px">
                        <h6>Search Members</h6>
                        <input type="text" name="members">
                        <br>
                        <div style="padding-top:10px">
                          <input type="submit" name="search" class="btn btn-primary" value="SEARCH">
                        </div>

                        <div style="padding-top:10px">
                          <input type="submit" name="view" class="btn btn-success" value="VIEW ALL">
                        </div>
                      </div>
                    </form>
                    <?php
                  }

                 if(!isset($_POST['add'])){
                   ?>
                   <form action="s_profile.php" method="post">
                     <div style="padding-left:300px;padding-top:20px">
                       <input type="submit" name="posti" class="btn btn-info" value="Post It">
                     </div>
                   </form>
                   <?php
                 }
                 if($project['status'] == ""){
                 ?>
                 <div style="padding-left:400px;padding-top:40px">
                   <form action="s_submitfaculty.php" method="post">
                     <input type="hidden" name="leaderid" value="<?php echo $studentid ?>">
                     <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
                   </form>
                 </div>
                 <?php
               }
                 if(isset($_POST['posti'])){
                   $sqlpcheck = "SELECT p_time FROM thesis WHERE studentid = '$studentid'";
                   $sqlpcheck_run = mysqli_query($conn,$sqlpcheck);
                   $p_time = "";
                   foreach ($sqlpcheck_run as $raw) {
                     $p_time = $raw['p_time'];
                   }
                   if($p_time != ""){
                     echo '<script>alert("Already Posted !")</script>';
                     echo "<script>window.location.href ='s_profile.php'</script>";
                   }else{
                     date_default_timezone_set("Asia/Dhaka");
                     $t = date_default_timezone_get() . date("H:i");
                     $len = strlen($t);
                     $time = substr("$t",10,$len);
                     $date = date('d-m-y');
                     $sqlpost = "UPDATE thesis SET p_time = '$time',p_date = '$date'";
                     $sqlpost_run = mysqli_query($conn,$sqlpost);
                     echo '<script>alert("Project Has Been Posted Successfully")</script>';
                     echo "<script>window.location.href ='s_postproject.php'</script>";
                   }
                 }

                ?>
                </div>
                <?php
                    $mrequest = "SELECT * FROM thesis_group WHERE request = 'others'";
                    $mrequest_run = mysqli_query($conn,$mrequest);
                    $recnt = mysqli_num_rows($mrequest_run);
                    if($recnt>0){
                 ?>
                 <h3 style="text-align:center;padding-top:150px;padding-bottom:20px">Member Requests</h3>
                <table>
                  <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Studentid</th>
                    <th>Profile</th>
                    <th>Action</th>
                  </tr>
                  <?php
                     foreach ($mrequest_run as $raj) {
                       $reqid = $raj['memberid'];
                       $ruser = "SELECT * FROM s_users WHERE studentid = '$reqid'";
                       $ruser_run = mysqli_query($conn,$ruser);
                       $use = mysqli_fetch_array($ruser_run, MYSQLI_ASSOC);
                   ?>
                  <tr>
                    <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$use['image']; ?>" alt="Avatar"></td>
                    <td><?php echo $use['name'] ?></td>
                    <td><?php echo $use['studentid']; ?></td>
                    <td>
                      <form action="s_seeprofile.php" method="post">
                        <input type="hidden" name="studentid" value="<?php echo $use['studentid'] ?>">
                        <input type="submit" name="viewp" value="View Profile" class="btn btn-primary">
                      </form>
                    </td>
                    <td>
                      <div style="display:flex">
                        <form action="s_profile.php" method="post">
                          <input type="hidden" name="studentid" value="<?php echo $use['studentid'] ?>">
                           <input type="submit" name="accept" value="ACCEPT" class="btn btn-success">
                        </form>
                        <form class="" action="s_profile.php" method="post">
                          <input type="hidden" name="studentid" value="<?php echo $use['studentid'] ?>">
                           <input type="submit" name="delete" value="IGNORE" class="btn btn-danger">
                        </form>
                      </div>
                    </td>
                  </tr>
                  <?php
                }
                   ?>
                </table>
                <?php
              }

                   if(isset($_POST['accept'])){
                     $requestid = $_POST['studentid'];
                     $sqlacc = "UPDATE thesis_group SET request = 'me' WHERE memberid = '$requestid'";
                     $sqlacc_run = mysqli_query($conn,$sqlacc);
                     echo '<script>alert("Member Request Approved.")</script>';
                     echo "<script>window.location.href ='s_profile.php'</script>";
                   }
                   if(isset($_POST['delete'])){
                     $requestid = $_POST['studentid'];
                     $sqlacc = "DELETE FROM thesis_group WHERE memberid = '$requestid'";
                     $sqlacc_run = mysqli_query($conn,$sqlacc);
                     echo '<script>alert("Member Request Deleted ! ")</script>';
                     echo "<script>window.location.href ='s_profile.php'</script>";
                   }
              }
              if($myrcnt > 0){
                $leid = $coca['leaderid'];
                $luser = "SELECT * FROM s_users WHERE studentid = '$leid'";
                $luser_run = mysqli_query($conn,$luser);
                $have = mysqli_fetch_array($luser_run);
                if($coca['request'] == 'do'){
                ?>
                <div style="padding-left:400px;padding-top:50px">
                  <label><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$have['image']; ?>" alt="Avatar"> <?php echo $have['name'];echo " ";
                  echo "has invited you to the Team"; ?></label>
                  <form action="s_profile.php" method="post">
                    <div style="padding-top:10px">
                      <input type="submit" name="raccept" value="ACCEPT" class="btn btn-success">
                      <input type="submit" name="rdelete" value="REJECT" class="btn btn-danger">
                    </div>
                  </form>
                  <div style="padding-top:20px">
                    <form action="s_viewproject.php" method="post">
                      <input type="hidden" name="studentid" value="<?php echo $leid ?>">
                      <input type="submit" name="viewproject" value="View Project" class="btn btn-primary">
                    </form>
                  </div>
                </div>

                <?php
                  if(isset($_POST['rdelete'])){
                    $sqlacc = "UPDATE thesis_group SET request = 'no' WHERE memberid = '$studentid'";
                    $sqlacc_run = mysqli_query($conn,$sqlacc);
                    echo '<script>alert("Team Request Rejected ! ")</script>';
                    echo "<script>window.location.href ='s_profile.php'</script>";
                  }
                  if(isset($_POST['raccept'])){
                    $sqlacc = "UPDATE thesis_group SET request = 'me' WHERE memberid = '$studentid'";
                    $sqlacc_run = mysqli_query($conn,$sqlacc);
                    echo '<script>alert("Team Request Accepted.")</script>';
                    echo "<script>window.location.href ='s_profile.php'</script>";
                  }
                }
                if($coca['request'] == 'me'){
                $mypro = "SELECT * FROM thesis WHERE studentid = '$leid'";
                $mypro_run = mysqli_query($conn,$mypro);
                $prohave = mysqli_fetch_array($mypro_run);
                ?>

                <div style="padding-left:200px;padding-right:200px;padding-top:30px">
                <h5 style="padding-top:20px;padding-bottom:5px">Project Title</h5>
                <label ><?php  echo $prohave['title'];?></label>
                <h5 style="padding-top:20px;padding-bottom:5px">Description</h5>
                <label><?php echo $prohave['details']; ?></label>
                <h5 style="padding-top:20px;padding:bottom:5px">Group Members</h5>
                <h6><img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$have['image']; ?>"> <?php echo $have['name'];echo "(";echo $have['studentid'];echo ")"; ?>
                </h6>
                <?php
                $gmem = "SELECT * FROM thesis_group WHERE leaderid = '$leid' && request = 'me'";
                $gmem_run = mysqli_query($conn,$gmem);
                foreach ($gmem_run as $ran) {
                  $memid = $ran['memberid'];
                  $find = "SELECT * FROM s_users WHERE studentid = '$memid'";
                  $find_run = mysqli_query($conn,$find);
                  $result = mysqli_fetch_array($find_run, MYSQLI_ASSOC);
                  ?>
                  <h6><img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$result['image']; ?>"> <?php echo $result['name'];echo "(";echo $result['studentid'];echo ")"; ?>
                  </h6>
                  <?php
                }
                if($prohave['status'] != ""){
                  ?>
                  <h5 style="padding-top:20px;padding:bottom:5px">Supervisor</h5>
                  <?php
                  $req = $prohave['req'];
                  $lead = "SELECT * FROM f_users WHERE email = '$req'";
                  $lead_run = mysqli_query($conn,$lead);
                  $lede = mysqli_fetch_array($lead_run);
                  ?>
                  <h6><img style="clip-path: circle();height:35px;width:35px;vertical-align:middle;" src="<?php echo "upload/".$lede['image']; ?>"> <?php echo $lede['name'];echo " ";;echo $lede['type'];echo " at united international university"; ?></h6>
                  <?php
                }
                ?>
                <form action="s_profile.php" method="post">
                  <div style="padding-left:300px;padding-top:20px">
                    <input type="hidden" name="leid" value="<?php echo $leid ?>">
                    <input type="submit" name="removeo" value="REMOVE PROJECT" class="btn btn-danger">
                  </div>
                </form>
              </div>
              <?php
              if(isset($_POST['removeo'])){
                $requestid = $_POST['leid'];
                $sqlacc = "DELETE FROM thesis_group WHERE leaderid = '$requestid' && memberid = '$studentid'";
                $sqlacc_run = mysqli_query($conn,$sqlacc);
                echo '<script>alert("Project Deleted ! ")</script>';
                echo "<script>window.location.href ='s_profile.php'</script>";
              }
              }
            }
            ?>
      </div>

</body>
</html>
