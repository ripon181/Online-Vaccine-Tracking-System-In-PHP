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
			background-image: url("../dist/img/bg.png");
			
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
				<label class="form-label">Child’s Name</label>
				<input type="text" class="form-control" name="Name" pleaceholder="Please Enter Your Full Name" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Birth Certificate No</label>
				<input type="number" class="form-control" name="NID" pleaceholder="Please Enter Your NID number" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Father’s Name </label>
				<input type="text" class="form-control" name="fathersName" pleaceholder="Please Enter Your Full Name" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Mother’s Name</label>
				<input type="text" class="form-control" name="mothersName" pleaceholder="Please Enter Your Full Name" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Mobile Number</label>
				<input type="text" class="form-control" name="Phone" pleaceholder="Please Enter Your Contact number" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Email</label>
				<input type="email" class="form-control" name="Email" pleaceholder="Please Enter Your Email" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="password" class="form-control" name="Password" pleaceholder="Please Enter Your Password" required>
			</div>
			<div class="mb-3 form-check">
				<input type="radio" class="form-check-input" name="Gender" value="Male" required>
				<label class="form-check-label"> Male </label>
			</div>
			<div class="mb-3 form-check">
				<input type="radio" class="form-check-input" name="Gender" value="Female">
				<label class="form-check-label"> Female </label>
			</div>
			<div class="mb-3 form-check">
				<input type="radio" class="form-check-input" name="Gender" value="Other">
				<label class="form-check-label"> Other </label>
			</div>
			<div class="mb-3">
				<label class="form-label">Date of Birth</label>
				<input type="date" class="form-control" name="DOB" pleaceholder="yyyy-mm-dd" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Address</label>
				<input type="text" class="form-control" name="address" pleaceholder="Please Enter Your Full Name" required>
			</div>
			<input type="submit" class="btn btn-primary w-100" name="Register" value="REGISTER">
		</form>

	</div>
	</div>
</div>

	<?php 

		if(isset($_POST['Register'])){

			$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');

			$email = $_POST['Email'];
			$pass = md5($_POST['Password']);
			$Phone = $_POST['Phone'];
			$Name = $_POST['Name'];
			$NID = $_POST['NID'];
			$Gender = $_POST['Gender'];
			$DOB = $_POST['DOB'];
			$fathersName = $_POST['fathersName'];
			$mothersName = $_POST['mothersName'];
			$address = $_POST['address'];

			$Reg_qry = "INSERT INTO general_user(Name, Email, Pass, NID, Phone, Gender, DOB, mothersName, fathersName, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $Reg_qry);
mysqli_stmt_bind_param($stmt, "ssssssssss", $Name, $email, $pass, $NID, $Phone, $Gender, $DOB, $mothersName, $fathersName, $address);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
} else {
    failed();
}

mysqli_stmt_close($stmt);

		}

	?>

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>