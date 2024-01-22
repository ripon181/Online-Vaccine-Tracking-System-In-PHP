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

$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - General User</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

	<div class="container">

		<?php function failed(){ ?>
			<div class="alert alert-danger" style="width: 70%;">Failed to login!!</div>
		<?php } ?>

		<div class="card-body">
		<div class="form-box">
			<div class="card card-outline card-primary">
			<legend class="mt-5 text-center text-light" style="font-size:2.5rem; font-weight:bolder;">CHILD'S PARENT LOGIN</legend>
			<a href="register.php" class="text-center" style="color:#fff;">Not have account? Register Now</a>
			<hr>
		<form method="post" class="mx-auto" style="width: 50%;">
		<div class="input-group mb-3">
          <input type="text" class="form-control" name="Email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user form-control"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="Password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock form-control"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="Login">LOG IN</button>
		
          </div>
          <!-- /.col -->
        </div>
		</div>
			

	<style type="text/css">
		<?php 

			$Cover_qry = "SELECT meta_value FROM system_info WHERE meta_field = 'cover'";
			$Cover_img = mysqli_fetch_assoc(mysqli_query($conn, $Cover_qry)); 

		?>

			body {
				background-image: url("../<?php echo $Cover_img['meta_value']; ?>");
				background-size: cover;
			}

			.alert {
				width: 70%;
	    		top: 20px;
	    		left: 20%;
	    		position: absolute;
			}
			.card.card-outline.card-primary {
    width: 602px;
    margin: 0 auto;
    margin-top: 280px;
    padding: 11px;
	background-color:#036657;
}
.card-primary.card-outline {
    border-top: 3px solid #a19105;
}
.input.form-control{
	background-color: #036657;
}
	</style>

	<?php 

		if(isset($_POST['Login'])){

			$email = $_POST['Email'];
			$pass = md5($_POST['Password']);

			$login_qry = "SELECT * FROM general_user WHERE Email = '$email' AND Pass = '$pass'"; 
			
			$RSL = mysqli_query($conn, $login_qry);
			
			if($Dat = mysqli_fetch_assoc($RSL)){
				$_SESSION['GenLuserdata'] = $Dat['Email'];
				$_SESSION['GenLid'] = $Dat['id'];
				$_SESSION['GenLDOB'] = $Dat['DOB'];
				$_SESSION['GenLGen'] = $Dat['Gender'];
				$_SESSION['GenLPhn'] = $Dat['Phone'];

				header("Location: Dashboard.php");
			}else{
				failed();
			}

		}

	?>

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>