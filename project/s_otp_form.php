<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>OTP Verification</title>
</head>
<body>
<div class="container">
    <?php
    session_start();
    if (isset($_POST['otp_verify'])) {
    $OTP = $_POST['otp'];
    $otp = $_SESSION['CAP'];
    if ($OTP != $otp) {
        echo "<div class='alert alert-danger'>Invalid OTP!</div>";
    } else {
        require_once "database.php";
        $name = $_SESSION["n"];
        $studentid = $_SESSION["sid"];
        $email = $_SESSION["semail"];
        $password = $_SESSION["p"];
        $cgpa = $_SESSION["cg"];
        $c_credit = $_SESSION["cr"];
        $department = $_SESSION["d"];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
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
        }else{
            die("Incorrect Information!");
        }
        header('Location: s_login.php');
    }
    }
    ?>
    <div class="form-group" style="text-align: center;">
    <form method="post">  
        <div class="form-group">
            <h4>Enter OTP</h4>
        </div>
        <div class="form-group" style="display: flex; justify-content: center; align-items: center;">
            <input type="text" name="otp" id="otp" placeholder="Enter OTP" required data-parsley-type="otp" class="form-control" style="width: 300px;">
        </div>
        <div class="form-btn">
            <input type="submit" id="submit" name="otp_verify" value="Submit" class="btn btn-success">
        </div>
    </form>
</div>

</div>
</body>
</html>