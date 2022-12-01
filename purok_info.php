<?php include 'server/server.php' ?>
<?php
    $state = $_GET['state'];
    $purok = array();

    if($state=='purok'){
        $query = "SELECT * FROM tblpurok ORDER BY `name`";
        $result = $conn->query($query);

        while($row = $result->fetch_assoc()){
            $purok[] = $row; 
        }
    }else{
        $query = "SELECT * FROM tblprecinct";
        $result = $conn->query($query);

        while($row = $result->fetch_assoc()){
            $purok[] = $row; 
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Purok -  Barangay Management System</title>
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
								<h2 class="text-white fw-bold"><?= $state=='purok' ? 'Purok' : 'Precint' ?></h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-9">
                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title"><?= $state=='purok' ? 'Purok Information' : 'Precint Information' ?></div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><?= $state=='purok' ? 'Purok No.' : 'Precint No.' ?></th>
                                                    <th scope="col">Populations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Purok 1</td>
                                                    <td><?php
                                                     $querys1 = "SELECT * FROM tblresident where purok = 'Purok 1' ";
                                                     $results1 = $conn->query($querys1);
                                                     $queryResults1=mysqli_num_rows($results1);
                                                     echo $queryResults1; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Purok 2</td>
                                                    <td><?php
                                                     $querys2 = "SELECT * FROM tblresident where purok = 'Purok 2' ";
                                                     $results2 = $conn->query($querys2);
                                                     $queryResults2=mysqli_num_rows($results2);
                                                     echo $queryResults2; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Purok 3</td>
                                                    <td><?php
                                                     $querys3 = "SELECT * FROM tblresident where purok = 'Purok 3' ";
                                                     $results3 = $conn->query($querys3);
                                                     $queryResults3=mysqli_num_rows($results3);
                                                     echo $queryResults3; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Purok 4</td>
                                                    <td><?php
                                                     $querys4 = "SELECT * FROM tblresident where purok = 'Purok 4' ";
                                                     $results4 = $conn->query($querys4);
                                                     $queryResults4=mysqli_num_rows($results4);
                                                     echo $queryResults4; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Purok 5</td>
                                                    <td><?php
                                                     $querys5 = "SELECT * FROM tblresident where purok = 'Purok 5' ";
                                                     $results5 = $conn->query($querys5);
                                                     $queryResults5=mysqli_num_rows($results5);
                                                     echo $queryResults5; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Purok 6</td>
                                                    <td><?php
                                                     $querys6 = "SELECT * FROM tblresident where purok = 'Purok 6' ";
                                                     $results6 = $conn->query($querys6);
                                                     $queryResults6=mysqli_num_rows($results6);
                                                     echo $queryResults6; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Purok 7</td>
                                                    <td><?php
                                                     $querys7 = "SELECT * FROM tblresident where purok = 'Purok 7' ";
                                                     $results7 = $conn->query($querys7);
                                                     $queryResults7=mysqli_num_rows($results7);
                                                     echo $queryResults7; ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th scope="col"><?= $state=='purok' ? 'Purok No.' : 'Precint No.' ?></th>
                                                    <th scope="col">Populations</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
                            <div class="card card-stats card-round" style="<?= $state=='purok' ? 'background-color:#880a14; color:#fff' : 'background-color:#a349a3; color:#fff' ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-fingerprint"></i>
                                                </div>
                                            </div>
                                            <div class="col-3 col-stats">
                                            </div>
                                            <div class="col-6 col-stats ">
                                                <div class="numbers">
                                                    <p class="card-category text-light"><?= $state=='purok' ? 'Total Purok' : 'Total Precint' ?></p>
                                                    <h4 class="card-title text-light"><?= number_format(count($purok)) ?></h4>
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
</body>
</html>