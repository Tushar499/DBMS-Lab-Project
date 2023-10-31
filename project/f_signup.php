<?php
    session_start();
    if(isset($_SESSION['fuser'])){
      header('Location: f_home.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $name = $_POST["name"];
           $type = $_POST["type"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $_SESSION["n"] = $name;
           $_SESSION["t"] = $type;
           $_SESSION["p"] = $password;
           $_SESSION["femail"] = $email;
           $errors = array();
           if(empty($type) OR empty($name) OR empty($email) OR empty($password)) {
            array_push($errors,"All fields are required");
           }
           require_once "database.php";
           $sql = "SELECT * FROM f_users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"User already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            header("Location: f_otpverify.php");
           }
        }
        ?>
        <form action="f_signup.php" method="post"> 
          <div class="form-group">
              <input type="text" class="form-control" name="name" placeholder="Full Name">
          </div>
          <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email">
          </div>
            <div class="form-control">
              <select value="<?php echo $row['type'] ?>" name="type" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                <option value="">Select</option>
                <option value="Professor">Professor</option>
                <option value="Lecturer">Lecturer</option>
              </select>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p>Already Registered <a href="f_login.php">Login Here</a></p></div>
      </div>
    </div>
</body>
</html>
