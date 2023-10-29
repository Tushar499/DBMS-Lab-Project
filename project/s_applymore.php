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
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
</head>
<body>

		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
      <?php
      require_once "database.php";
      $ok = 1;
      if(isset($_POST['apply'])){
        $id = $_POST['id'];
        $grade = $_POST['grade'];
        $courseid = $_POST['courseid'];
        if(empty($grade) OR empty($courseid)){
          $ok = 2;
          ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>All Fields Are Required!</strong>
          </div>
          <?php
        }else{
          $sql = "SELECT * FROM a_recruitment WHERE id = '$id'";
          $sql_run = mysqli_query($conn,$sql);
          $row = mysqli_fetch_array($sql_run, MYSQLI_ASSOC);
          $type = $row['title'];
          $department = $row['department'];
          $trimester = $row['trimester'];
          $query = "SELECT * FROM f_request WHERE courseid = '$courseid' && department = '$department' && type = '$type' && trimester = '$trimester' && aid = 0";
          $query_run = mysqli_query($conn,$query);
        }
      }
      if($ok == 1){
      ?>
      <table>
        <tr>
          <th>Section</th>
          <th>Class Time</th>
          <th>Action</th>
        </tr>
        <?php
        foreach ($query_run as $raw) {
         ?>
        <tr>
          <td><?php echo $raw['section']; ?></td>
          <td><?php echo $raw['time']; ?></td>
          <form action="s_applyselect.php" method="post">
            <input type="hidden" name="id" value="<?php echo $raw['id']; ?>">
            <input type="hidden" name="point" value="<?php echo $grade; ?>">
            <th> <input type="submit" name="choose" class="btn btn-danger" value="Choose"></th>
          </form>
        </tr>
      <?php } ?>

      </table>
    <?php } ?>
       <div class="p-2">
         <a href="s_recruitment.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
