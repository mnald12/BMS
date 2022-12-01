<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblresident WHERE id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position NOT IN ('SK Chairrman','Secretary','Treasurer')
                AND `status`='Active' ORDER BY `order` ASC";
    $result1 = $conn->query($query1);
    $officials = array();
	while($row = $result1->fetch_assoc()){
		$officials[] = $row; 
	}

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Captain'";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Secretary'";
    $sec = $conn->query($s)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Certificate of Indigency -  Barangay Management System</title>
    <style>
       @page  
        { 
            size: auto;   /* auto is the initial value */ 

            /* this affects the margin in the printer settings */ 
            margin: 5mm 5mm 5mm 5mm;  
        }
        .card-body h1,.card-body h2,.card-body h3,.card-body h4,.card-body h5,.card-body h6,.card-body p{
        	margin-left: 20px;
        	padding: 10px;
        }
        @media print{
            .row{
                display: flex;
            }
            .col-md-6{
            	width:  50%;
            }
            .col-md-3{
            	width: 25%;
            }
            .col-md-3 img{
            	margin: 0 auto;
            	width: 90%;
            }
            .heads{
            	width: 50%;
            }
            .print{
            	background: white !important;
            	height: 90% !important;
            }
        }
        .card-body{
        	background: white !important;
        }
    </style>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Generate Certificate</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Certificate of Indigency</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div id="printThis">
								<div class="card-body print">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="assets/uploads/<?= $city_logo ?>" style="width: 180px; transform: translateY(-10px); margin-left: 40px;" />
                                        </div>
										<div class="col-md-6 heads" style="text-align: center;">
                                            <h3 class="mb-0" style="padding: 0; margin: 0;">Republic of the Philippines</h3>
                                            <h3 class="mb-0" style="padding: 0; margin: 0;">MUNICIPALITY OF <?= ucwords($province) ?></h3>
											<h3 class="mb-0" style="padding: 0; margin: 0;"><?= ucwords($town) ?></h3>
                                            <h2>OFFICE OF THE PUNONG BARANGAY</h2>
											<h2 class="fw-bold mb-0">BARANGAY <?= ucwords($brgy) ?></h2>
										</div>
                                        <div class="col-md-3">
                                            <img src="assets/uploads/<?= $brgy_logo ?>" style="width: 180px;" />
                                        </div>
									</div>
									<h1 style="font-weight: bolder; text-align: center; font-size: 30px; margin-top: 40px;">OFFICE OF THE PUNONG BARANGAY</h1>
									<div style="height: 3px; width: 90%; margin-left: 5%; margin-top: 20px; background: black;"></div>
									<h1 style="font-weight: bolder; text-align: center; font-size: 30px; margin-top: 70px;">CERTIFICATE OF INDIGENCY</h1>
									<h2 style="text-indent: 50px;font-size: 28px; margin-top: 80px;">TO WHOM IT MAY CONCERN:</h2>
									<h3 style="text-indent: 100px; margin-top: 70px; margin-left: 20px;">This is to certify that <u><span class="fw-bold" style="font-size:19px"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></span></u>, of legal age, and Bonafede resident </h3> <h3 style="text-indent: 50px;">of Barangay Otavi, Bulan, Sorsogon</h3>
									<h3 style="text-indent: 100px; margin-top: 80px; margin-left: 20px;">This further certifies that the name stated above belongs to indigent family and;</h3>
									<h3 style="text-indent: 60px; margin-top: 20px; margin-left: 20px;">a.) That he/she is a permanent resident of barangay</h3>
									<h3 style="text-indent: 60px; margin-top: 2px; margin-left: 20px;">b.) That he/she has no enough resources nor support from anybody to sustain her/his daily needs.</h3>
									<h3 style="text-indent: 60px; margin-top: 2px; margin-left: 20px;">c.) That he/she is not a pensioner in any government/private in any institutions. This also certifies</h3>
									<h3 style="text-indent: 60px; margin-top: 2px; margin-left: 20px;"> that he/she is need of ________________ assistance.</h3>
									<h3 style="text-indent: 100px; margin-top: 70px; margin-left: 20px;">Done this <u><span class="fw-bold" style="font-size:19px"> <?= date('d') ?><?= date('S') ?> </span></u> day of <u><span class="fw-bold" style="font-size:19px"> <?= date('F') ?> </span></u>, <u><span class="fw-bold" style="font-size:19px"> <?= date('Y') ?> </span></u>at Barangay Otavi, Bulan, Sorsogon.</h3>
									<div class="row flexs">
										<div class="col-md-6  left">
											<h4 style="text-align: center; margin-top: 40px;">LORDA GRACIA A. GIMENA</h4>
											<p style="text-align: center; transform: translateY(-12px);">Barangay Secretary</p>
										</div>
										<div class="col-md-6 right">
											<h4 style="text-align: center; margin-top: 40px;">ACHILLES G. ONGOTAN</h4>
											<p style="text-align: center; transform: translateY(-12px);">Punong Barangay</p>
										</div>
									</div>
								</div>
							</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
    </script>
</body>
</html>