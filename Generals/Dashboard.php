<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION['userdata'])){
    	echo "<script> location.href='../index.php'; </script>";
		exit();
    }else if(isset($_SESSION['GenLuserdata'])){ 

?>

<style type="text/css">
		body{
			background-image: url("../dist/img/bg.png");
			
		}
	
	</style>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome - User</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="card">
  <div class="card-body">
	<div>
	<h2 class="text-light d-flex justify-content-center">Child's Parent Dashboard</h2>
	</div>

	<form method="post" class="mt-3 p-3 d-flex justify-content-center">
		<div class="mb-3 float-start p-2">
			<input type="submit" class="btn btn-primary" name="DoReg" value="Registration">
		</div>
		<div class="mb-3 float-start p-2">
			<input type="submit" class="btn btn-info" name="Update" value="Update Profile">
		</div>
		<div class="mb-3 p-2">
			<input type="submit" class="btn btn-success" name="Status" value="Track Status">
		</div>
		<div class="mb-3 float-start p-2">
            <a href="chat_parent.php" class="btn btn-warning">Chat now</a>
		</div>
		<div class="mb-3 float-start p-2 text-end">
			<a href="Logout.php" class="btn btn-danger"> Logout </a>
		</div>
	</form>
	</div>
</div>
	<?php 

		if(isset($_POST['DoReg'])){

			header("Location: enroll.php");

		 }else if(isset($_POST['Update'])){ 

		 	header("Location: UpdateProfile.php");

		}else if(isset($_POST['Status'])){ 

			header("Location: vaccine_stat.php");

		}

	?>


<footer style="text-align: center;padding: 10px;">
    <p>Developed by Sakib</p>
</footer>
<style>
	.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #00000036;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    margin: 0 auto;
    top: 163px;
    width: 46%;
}
footer {
  position: absolute;
  bottom: 0;
  width: 100%;   
  background-color: #00000036;    
  color: #fff; 
  font-weight: 700;
}
    </style>


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