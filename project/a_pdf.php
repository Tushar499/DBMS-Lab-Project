<?php
   require_once "database.php";
   require('fpdf.php');
   if(isset($_POST['pdf'])){
     $select = "SELECT * FROM thesis";
     $result = $conn->query($select);
     $pdf = new FPDF();
     $pdf->AddPage();
     $pdf->SetFont('Arial','B',10);
     $pdf->Cell(50,10,"Supervisor",1,0,'C');
     $pdf->Cell(65,10,"Final Year Design Project",1,0,'C');
     $pdf->Cell(75,10,"Deliverable",1,1,'C');
     $fontSize = 24;
     $tempFontSize = $fontSize;
     while($row = $result->fetch_object()){
       $email = $row->req;
       $title = $row->title;
       $details = $row->details;
       $sql = "SELECT name FROM f_users WHERE email = '$email'";
       $sql_run = mysqli_query($conn,$sql);
       $use = mysqli_fetch_array($sql_run);
       $pdf->Cell(50,10,$use['name'],1,0);
       $pdf->MultiCell(65,5,$title,1);
       $pdf->MultiCell(65,5,$details,1);


       $pdf->Ln();
     }
     $pdf->Output();
   }
 ?>
