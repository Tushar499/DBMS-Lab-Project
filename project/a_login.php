<?php
session_start();
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
           $username = $_POST["username"];
           $password = $_POST["password"];
           if($username == 'admin' && $password == 'admin'){
             $_SESSION["admin"]="success";
             $_SESSION['department'] = "";
             $_SESSION['a_application_department'] = "";
             $_SESSION['a_application_title'] = "";
             $_SESSION['a_search'] = "";
             header('Location: a_home.php');
           }else{
             echo "<div class='alert alert-danger'>information does not match</div>";
           }
        }
        ?>
      <form action="a_login.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="Enter Username" name="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
    </div>
</body>
</html>
