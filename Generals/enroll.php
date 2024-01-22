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
	<title>Register for Vaccination</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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

	<div class="container">

		<?php function failed($Msg){ ?>
			<div class="alert alert-danger" style="width: 70%;"><?php echo $Msg; ?></div>
		<?php } ?>
		<?php function success(){ ?>
			<div class="alert alert-success" style="width: 70%;">Registration completed!</div>
		<?php } ?>
		<div class="card">
  		<div class="card-body">
		<legend class="mt-5 text-center headLine">Register for a vaccine process</legend>
		<form method="post" class="mx-auto" style="width: 50%;">
			<div class="mb-3">
				<label class="form-label">First Name *</label>
				<input type="text" class="form-control" name="FirstName" pleaceholder="Please Enter Your First Name" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Middle Name</label>
				<input type="text" class="form-control" name="MiddleName" pleaceholder="Please Enter Your Middle Name">
			</div>
			<div class="mb-3">
				<label class="form-label">Last Name</label>
				<input type="text" class="form-control" name="LastName" pleaceholder="Please Enter Your Last Name" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Current Address</label>
				<input type="text" class="form-control" name="Address" pleaceholder="Please Enter Your Current Address" required>
				<small style="font-size: 11px;">[This is the address from where you want to receive vaccine. Mention the City/Village correctly. Mention your Ward number too. ex- Ward: 33, Townhall, Mohammadpur, Dhaka]</small>
			</div>
			<div class="mb-3">
				<label class="form-label">Vaccine Category</label>
				<select class="form-control" name="type">

				<?php 

				$Qry = "SELECT distinct(Category) FROM vaccine_list";
				$RS = mysqli_query($conn, $Qry);
				while($Dat = mysqli_fetch_assoc($RS)){

					echo "<option>".$Dat['Category']."</option>";

				}

				?>

				</select>

				<small style="font-size: 11px;">[Please select which vaccine you want to have. You can't choose the name of vaccine you'll get the available one, just select the purpose or antibody you want.]</small>
			</div>

			<input type="submit" class="btn btn-primary mt-3 mb-4" name="Enroll" value="Registration">
			<a href="Dashboard.php" class="btn btn-info mt-3 mb-4 float-end">Dashboard</a>
		</form>

	</div>
	</div>
	</div>

	<?php 

		if(isset($_POST['Enroll'])){

			$ID = $_SESSION['GenLid'];

			$tracking = date("dmy").date("His").rand(1111, 9999);
			$Status = '0';
			$Date = date("d/m/y");

			$Type = $_POST['type'];
			$DOB = $_SESSION['GenLDOB'];
			$Gender = $_SESSION['GenLGen'];
			$Contact = $_SESSION['GenLPhn'];

			$Fname = $_POST['FirstName'];
			$Lname = $_POST['LastName'];
			if(isset($_POST['MiddleName'])){
				$Mname = $_POST['MiddleName'];
			}else{
				$Mname = '';
			}
			$Address = $_POST['Address'];

			$Find_qry = "SELECT * FROM individual_list WHERE id = '$ID'";
			$RS = mysqli_query($conn, $Find_qry);
			if($Find_RS = mysqli_fetch_assoc($RS)){
				if($Find_RS['status'] != 999){
					failed("Failed to register!! You are already under a vaccine process. Please complete it first...");
				}else if($Find_RS['status'] == 999){
					$Update_qry = "UPDATE individual_list SET tracking_code = '$tracking', Vaccine_type = '$Type', firstname = '$Fname',  middlename = '$Mname', lastname = '$Lname', gender = '$Gender', dob = '$DOB', contact = '$Contact', address = '$Address', status = '$Status', date_created = '$Date', date_updated = '$Date' WHERE id = '$ID'";
				}
			}else{

				$Run_qry = "INSERT INTO individual_list(id, tracking_code, Vaccine_type, firstname, middlename, lastname, gender, dob, contact, address, status, date_created, date_updated) VALUES ('$ID', '$tracking', '$Type', '$Fname', '$Mname', '$Lname', '$Gender', '$DOB', '$Contact', '$Address', '$Status', '$Date', '$Date')";
				if(mysqli_query($conn, $Run_qry)){
					success();
				}else{
					failed("Failed to register!! Please try again later...");
				}
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