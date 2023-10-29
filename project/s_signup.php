<?php
    session_start();
    if(isset($_SESSION['suser'])){
      header('Location: s_home.php');
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
           $studentid = $_POST["studentid"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $cgpa = $_POST["cgpa"];
           $c_credit = $_POST["c_credit"];
           $department = $_POST["department"];
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();

           if (empty($name) OR empty($email) OR empty($password) OR empty($studentid) OR empty($cgpa) OR empty($department) OR empty($c_credit)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           require_once "database.php";
           $sql = "SELECT * FROM s_users WHERE (email = '$email'||studentid = '$studentid')";
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

            $sql = "INSERT INTO s_users (name, email, studentid, password,cgpa,c_credit,department) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sssssss",$name, $email, $studentid, $passwordHash, $cgpa, $c_credit, $department);
                mysqli_stmt_execute($stmt);
                $_SESSION["suser"] = "success";
                $_SESSION["sname"] = $name;
                $_SESSION["semail"] = $email;
                $_SESSION["sstudentid"] = $studentid;
                $_SESSION["scgpa"] = $cgpa;
                $_SESSION["sc_credit"] = $c_credit;
                $_SESSION["sdepartment"] = $department;
                $_SESSION["sgender"] = "";
                $_SESSION["swebsite"] = "";
                $_SESSION["sfacebook"] = "";
                $_SESSION["sgithub"] = "";
                $_SESSION["simage"] = "";
                $_SESSION["slinkedin"] = "";
                $_SESSION['tmp_sid'] = "";
                $_SESSION['sp_tmp_courseid'] = "";
                $_SESSION['sp_tmp_type'] = "";
                $_SESSION['gsearch'] = "";
                $_SESSION['gview'] = 0;
                $_SESSION['sfsearch'] = "";
                $_SESSION['sleaderid'] = "";
                $_SESSION['s_psearch'] = "";
                header("Location:s_home.php");
            }else{
                die("Incorrect Information!");
            }
           }
        }
        ?>
        <form action="s_signup.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="studentid" placeholder="Student ID">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cgpa" placeholder="CGPA">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="c_credit" placeholder="Completed Credit">
            </div>
            <div>
              <select name="department" class="form-select form-select mb-3" aria-label=".form-select-lg example">
                <option value="">Select Department</option>
                <option value="Computer Science And Engineering">CSE</option>
                <option value="Electrical And Electronics Engineering">EEE</option>
                <option value="Civil Engineering">CE</option>
              </select>

            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p>Already Registered <a href="s_login.php">Login Here</a></p></div>
      </div>
    </div>
</body>
</html>
