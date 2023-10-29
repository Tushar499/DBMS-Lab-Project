<?php
    session_start();
    if(!isset($_SESSION['admin'])){
      session_destroy();
      header('Location: a_login.php');
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
      if (isset($_POST["submit"])) {
        $excel = $_FILES['excel']['name'];
        $file = $_FILES["excel"]["tmp_name"];
        if($excel != ""){
            $file_open = fopen($file,"r");
        }
         $title = $_POST["title"];
         $c_credit = $_POST["c_credit"];
         $grade = $_POST["grade"];
         $cgpa = $_POST["cgpa"];
         $trimester = $_POST['trimester'];
         $department = $_POST["department"];
         $deadline = $_POST["deadline"];
         $description = $_POST["description"];
         require_once "database.php";
         $query = "SELECT * FROM a_recruitment WHERE title = '$title' && department = '$department' && trimester = '$trimester'";
         $query_run = mysqli_query($conn,$query);
         $temp = "";
         foreach ($query_run as $row) {
            $temp = $row['title'];
         }
         if($temp != ""){
           ?>
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>Recruitment already exists!!</strong>
           </div>
           <?php
         }else if (empty($title) OR empty($c_credit) OR empty($department) OR empty($deadline) OR empty($description) OR empty($grade) OR empty($cgpa) OR empty($trimester)) {
           ?>
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>All fields are required!</strong>
           </div>
           <?php
         }else{

          $sql = "INSERT INTO a_recruitment (title,cgpa,department,deadline,description,c_credit,grade,trimester,excel) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
          if ($prepareStmt) {
              mysqli_stmt_bind_param($stmt,"sssssssss",$title, $cgpa, $department, $deadline, $description, $c_credit, $grade, $trimester, $excel);
              mysqli_stmt_execute($stmt);
              move_uploaded_file($_FILES["excel"]["tmp_name"], "upload/".$_FILES["excel"]["name"]);
              $assistant = "Pending";
              $recommendation = "No Recommendation";
              if($excel != ""){
                while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
                {
                 $coursename = $csv[0];
                 $courseid = $csv[1];
                 $section = $csv[2];
                 $time = $csv[3];
                 $email = $csv[4];
                 $name = "";
                 $findname = "SELECT name FROM f_users WHERE email = '$email'";
                 $findname_run = mysqli_query($conn,$findname);
                 foreach ($findname_run as $raw) {
                   $name = $raw['name'];
                 }
                 $ok = "INSERT INTO f_request(name,email,coursename,courseid,department,section,type,time,assistant,fromxl,trimester)
                   VALUES('$name','$email','$coursename','$courseid','$department','$section','$title','$time','$assistant','$excel','$trimester')";
                 $ok_run = mysqli_query($conn,$ok);
                }
              }
              ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Recruitment added Successfully</strong>
              </div>
              <?php

              }
         }
      }
      ?>
       <div class="p-2">
         <a href="a_home.php">
           <label class="btn btn-secondary">Back</label>
         </a>
       </div>

		</div>

</body>
</html>
