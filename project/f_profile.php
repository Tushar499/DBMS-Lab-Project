<?php
    session_start();
    if(!isset($_SESSION['fuser'])){
      session_destroy();
      header('Location: f_login.php');
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



		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
			<div class="col-md-4 text-center">
				<img src="<?php echo "upload/".$_SESSION["fimage"] ?>" class="img-fluid rounded" style="width: 180px;height:180px;object-fit: cover;">
				<div>

						<a href="f_profile_edit.php">
							<button class="mx-auto m-1 btn-sm btn btn-primary">Edit</button>
						</a>
						<a href="logout.php">
							<button class="mx-auto m-1 btn-sm btn btn-info text-white">Logout</button>
						</a>
            <a href="f_home.php">
							<button class="mx-auto m-1 btn-sm btn btn-info text-success">Home</button>
						</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="h2">Faculty Profile</div>
				<table class="table table-hover">
          <?php
              require_once "database.php";
              $email = $_SESSION['femail'];
              $sql = "SELECT * FROM f_users WHERE email = '$email'";
              $sql_run = mysqli_query($conn,$sql);
              foreach ($sql_run as $row) {
           ?>
					<tr><th colspan="2">Faculty Details:</th></tr>
					<tr><th><i class="bi bi-person-circle"></i> Name</th><td><?php echo $row['name']; ?></td></tr>
					<tr><th><i class="bi bi-Profile"></i> <?php echo $row["type"]; ?></th><td> At United International University</td></tr>
					<tr><th><i class="bi bi-envelope"></i> Email</th><td> <?php echo $row["email"]; ?> </td></tr>
					<tr><th><i class="bi bi-link"></i> Website</th><td><a href="<?php echo $row["website"]; ?>"><?php echo $row["website"]; ?></a></td></tr>
					<tr><th><i class="bi bi-github"></i> Github</th><td><a href="<?php echo $row["github"]; ?>"><?php echo $row["github"]; ?></a></td></tr>
					<tr><th><i class="bi bi-linkedin"></i> Linkedin</th><td><a href="<?php echo $row["linkedin"]; ?>"><?php echo $row["linkedin"]; ?></a></td></tr>
        <?php } ?>
				</table>
			</div>
		</div>

</body>
</html>
