<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblpermit WHERE id='$id'";
    $result = $conn->query($query);
    $permit = $result->fetch_assoc();

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Captain'";
    $captain = $conn->query($c)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Business Permit -  Barangay Management System</title>
    <style>
        @page  
        { 
            size: auto;   /* auto is the initial value */ 

            /* this affects the margin in the printer settings */ 
            margin: 5mm 5mm 5mm 5mm;  
        }
        .card-body{
            background: rgb(183,161,81);
            border: 10px solid rgb(183,161,81);
            height: 99%;
        }
        .text-center{
            color: black;
        }
        .d-flex{
            background: white !important;
            border: 10px solid white;
        }
        .card-body h1,.card-body h2,.card-body h3,.card-body h4,.card-body h5,.card-body h6,.card-body p{
            font-family: "Times New Roman", Times, serif !important;
        }
        .years{
            border-bottom: 18px solid royalblue;
            border-top: 18px solid royalblue;
            margin-top: -10px;
        }
        .years h1{
            text-align: center;
            font-size: 50px;
            font-weight: bolder;
            color: black;
            padding-top: 7px;
        }
        .rows{
            display: flex;
            margin-top: 20px;
        }
        .left{
            width: 30%;
            background: rgb(254, 207, 64);
        }
        .left h3{
            text-align: center;
            color: black;
            font-weight: bolder;
            font-size: 20px;
        }
        .left p{
            text-align: center;
            color: black;
            font-weight: bolder;
            padding: 0;
            margin-top: -10px;
            font-size: 16.5px;
        }
        .left h4{
            text-align: center;
            font-size: 20px;
            color: black;
            font-weight: bolder;
            margin-top: 16px;
        }
        .space{
            height: 10px;
        }
        .right{
            width: 69%;
            margin-left: 1%;
            background: white;
        }
        .right h2{
            text-align: center;
            color: black;
            font-weight: bolder;
            margin-top: -30px;
        }
        .right h3{
            text-align: center;
            font-weight: bold;
            color: black;
            margin-top: -10px;
            font-size: 20px;
        }
        .right h4{
            text-align: right;
            margin-right: 10px;
            color: black;
            margin-top: 10px;
            font-weight: bold;
            font-size: 20px;
        }
        .right h5{
            font-size: 32px;
            margin-top: 100px;
            text-align: center;
            font-weight: bolder;
            color: black;
        }
        .end{
            margin-top: 100px;
            float: right;
            margin-right: 40px;
        }
        .end h3{
            text-align: left;
            font-weight: bold;
            margin-top: 20px;
            font-size: 20px;
        }
        .end h4{
            text-align: center;
            font-weight: bold;
            font-size: 20px;
        }
        .end p{
            text-align: center;
            margin-top: -10px;
            font-weight: bold;
        }
        .h1{
            font-size: 50px;
            color: black;
            font-weight: bolder;
            text-align: center;
            font-family: arial;
            margin-top: 10px;
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
						<div class="align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Generate Permit</h2>
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
										<div class="card-title">Barangay Business Permit</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>

                                <div id="printThis">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-around">
                                        <div class="text-center">
                                            <img src="kapitan.png" class="img-fluid" width="150" style="transform: translateX(-20px);">
                                        </div>
                                        <div class="text-center">
                                            <h3 class="mb-0">Republic of the Philippines</h3>
                                            <h3 class="mb-0">MUNICIPALITY OF <?= ucwords($province) ?></h3>
                                            <h3 class="mb-0"><?= ucwords($town) ?></h3>
                                            <h3>OFFICE OF THE PUNONG BARANGAY</h3>
                                            <h3 class="mb-0">BARANGAY <?= ucwords($brgy) ?></h3>
                                        </div>
                                        <div class="text-center">
                                            <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="170" style="transform: translateX(30px);">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <h1 class="mt-4 fw-bold mb-5" style="margin: 0; padding: 0;font-size: 44px; color:red">BARANGAY BUSINESS CLEARANCE</h1>
                                            </div>
                                            <div class="years"><h1>2021</h1></div>
                                            <div class="rows">
                                            <div class="left">
                                                <div class="space"></div>
                                            <h4>ACHILLES G. ONGOTAN</h4>
                                            <p>Punong Barangay</p>

                                            <h3>BARANGAY OFFICIALS</h3>

                                            <h4>LUIS G. GODOY</h4>
                                            <p>Committee on Agriculture/Livelihood</p>
                                            <h4>SHARON S. GEALONE</h4>
                                            <p>Committee on Beautification</p>
                                            <h4>MARVIN P. GERNALE</h4>
                                            <p>Committee of Peace and Order</p>
                                            <h4>Lanie G. Geranco</h4>
                                            <p>Committee of Appropriation</p>
                                            <h4>JOHN E. DEDASE</h4>
                                            <p>Committee of Sport and Amusement</p>
                                            <h4>ROSALINA S. DEDASE</h4>
                                            <p>Committee of Health and Sanitation</p>
                                            <h4>RAEL E. LEVANTINO</h4>
                                            <p>Committee on Education</p>
                                            <h4>MARK JOSEPH P. GODOY</h4>
                                            <p>SK-CHAIRMAN</p>
                                            <h4>LORDA GRACIA G. GIMENA</h4>
                                            <p>Barangay Secretary</p>
                                            </div>
                                            <div class="right">
                                                <h5><?= ucfirst($permit['name']) ?></h5>
                                                <h2>________________________________</h2>
                                                <h3>Name of Establishment/Business</h3>
                                                <h5><?= empty($permit['owner2']) ? $permit['owner1'] : ucwords($permit['owner1'].' & '.$permit['owner2']) ?></h5>
                                                <h2>________________________________</h2>
                                                <h3>Proprietor</h3>
                                                <h5>Otavi, Bulan Sorsogon</h5>
                                                <h2>________________________________</h2>
                                                <h3>Address</h3>
                                                <div class="end">
                                                   <h3>Certified by:</h3>
                                                   <h4>HON. ACHILLES G. ONGOTAN</h4>
                                                   <p>Punong Barangay</p>
                                               </div>
                                            </div>
                                    </div>
                                    <h1 class="h1">Atamanon ta an Barangay Otavi!</h1>
                                        </div>
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
			<!-- End Main Footer -->
			
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