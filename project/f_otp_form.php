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
    } else{
        require_once "database.php";
        $name = $_SESSION["n"];
        $email = $_SESSION["femail"];
        $type = $_SESSION["t"];
        $password = $_SESSION["p"];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO f_users (name, type, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        if ($prepareStmt){
            mysqli_stmt_bind_param($stmt,"ssss",$name, $type, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            $_SESSION["fuser"] = "success";
            $_SESSION["fname"] = $name;
            $_SESSION["ftype"] = $type;
            $_SESSION["femail"] = $email;
            $_SESSION["fwebsite"] = "";
            $_SESSION["flinkedin"] = "";
            $_SESSION["fgithub"] = "";
            $_SESSION["fimage"] = "";
            $_SESSION['f_postid'] = "";
        }else{
            die("Incorrect Information!");
        }
        header('Location: f_login.php');
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