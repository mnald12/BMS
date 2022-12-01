<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblresident WHERE id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Generate Resident Profile -  Barangay Management System</title>
    <style type="text/css">
        .rows{
            display: flex;
            width: 100%;
            font-family: Times;
        }
        .left{
            width: 49%;
        }
        .right{
            width: 49%;
            margin-left: 1%;
            display: flex;
            border: 1px solid black;
            margin-top: 3px;
        }
        .front{
            background: darkblue;
            border-bottom: 20px solid darkblue;
        }
        .heads{
            text-align: center;
            background-image: url(otavi.png);
            background-repeat: no-repeat;
            background-size: 100px;
            background-position: 10px 10px;
            width: 100%;
        }
        .heads h2{
            color: whitesmoke;
            font-size: 13.5px;
            font-weight: 600;
            margin: 0;
        }
        .heads h3{
            color: whitesmoke;
            font-size: 13px;
            font-weight: 600;
            margin: 3px;
        }
        .heads h1{
            font-size: 20px;
            color: darkred;
            font-weight: 800;
        }
        .bodys{
            background: white;
            width: 100%;
            padding: 3px;
            height: 250px;
            display: flex;
        }
        .bodys .left1{
            width: 40%;
        }
        .bodys .left1 .box{
            width: 90%;
            height: 50%;
            margin: 30px 5%;
            border: 1px solid black;
        }
        .box img{
            width: 98%;
            height: 98%;
            margin: 1%;
        }
        .bodys .left1 h3{
            margin-left: 20px;
            font-size: 14px;
        }
        .bodys .right1{
            width: 60%;
            background-image: url(otavi.png);
            background-repeat: no-repeat;
            background-size: 120px;
            background-position: center;
            text-align: center;
            background-color: white;
        }
        .bodys .right1 h3{
            font-size: 15px;
            font-weight: 500;
            margin-top: 50px;
        }
        .bodys .right1 h4{
            font-size: 15px;
            font-weight: 500;
            margin-top: -5px;
        }
        .bodys .right1 p{
            font-size: 15px;
            font-weight: 500;
        }
        .bodys .right1 h5{
            font-size: 15px;
            font-weight: 500;
        }
        .left2{
            width: 50%;
            margin-top: 10px;
        }
        .left2 h3{
            font-size: 13px;
            padding: 0 10px;
        }
        .right2{
            width: 50%;
            margin-top: 10px;
        }
        .right2 h3{
            font-size: 13px;
        }
        .box2{
            border: 2px solid black;
            width: 96%;
            margin: 30px 2%;
        }
        .box2 h4{
            font-size: 14px;
            font-weight: 500;
            text-align: center;
        }
        .right2 .box3{
            height: 160px;
            width: 90%;
            margin: 32px 5%;
            border: 1px solid black;
        }
        .cap{
            border: 1px solid black;
            padding-top: 6px;
            margin: 10px;
            transform: translateX(-50%);
        }
        .cap h2{
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            margin: 0;
        }
        .box3 img{
            width: 98%;
            height: 98%;
            margin: 1%;
        }
        @media print{
            .front{
            background: darkblue !important;
            border-bottom: 20px solid darkblue !important;
        }
        .heads{
            text-align: center;
            background-image: url(otavi.png) !important;
            background-repeat: no-repeat !important;
            background-size: 100px !important;
            background-position: 10px 10px !important;
            width: 100% !important;
        }
        .bodys .right1{
            width: 60% !important;
            background-image: url(otavi.png) !important;
            background-repeat: no-repeat !important;
            background-size: 120px !important;
            background-position: center !important;
            text-align: center !important;
            background-color: white !important;
        }
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
								<h2 class="text-white fw-bold">Generate Resident Profile</h2>
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
                                        <div class="card-title">Resident Profile</div>
                                        <div class="card-tools">
                                            <button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
                                                <i class="fa fa-print"></i>
                                                Print Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body m-5" id="printThis">
                                    <div class="rows">
                                        <div class="left">
                                            <div class="front">
                                                <div class="heads">
                                                    <h3 style="padding-top: 10px;">Republic of the Phillipines</h3>
                                                    <h2>MUNICIPALITY OF BULAN</h2>
                                                    <h3>Province of Sorsogon</h3>
                                                    <h2>BARANGAY OTAVI</h2>
                                                    <h1>RESIDENCE IDENTIFICATION</h1>
                                                </div>
                                                <div class="bodys">
                                                    <div class="left1">
                                                        <div class="box">
                                                            <img src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/'.$resident['picture'] ?>" alt="Resident Profile" class="img-fluid">
                                                        </div>
                                                        <h3>I.D No. ______________</h3>
                                                    </div>
                                                    <div class="right1">
                                                        <h3 style="transform: translateY(40px);">The cardholder is a bonifide</h3>
                                                        <h4 style="transform: translateY(40px);">Residence of BARANGAY OTAVI</h4>
                                                        <p style="transform: translateY(85px);"><u><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></u></p>
                                                        <h5 style="transform: translateY(60px);">Name</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="left2">
                                                <h3>Tin.______________________________</h3>
                                                <h3>Date of Birth. <u><?= ucwords($resident['birthdate']) ?></u></h3>
                                                <h3>Address. <u><?= ucwords($resident['address']) ?></u></h3>
                                                <h3>Tel No.__________________________</h3>
                                                <div class="box2">
                                                    <h4>INCASE OF EMERGENCY PLEASE NOTIFY</h4>
                                                    <h3>Name._________________________</h3>
                                                    <h3>Address. <u><?= ucwords($resident['address']) ?></u></h3>
                                                    <h3>Tel No._________________________</h3>
                                                </div>

                                            </div>
                                            <div class="right2">
                                                <h3>Weight.__________________________</h3>
                                                <h3>Height.___________________________</h3>
                                                <h3>Blood Type.______________________</h3>
                                                <div class="box3"><img src="<?= preg_match('/data:image/i', $resident['qr_file']) ? $resident['qr_file'] : 'model/phpqrcode1/qrfiles/'.$resident['qr_file'] ?>.png" alt="Resident Profile" class="img-fluid"></div>
                                                <h3 style="text-align: center; margin: 0; transform: translateY(-20px);">QR Code</h3>
                                                <div class="cap">
                                                    <h2>ACHILLES ONGOTAN</h2>
                                                    <h3 style="text-align: center; transform: translateY(-3px);">Punong Barangay</h3>
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