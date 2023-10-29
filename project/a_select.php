<?php
    session_start();
    if(!isset($_SESSION['admin'])){
      session_destroy();
      header('Location: a_login.php');
    }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
</head>
<body>

		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
      <?php
      require_once "database.php";
      if(isset($_POST['select'])){
        $id = $_POST['id'];
        $assistant = $_POST['assistant'];
        $department = "";$type = "";$section = "";$courseid = "";$trimester = "";$fname = "";
        $sql = "SELECT * FROM f_request WHERE id = '$id'";
        $sql_run = mysqli_query($conn,$sql);
        foreach ($sql_run as $row) {
          $department = $row['department'];
          $type = $row['type'];
          $section = $row['section'];
          $courseid = $row['courseid'];
          $trimester = $row['trimester'];
          $fname = $row['name'];
        }
        $query = "SELECT * FROM s_application WHERE department = '$department' && type = '$type' && section = '$section' && courseid = '$courseid' && trimester = '$trimester' && associated = 'Pending'
        ORDER BY (recommendation = 'No Recommendation' || recommendation = 'Asked') ASC, cgpa DESC,c_credit DESC, grade DESC";
        $query_run = mysqli_query($conn,$query);
      }
      ?>
      <table>
        <tr>
          <th>Student Name</th>
          <th>Student ID</th>
          <th>CGPA</th>
          <th>Completed Credit</th>
          <th>Applied Course Point</th>
          <th>Recommended By</th>
          <th>Action</th>
        </tr>
        <?php
             foreach ($query_run as $raw) {
               $rid = $raw['rid'];
               $rimage = "";
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
         ?>
        <tr>
          <td><?php echo $raw['name']; ?></td>
          <td><?php echo $raw['studentid']; ?></td>
          <td><?php echo $raw['cgpa']; ?></td>
          <td><?php echo $raw['c_credit']; ?></td>
          <td><?php echo $raw['grade']; ?></td>
          <td><?php
              if($rimage == ""){
                echo $raw['recommendation'];
              }else{
                ?>
                <img style="clip-path: circle();height:30px;width:30px;vertical-align:middle;" src="<?php echo "upload/".$rimage ?>" alt="Avatar">
                <?php
                echo $raw['recommendation'];
              }
            ?></td>
          <form action="a_selectcode.php" method="post">
            <input type="hidden" name="sid" value="<?php echo $raw['id']; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="fname" value="<?php echo $fname; ?>">
            <input type="hidden" name="sname" value="<?php echo $raw['name']; ?>">
            <th> <input type="submit" name="choose" class="btn btn-danger" value="SELECT"></th>
          </form>
        </tr>
      <?php
         }
      ?>

      </table>
       <div class="p-2">
         <a href="a_faculty_application.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
