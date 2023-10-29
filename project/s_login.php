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
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $studentid = $_POST["studentid"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM s_users WHERE studentid = '$studentid'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["suser"] = "success";
                    $_SESSION["sname"] = $user["name"];
                    $_SESSION["semail"] = $user["email"];
                    $_SESSION["sstudentid"] = $user["studentid"];
                    $_SESSION["swebsite"] = $user["website"];
                    $_SESSION["sgithub"] = $user["github"];
                    $_SESSION["slinkedin"] = $user["linkedin"];
                    $_SESSION["simage"] = $user["image"];
                    $_SESSION["sfacebook"] = $user["facebook"];
                    $_SESSION["sgender"] = $user["gender"];
                    $_SESSION["scgpa"] = $user["cgpa"];
                    $_SESSION["sc_credit"] = $user["c_credit"];
                    $_SESSION["sdepartment"] = $user["department"];
                    $_SESSION['tmp_sid'] = "";
                    $_SESSION['sp_tmp_courseid'] = "";
                    $_SESSION['sp_tmp_type'] = "";
                    $_SESSION['gsearch'] = "";
                    $_SESSION['gview'] = 0;
                    $_SESSION['sfsearch'] = "";
                    $_SESSION['sleaderid'] = "";
                    $_SESSION['s_psearch'] = "";
                    header('Location: s_home.php');
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Student ID does not match</div>";
            }
        }
        ?>
      <form action="s_login.php" method="post">
        <div class="form-group">
            <input type="number" placeholder="Enter Student ID" name="studentid" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
     <div><p>Not registered yet <a href="s_signup.php">Register Here</a></p></div>
    </div>
</body>
</html>
