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
      if(isset($_POST['submit'])){
        $_SESSION['sleaderid'] = $_POST['leaderid'];
      }

      ?>

      <div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
        <form action="s_submitfaculty.php" method="post">
          <div style="padding-left:400px;padding-right:200px">
            <input style="width:300px;height:40px" type="text" name="search" value="">
            <input type="submit" name="see" value="SEARCH" class="btn btn-primary">
          </div>
        </form>

        <?php
           $s = 0;
           if(isset($_POST['see'])){
             $_SESSION['sfsearch'] = $_POST['search'];
             $s = 1;
           }
           $search = $_SESSION['sfsearch'];
           $leaderid = $_SESSION['sleaderid'];
         ?>

        <h4 style="padding-top:30px;text-align:center;padding-bottom:70px">Available Faculty Members For Thesis Supervisor</h4>
        <table>
          <tr>
            <th>Image</th>
            <th>Faculty Name</th>
            <th>Faculty Type</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
          <?php
            if($s == 1){
              $query = "SELECT * FROM f_users WHERE name LIKE '%$search%' ORDER BY type = 'Professor' DESC";
              $query_run = mysqli_query($conn,$query);
            }else{
              $query = "SELECT * FROM f_users ORDER BY type = 'Professor' DESC";
              $query_run = mysqli_query($conn,$query);
            }
            foreach ($query_run as $row) {
           ?>
          <tr>
            <td><img style="clip-path: circle();height:45px;width:45px;vertical-align:middle;" src="<?php echo "upload/".$row['image']; ?>" alt="Avatar"></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
              <form action="s_submitfaculty.php" method="post">
                <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                <input type="submit" name="request" value="REQUEST" class="btn btn-success">
              </form>
            </td>
          </tr>
          <?php
           }
           if(isset($_POST['request'])){
             $email = $_POST['email'];
             $sql = "UPDATE thesis SET req = '$email' WHERE studentid = '$leaderid'";
             $sql_run = mysqli_query($conn,$sql);
             echo '<script>alert("Requested.")</script>';
             echo "<script>window.location.href ='s_profile.php'</script>";
           }
           ?>
        </table>
      </div>

   <div style="padding-left:800px;padding-top:30px">
     <a href="s_profile.php">
       <label class="btn btn-secondary">Back</label>
     </a>
   </div>
</div>



</body>
</html>
