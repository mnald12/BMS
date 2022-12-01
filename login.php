<?php 
	session_start(); 
	if(isset($_SESSION['username'])){
		header('Location: dashboard.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
	<title>Login -  Barangay Management System</title>
	<style type="text/css">
	body{
		display: block !important;
	}
	img{
		width: 140px;
		height: 130px;
	}
	.text-center{
		color: black;
		text-shadow: 2px 2px 8px royalblue;
		font-weight: 900;
		opacity: 0.70;
	}
	input{
		padding-left: 6px !important;
	}
	</style>
</head>
<body>
<div class="login">
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<center><img src="otavi.png"></center>
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                    <?= $_SESSION['message']; ?>
                </div>
            <?php unset($_SESSION['message']); ?>
            <?php endif ?>
			<h2 class="text-center">BARANGAY OTAVI RECORD MANAGEMENT SYSTEM</h2>
			<div class="login-form">
                <form method="POST" action="model/login.php">
				<div class="form-group form-floating-label">
					<label for="username">Username</label>
					<input id="username" name="username" type="text" class="form-control input-border-bottom">
				</div>
				<div class="form-group form-floating-label">
					<label for="password">Password</label>
					<input id="password" name="password" type="password" class="form-control input-border-bottom">
					<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<div class="form-action mb-3">
                    <button type="submit" class="btn btn-primary btn-rounded btn-login">Log In</button>
				</div>
                </form>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</div>
</body>
</html>