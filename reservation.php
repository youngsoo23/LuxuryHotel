
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <title>Luxury Hotel</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" type="text/css">
		<link rel="stylesheet" href="css/hotel.css" type="text/css">
		<link rel="stylesheet" href="css/hotel-responsive.css" type="text/css">
		<link rel="stylesheet" href="js/slider/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/socialcount-with-icons.css" type="text/css" media="screen" />
		
		<style>
			div.ui-datepicker{
				font-size:11px;
			}
			html {
				height: 100%;
			}
			body {
				height: 100%;
			}		</style>
			
	    <!--[if lt IE 9]>
			<link rel="stylesheet" href="css/bootstrap_ie7.css" type="text/css">
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
	</head>
	<body>
		<div class="container-fluid" style="height:100%">
			<div class="row">
				<div class="span6 logo">
					<a href="index.php">
					<div class="row">
						<div class="span3 logo">
							<h1>Luxury<span> Hotel</span></h1>
							<p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
						</div>
					</div>
					</a>
				</div>		
				<div class="span6 main_menu">
					<nav class="navbar">
						<div class="container">
							 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<div class="nav-collapse">
								<ul class="nav nav-pills pull-right">
									<li class=""><a href="index.php">Home</a></li>
									<li class=""><a href="rooms.php">Rooms</a></li>
									<li class=""><a href="facilities.php">Facilities</a></li>
									<li class="active"><a href="reservation.php">Check Reservation</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<div class="row-fluid">
				<br>
				<br>
				<br>
				<center>
					<?php
						session_start();
						echo "<div style=\"color:red\"><b>" . $_SESSION["error"] . "</b></div>";
						session_destroy();
					?>
					Please Enter your Last name and Confirmation number.
				</center>
				<br>
				<div class="span4">
				</div>
				<div class="span4">
				<form action="check-payment.php" method="post" class="form-horizontal">
					<fieldset>
						<div class ="row">
						</div>
						<div class="row">
							<div class="span8">
								<legend><span>Last Name</span></legend>
							</div>
							<div class="span8">
								<label>
									<input name="lastname" type="text" placeholder="Last...">
								</label>
							</div>
						</div>		
						<br />
						<div class="row">
							<div class="span8">
								<legend><span>Confirmation #</span></legend>
							</div>
							<div class="span8">
								<label>
									<input name="payment_id" type="text" placeholder="####">
								</label>
							</div>
						    </div>	   
						   <button class="btn btn-primary btn-large">Check Reservation</button>	    
						</div>
					</fieldset>
				</form>
				</div>
				<div class="span4">
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="row footer_section_pre">
					<div class="span4">
						<h4>Luxury Hotel<span class="line"></span></h4>
						<p>11911 Bedfordshire Dr, Bakersfield, CA 93311</p>
						<p>
							Tel: +123-123-1234<br>
							Fax: +321-321-4321<br>
							Email: contact@luxuryhotel.com
						</p>
						<br>
					</div>
				</div>
			</div>
		</footer>
		<div class="navbar navbar-default" style="margin-bottom:0px;margin-left:0px;margin-right:0px;clear:both;"></div>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/socialcount.min.js"></script>
		<script src="js/jquery.quicksand.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/global.js"></script>
	</body>
</html>