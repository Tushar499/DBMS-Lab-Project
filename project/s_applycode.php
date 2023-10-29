<?php
session_start();
if(isset($_POST['apply'])){
          require_once "database.php";
          $id = $_POST['id'];
          $cgpa = $_POST['cgpa'];
          $c_credit = $_POST['c_credit'];
          $grade = $_POST['grade'];
          $coursename = $_POST['coursename'];
          $courseid = $_POST['courseid'];
          $time1 = $_POST['time1'];
          $time2 = $_POST['time2'];
          $department = "";$trimester = "";$type = "";
          $name = $_SESSION['sname'];
          $studentid = $_SESSION['sstudentid'];
          $recommendation = "No recommendation";
          $associated = "Pending";
          $sql = "SELECT * FROM a_recruitment WHERE id = '$id'";
          $sql_run = mysqli_query($conn,$sql);
          foreach ($sql_run as $row) {
            $department = $row['department'];
            $trimester = $row['trimester'];
            $type = $row['title'];
          }
          $ok = "SELECT * FROM s_application WHERE name = '$name' && studentid = '$studentid' && cgpa = '$cgpa' && c_credit = '$c_credit' && grade = '$grade'
          && coursename = '$coursename' && courseid = '$courseid' && time1 = '$time1' && time2 = '$time2' && department = '$department' && recommendation = '$recommendation'
          && type = '$type' && trimester = '$trimester' && associated = '$associated'";
          $ok_run = mysqli_query($conn,$ok);
          $temp = "";
          foreach ($ok_run as $raw) {
             $temp = $raw['studentid'];
          }
          if(empty($cgpa) OR empty($c_credit) OR empty($grade) OR empty($coursename) OR empty($courseid) OR empty($time1)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>All Fields Are Required!</strong>
            </div>
            <?php
          }else if($temp != ""){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Applications Already Exists!</strong>
            </div>
            <?php
          }else{
             $query = "INSERT INTO s_application(name,studentid,cgpa,c_credit,grade,coursename,courseid,time1,time2,department,recommendation,type,trimester,associated)
             VALUES('$name','$studentid','$cgpa','$c_credit','$grade','$coursename','$courseid','$time1','$time2','$department',
               '$recommendation','$type','$trimester','$associated')";
             $query_run = mysqli_query($conn,$query);
             ?>
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong>Applied Successfully</strong>
             </div>
             <?php
          }
        }
 ?>
