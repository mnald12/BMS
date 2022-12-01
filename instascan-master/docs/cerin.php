<?php 
    include "server.php";

    $qr=mysqli_real_escape_string($conn, $_GET['qr']);
    $qrs=array();
    $qrs = explode(" ", $qr);

    $total=count($qrs);

    if($total==6){
        $fname = $qrs[1];
        $mname = $qrs[2];
        $lname = $qrs[3];
        $bdate = $qrs[4];
    }
    else if($total==7){
        $fname = "$qrs[1] $qrs[2]";
        $mname = $qrs[3];
        $lname = $qrs[4];
        $bdate = $qrs[5];
    }
    else{
        echo "<p>Invalid QR</p>";
    }


    $sql = "SELECT * FROM tblresident WHERE firstname = '$fname' and middlename = '$mname' and lastname = '$lname' and birthdate = '$bdate' ";
    $result=mysqli_query($conn, $sql);
    $queryResults=mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);

    header("location: ../../generate_indi_cert.php?id=".$row['id']."");

 ?>