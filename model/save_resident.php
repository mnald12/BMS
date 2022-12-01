<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	$national_id 		= $conn->real_escape_string($_POST['national']);
	$citizen 		= $conn->real_escape_string($_POST['citizenship']);
	$fname 		= $conn->real_escape_string($_POST['fname']);
	$mname 		= $conn->real_escape_string($_POST['mname']);
    $lname 		= $conn->real_escape_string($_POST['lname']);
	$alias 		= $conn->real_escape_string($_POST['alias']);
    $bplace 	= $conn->real_escape_string($_POST['bplace']);
	$bdate 		= $conn->real_escape_string($_POST['bdate']);
    $age 		= $conn->real_escape_string($_POST['age']);
    $cstatus 	= $conn->real_escape_string($_POST['cstatus']);
	$gender 	= $conn->real_escape_string($_POST['gender']);
    $purok 		= $conn->real_escape_string($_POST['purok']);
	$vstatus 	= $conn->real_escape_string($_POST['vstatus']);
    $indetity 	= $conn->real_escape_string($_POST['indetity']);
    $email 	    = $conn->real_escape_string($_POST['email']);
	$number 	= $conn->real_escape_string($_POST['number']);
	$occupation 	= $conn->real_escape_string($_POST['occupation']);
    $address 	= "Otavi Bulan, Sorsogon";
	$profile 	= $conn->real_escape_string($_POST['profileimg']); // base 64 image
	$profile2 	= $_FILES['img']['name'];

	//load the ar library
    include 'phpqrcode1/qrlib.php';

    //data to be stored in qr
    $qrName = " ".$fname." ".$mname." ".$lname." ".$bdate." ";

    $text = " ".$fname." ".$mname." ".$lname." ".$bdate." ";
  
    //file path
    $file = "phpqrcode1/qrfiles/".$qrName.".png";
      
    //other parameters
    $ecc = 'H';
    $pixel_size = 8;
    $frame_size = 4;
 
    // Generates QR Code and Save as PNG
    QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);



	// change profile2 name
	$newName = date('dmYHis').str_replace(" ", "", $profile2);

	  // image file directory
  	$target = "../assets/uploads/resident_profile/".basename($newName);
	$check = "SELECT id FROM tblresident WHERE national_id='$national_id'";
	$nat = $conn->query($check)->num_rows;	

	if($nat == 0){
		if(!empty($fname)){

			if(!empty($profile) && !empty($profile2)){

				$query = "INSERT INTO tblresident (`national_id`,citizenship,`picture`, `firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `identified_as`, `phone`, `email`, occupation, `address`, qr_file) 
							VALUES ('$national_id','$citizen','$profile','$fname','$mname','$lname','$alias','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$indetity','$number','$email','$occupation','$address', '$qrName')";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';

					$checks = "SELECT id FROM tblresident WHERE national_id='$national_id'";
					$_SESSION['qrId'] = $checks;
				}
			}else if(!empty($profile) && empty($profile2)){

				$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`, `firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `identified_as`, `phone`, `email`,occupation, `address`, qr_file) 
							VALUES ('$national_id','$citizen','$profile','$fname','$mname','$lname','$alias','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$indetity','$number','$email','$occupation','$address', '$qrName')";

				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';

					$checks = "SELECT id FROM tblresident WHERE national_id='$national_id'";
					$_SESSION['qrId'] = $checks;
				}

			}else if(empty($profile) && !empty($profile2)){

				$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`, `firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `identified_as`, `phone`, `email`, occupation, `address`, qr_file) 
							VALUES ('$national_id','$citizen','$newName','$fname','$mname','$lname','$alias','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$indetity','$number','$email','$occupation','$address', '$qrName')";
				if($conn->query($query) === true){

					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';

					if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){

						$_SESSION['message'] = 'Resident Information has been saved!';
						$_SESSION['success'] = 'success';

						$checks = "SELECT id FROM tblresident WHERE national_id='$national_id'";
					    $_SESSION['qrId'] = $checks;
					}
				}

			}else{
				$query = "INSERT INTO tblresident (`national_id`, citizenship, `picture`,`firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, age, `civilstatus`, `gender`, `purok`, `voterstatus`, `identified_as`, `phone`, `email`, occupation, `address`, qr_file) 
							VALUES ('$national_id','$citizen','person.png','$fname','$mname','$lname','$alias','$bplace','$bdate',$age,'$cstatus','$gender','$purok','$vstatus','$indetity','$number','$email','$occupation','$address', '$qrName')";

				if($conn->query($query) === true){
					$ress="SELECT id FROM tblresident WHERE national_id='$national_id'";
					$_SESSION['message'] = 'Resident Information has been saved!';
					$_SESSION['success'] = 'success';
				}
			}

		}else{

			$_SESSION['message'] = 'Please complete the form!';
			$_SESSION['success'] = 'danger';
		}
	}else{
		$_SESSION['message'] = 'National ID is already taken. Please enter a unique national ID!';
		$_SESSION['success'] = 'danger';
	}

    $res="SELECT id FROM tblresident WHERE national_id='$national_id'";
    $result=mysqli_query($conn, $res);
    $rows=mysqli_fetch_assoc($result);

    header("Location: ../resident.php?id=".$rows['id']." ");

	$conn->close();

