<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION['userdata'])){
    	echo "<script> location.href='../index.php'; </script>";
		exit();
    }else if(isset($_SESSION['GenLuserdata'])){ 

    	$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - General User</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css">
		.alert {
			width: 70%;
    		top: 20px;
    		left: 20%;
    		position: absolute;
		}
		body{
			background-image: url("../dist/img/bg.png");
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

	<?php 

		$ID = $_SESSION['GenLid'];

		$Find_Qry = "SELECT * FROM general_user WHERE id = '$ID'";
		$RS = mysqli_query($conn, $Find_Qry);
		if($Dat = mysqli_fetch_assoc($RS)){

	?>

	<div class="container">

		<?php function failed(){ ?>
			<div class="alert alert-danger" style="width: 70%;">Failed to register!! Email or NID already used or try again later...</div>
		<?php } ?>
		<div class="card">
  		<div class="card-body">
		<legend class="mt-5 text-center">Update Your Account info</legend>
		<form method="post" class="mx-auto" style="width: 50%;">
			<div class="mb-3">
				<label class="form-label">Full Name</label>
				<input type="text" class="form-control" name="Name" value="<?php echo $Dat['Name']; ?>" pleaceholder="Please Enter Your Full Name" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Birth Certificate No</label>
				<input type="number" class="form-control" value="<?php echo $Dat['NID']; ?>" pleaceholder="Please Enter Your NID number" disabled>
			</div>
			<div class="mb-3">
				<label class="form-label">Father's Name</label>
				<input type="text" class="form-control" value="<?php echo $Dat['fathersName']; ?>" pleaceholder="Please Enter Your NID number" disabled>
			</div>
			<div class="mb-3">
				<label class="form-label">Mother's Name</label>
				<input type="text" class="form-control" value="<?php echo $Dat['mothersName']; ?>" pleaceholder="Please Enter Your NID number" disabled>
			</div>
			<div class="mb-3">
				<label class="form-label">Phone</label>
				<input type="text" class="form-control" name="Phone" value="<?php echo $Dat['Phone']; ?>" pleaceholder="Please Enter Your Contact number" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Email</label>
				<input type="email" class="form-control" name="Email" value="<?php echo $Dat['Email']; ?>" pleaceholder="Please Enter Your Email" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="password" class="form-control" name="Password">
				<small>[Leave this field empty if you don't want to change your current password]</small>
			</div>
			<div class="mb-3 form-check">
				<input type="radio" class="form-check-input" name="Gender" value="Male" <?php if($Dat['Gender']=="Male") {echo "checked";} ?> required>
				<label class="form-check-label"> Male </label>
			</div>
			<div class="mb-3 form-check">
				<input type="radio" class="form-check-input" name="Gender" value="Female" <?php if($Dat['Gender']=="Female") {echo "checked";} ?>>
				<label class="form-check-label"> Female </label>
			</div>
			<div class="mb-3 form-check">
				<input type="radio" class="form-check-input" name="Gender" value="Other" <?php if($Dat['Gender']=="Other") {echo "checked";} ?>>
				<label class="form-check-label"> Other </label>
			</div>
			<div class="mb-3">
				<label class="form-label">Date of Birth</label>
				<input type="date" class="form-control" name="DOB" pleaceholder="yyyy-mm-dd" value="<?php echo $Dat['DOB']; ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Address</label>
				<input type="text" class="form-control" name="address"  value="<?php echo $Dat['address']; ?>" required>
			</div>
			<input type="submit" class="btn btn-warning mt-3 mb-4" name="Update" value="Update">
			<a href="Dashboard.php" class="btn btn-info mt-3 mb-4 float-end">Dashboard</a>
		</form>

	<?php } ?>

	</div>
	</div>
	</div>
	<?php 

		if(isset($_POST['Update'])){

			$email = $_POST['Email'];
			$Phone = $_POST['Phone'];
			$Name = $_POST['Name'];
			$Gender = $_POST['Gender'];
			$DOB = $_POST['DOB'];

			if(isset($_POST['Password'])){
				$pass = md5($_POST['Password']);
				$Pass_qry = " Pass = '$pass', ";
			}else{
				$Pass_qry = " ";
			}

			$Reg_qry = "UPDATE general_user SET Name = '$Name', Email = '$email',".$Pass_qry ."Phone = '$Phone', Gender = '$Gender', DOB = '$DOB' WHERE id = '$ID'"; 
			
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


<?php 

    }else{
    	echo "<script> location.href='../index.php'; </script>";
		exit();
    }
}else{ 
	echo "<script> location.href='../index.php'; </script>";
	exit();
}

?>