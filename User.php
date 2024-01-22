<?php require_once('config.php'); 
// Handle button clicks and redirections
if(isset($_POST['Admin'])){
    redirect('admin');
}
if(isset($_POST['General'])){
    header("Location: Generals/index.php");
    exit(); // Make sure to exit after redirection
}
if(isset($_POST['Hospital'])){
    header("Location: Hospital/index.php");
    exit(); // Make sure to exit after redirection
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Choose your Account</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<style type="text/css">
		@import url('https://fonts.maateen.me/solaiman-lipi/font.css');
		h4 ,p {
			font-family: 'SolaimanLipi', sans-serif;
		}
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
    width: 46%;
}
		a {
			text-decoration: none;
			font-size: 15px;
			font-style:italic;
		}
		a:hover {
			color: yellow !important;
		}
		body{
	      	background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
	      	background-size: cover;
	    }
		.btn-ad{
			background-image: linear-gradient(#000a54, #a900ff);
		}
		.btn-us{
			background-image: linear-gradient(#358b00, #0072ff);
		}
		.btn-hos{
			background-image: linear-gradient(#8b0000f7, #505050);
		}
		hr{
			color:#fff;
		}
		.contentTwo{
			position: relative;
			left:150px;
		}

	</style>

</head>
<body>
<div class="card">
  <div class="card-body">
	<div>
		<legend class="text-center text-light"><?php echo $_settings->info('name') ?></legend>
		<form class="text-center d-block" method="post">
			<button class="btn btn-primary p-3 me-3 btn-ad" name="Admin">LOGIN AS ADMIN</button>
			<button class="btn btn-success p-3 btn-us" name="General"> LOGIN AS CHILD'S PARENT </button>
			<button class="btn btn-success p-3 btn-hos" name="Hospital"> LOGIN AS HOSPITAL </button>
		</form>

		</div>
		</div>
</div>
		<div class="row">
			<div class="content text-center mt-4 text-light">
				<h4>প্রতিটি শিশুর রয়েছে সবগুলো টিকা পাওয়ার অধিকার</h4>
				<h4>শিশুকে সবগুলো টিকা দেওয়ার জন্য কমপক্ষে পাঁচ বার টিকা কেন্দ্রে আসতে হবে</h4>
				<h4>টিকা দেওয়ার পর যে ক  কোনো সমস্যা বা অসুবিধা হলে সাথে সাথে শিশুকে নিকটস্থ স্বাস্থ্য কেন্দ্রে নিয়ে আসুন</h4>
			</div>
			<div class="contentTwo content text-center mt-4 text-light">
			<h4>শিশুদের টিকা দিয়ে প্রতিরোধযোগ্য রোগ সমহঃ</h4>
			<p>১। যক্ষা ২। পোলিও ৩ । ডিফথেরিয়া ৪। হুপিং কাশি ৫। ধনষ্টুংকার ৬। হে পাটাইটিস -বি ৭। হিমোফাইলাস ইনফ্লুয়েঞ্জা-বি জনিত রোগ ৮। হাম ৯ । নিউমোক্ককাল জনিত নিউমোনিয়া ১০। রুবেলা</p>
			</div>
			<hr>
			<div class="contentTwo content mt-4 text-light">
			<ul>
				<li>১। সময়সূচি অনযুায়ী সবগুলো টিকা নিলে আপনার শিশু উপরে বর্ণিত মারাত্মক সংক্রামক রোগসমুহ হতে রক্ষা পাবে ।</li>
				<li>২। সময়সূচি অনযুায়ী টিকা না নিলে আপনার শিশুর মারাত্মক সংক্রামক রোগসমুহের বিরুদ্ধে রোগ প্রতিরোধ ক্ষমতা তৈরি নাও হতে পারে ।</li>
				<li>৩। বি সি জি টিকার নির্দিষ্ট ডোজটি জন্মের পর পরই দেয়া যায়। টিকা দেয়ার পর বি সি জি টিকার স্থানে (বাম বাহুতে ) স্বাভাবিক ভাবে ঘা হবে এতে ভয়ের কিছুনাই ।</li>
				<li>৪। শিশুকে আইপি ভি টিকার দইু ডোজে টিকা; ১ম ডোজে ৬ সপ্তাহ/৪২ দিন হলে , ২য় ডোজে ১৪ সপ্তাহ বয়সে দিতে হবে ।</li>
				<li>৫। শিশুর বয়স ৬ সপ্তাহ/৪২ দিন হলে ই পেন্টাভ্যালেন্ট (ডি পি টি, হেপাটাইটিস- বি ,হি ব), ওপি ভিএবং পি সি ভি টিকার ১ম ডোজ দিতে হবে । তারপর কমপক্ষে ৪ সপ্তাহ/২৮ দিনের ব্যবধানে এসকল টিকার ২য় এবং ৩য় ডোজ দিতে হবে ।</li>
				<li>৬। ১০ মাসে পড়লে ই/২৭০ দি ন পূর্ণ হলে ই শিশুকে ১ম ডোজ এবং ১৫ মাস বয়স পূর্ণ হলে ই এমআর (হাম ও রুবে লা) টিকা দিতে হবে ।</li>
				<li>৭। অসুস্থ শিশুকে সাময়িকভাবে টিকা দেয়া যাবে না। তবে শিশু সুস্থ হওয়ার সাথে সাথে টিকা দিতে হবে এবং সময়সূচি অনযুায়ী সকল টিকা নেয়া শেষ করতে হবে ।</li>
				<li>৮। টিকা দিলে সামান্য জ্বর, টিকার স্থানে ব্যথা এবং সাময়ি কভাবে টিকা দেয়ার স্থান শক্ত হয়ে যেতে পারে , এতে ভয়ের কিছুনাই ।</li>
			</ul>
			</div>
		</div>
	
	

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>