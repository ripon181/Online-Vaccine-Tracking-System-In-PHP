<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION['userdata'])){
    	echo "<script> location.href='../index.php'; </script>";
		exit();
    }else if(isset($_SESSION['GenLuserdata'])){ 
    	echo "<script> location.href='Dashboard.php'; </script>";
		exit();
    }

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - General User</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css">
		body{
			background-image: url("../dist/img/hospital-bg.jpg");
            background-size:cover;
			
		}
		.alert {
			width: 70%;
    		top: 20px;
    		left: 20%;
    		position: absolute;
		}
		.card{
			margin-top: 50px;
			background: #002b7936;
		}
		.form-label{
			color:#fff;
		}
		.headLine{
			color:#fff;
		}
	</style>

</head>
<body>

	<div class="container">

		<?php function failed(){ ?>
			<div class="alert alert-danger" style="width: 70%;">Failed to register!! Email or NID already used or try again later...</div>
		<?php } ?>
		<div class="card">
  		<div class="card-body">
		<legend class="mt-5 text-center headLine">Register New Account</legend>
		<form method="post" class="mx-auto" style="width: 50%;">
			<div class="mb-3">
				<label class="form-label">Hospital Name</label>
				<input type="text" class="form-control" name="hospitalName" pleaceholder="Please Enter Hospital Name" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Hospital Username</label>
				<input type="text" class="form-control" name="hospitalUsername" pleaceholder="Please Enter Hospital Username" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="password" class="form-control" name="password" pleaceholder="Please Enter Password" required>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="Register" value="REGISTER">
		</form>

	</div>
	</div>
</div>

	<?php 

		if(isset($_POST['Register'])){

			$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');

			$hospitalName = $_POST['hospitalName'];
            $hospitalUsername = $_POST['hospitalUsername'];
			$password = md5($_POST['password']);

			$Reg_qry = "INSERT INTO hospital(hospitalName, hospitalUsername, password) VALUES ('$hospitalName', '$hospitalUsername', '$password')"; 
			
			if(mysqli_query($conn, $Reg_qry)){
				header("Location: index.php");
			}else{
				failed();
			}

		}

	?>

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>