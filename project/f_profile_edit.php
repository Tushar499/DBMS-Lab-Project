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
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
</head>
<body>
	<?php
      require_once "database.php";
      $email = $_SESSION['femail'];
			if(isset($_POST['save1'])){
				$name = $_POST['name'];
        if(empty($name)){
           $name = $_SESSION['fname'];
        }
				$type = $_POST['type'];
        if(empty($gender)){
           $type = $_SESSION['ftype'];
        }
				$website = $_POST['website'];
        if(empty($website)){
           $website = $_SESSION['fwebsite'];
        }
				$github = $_POST['github'];
        if(empty($github)){
           $github = $_SESSION['fgithub'];
        }

				$linkedin = $_POST['linkedin'];
        if(empty($linkedin)){
           $linkedin = $_SESSION['flinkedin'];
        }
				$image = $_FILES['image']['name'];
        if(empty($image)){
           $image = $_SESSION['fimage'];
        }

        $query = "UPDATE f_users SET name = '$name', type='$type',website='$website',
						github='$github',linkedin='$linkedin',image='$image' WHERE email = '$email'";
				$result = mysqli_query($conn,$query);
				move_uploaded_file($_FILES["image"]["tmp_name"], "upload/".$_FILES["image"]["name"]);
				$_SESSION["fname"] = $name;
				$_SESSION["ftype"] = $type;
				$_SESSION["fwebsite"] = $website;
				$_SESSION["fgithub"] = $github;
				$_SESSION["flinkedin"] = $linkedin;
				$_SESSION["fimage"] = $image;
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Congratulations!</strong> <?php echo "Profile Updated Successfully"; ?>
        </div>
        <?php
			}
		?>
    <div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">

  <div class="col-md-8">

    <div class="h2">Edit Profile</div>

    <form action="f_profile_edit.php" method="POST" enctype="multipart/form-data">
      <div class="col-md-4 text-center">
        <img src="" class="js-image img-fluid rounded" style="width: 180px;height:180px;object-fit: cover;">
        <div>
          <div class="mb-3">
            <label for="formFile" class="form-label">Click below to select an image</label>
            <input value="" type="file" name="image" class="form-control">
          </div>

        </div>
      </div>
      <?php
          $username = $_SESSION['femail'];
          $sql = "SELECT * FROM f_users WHERE email = '$email'";
          $run = mysqli_query($conn,$sql);
          foreach ($run as $row) {
       ?>

      <table class="table table-hover">
        <tr><th colspan="2">User Details:</th></tr>

        <tr><th><i class="bi bi-person-circle"></i> Full Name</th>
          <td>
            <input value="<?php echo $row['name'] ?>" type="text" name="name" class="form-control" placeholder="Enter name">
          </td>
        </tr>
        <tr><th><i class="bi bi-gender-ambiguous"></i> Type</th>
          <td>
            <select value="<?php echo $row['type'] ?>" name="type" class="form-select form-select mb-3" aria-label=".form-select-lg example">
              <option value="">Select</option>
              <option value="Professor">Professor</option>
              <option value="Lecturer">Lecturer</option>
            </select>
          </td>
        </tr>

        <tr><th><i class="bi bi-link"></i> Website</th>
          <td>
            <input value="<?php echo $row['website'] ?>" type="text" name="website" class="form-control" placeholder="Enter website link">
          </td>
        </tr>
        <tr><th><i class="bi bi-github"></i> Github</th>
          <td>
            <input value="<?php echo $row['github'] ?>" type="text" name="github" class="form-control" placeholder="Enter github link">
          </td>
        </tr>
        <tr><th><i class="bi bi-linkedin"></i> Linkedin</th>
          <td>
            <input value="<?php echo $row['linkedin'] ?>" type="text" name="linkedin" class="form-control" placeholder="Enter linkedin link">
          </td>
        </tr>

      </table>

      <div class="p-2">

        <button name="save1" type="submit" class="btn btn-primary float-end">Save</button>

        <a href="f_profile.php">
          <label class="btn btn-secondary">Back</label>
        </a>

      </div>
    </form>

  </div>
</div>
<?php } ?>

</body>
</html>
