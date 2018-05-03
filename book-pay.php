<?php
	session_start();
	$num_rooms = $_SESSION["num_rooms"];
	$num_adults = $_SESSION["num_adults"];
	$num_kids = $_SESSION["num_kids"];
	$check_in = $_SESSION["check_in"];
	$check_out = $_SESSION["check_out"];
	$room_type = strtolower($_SESSION["room_type"]);

	$_SESSION["firstname"] = ucfirst($_POST["firstname"]);
	$_SESSION["lastname"] = ucfirst($_POST["lastname"]);
	$_SESSION["email"] = $_POST["email"];
	$_SESSION["phone"] = $_POST["phone"];
?>
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
			}
		</style>
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
									<li class=""><a href="reservation.php">Check Reservation</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<div class="row book-pay">
				<div class="span12">	
					<br /><br />
					<h1>
						Review your selection
					</h1>
					<br>
					<div class="row">
						<div class="span12">		
							<div class="row">
								<div class="span6">
									<h3><span>Your</span> chosen rooms</h3>				
									<div class="pull-left strong">Room type</div>
									<div class="pull-right "><?php echo $_SESSION["room_type"]; ?></div><br>

									<div class="pull-left strong">Arrival date</div>
									<div class="pull-right">
										<?php echo $check_in; ?>
									</div>
									<br>
									<div class="pull-left strong">Departure date</div>
									<div class="pull-right">
										<?php echo $check_out; ?>
									</div>
									<br>
									<div class="pull-left strong">Duration</div>
									<div class="pull-right">
										<?php
											$start = strtotime($check_in);
											$end = strtotime($check_out);
											$_SESSION["diff"] = ($end - $start) / 86400;
											echo $_SESSION["diff"] . " night(s)";
										?>
									</div>
									<br><br>

									<div class="pull-left strong">Guests</div>
									<div class="pull-right">
									<?php
										echo $num_adults . " adult(s) and " . $num_kids . " child(ren)";
									?>
									</div>
									<br>
								</div>
								<div class="span3 pull-right">
									<p>Base Room Price</p>
									<span class="price"><?php echo "$" . $_SESSION["price"]; ?></span>
								</div>		
							</div>
						</div>
					</div>
					<br>
					<hr/>
					<br>
					<div class="row">
					<div class="span12">
						<div class="row">
							<div class="span8">
								<h3><span>Payment</span> information</h3>
								<form action="payment.php" method="post" class="form-horizontal" id="payment">
									<div class="control-group">
										<label for="inputWarning" class="control-label pay strong">Card Type</label>
										<div class="controls">
											<select name="cardtype" class="span4">
												<option value="0">Select</option>
												<option value="VISA">Visa</option>
												<option value="Master">MasterCard</option>
												<option value="Diners">DinersClub</option>
												<option value="AMEX">AmEx</option> 
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="inputError" class="control-label pay strong">Card Number</label>
										<div class="controls">
											<input name="cardnumber" type="text" class="span3">
											<strong >CVV</strong>
											<input name="cardcode" type="text" class="span1 cvv2" placeholder="">
										</div>
									</div>
									<div class="control-group">
										<label for="inputInfo" class="control-label pay strong">Expiration Date</label>
										<div class="controls">
											<select name="expmonth" class="span2 month_picker">
												<option value="0">Month</option>
												<option value="1">January</option>
												<option value="2">February</option>
												<option value="3">March</option>
												<option value="4">April</option>
												<option value="5">May</option>
												<option value="6">June</option>
												<option value="7">July</option>
												<option value="8">August</option>
												<option value="9">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>
											</select>
											<select name="expyear" class="span2 year_picker">
												<option value="0">Year</option>
												<option value="2016">2016</option>
												<option value="2017">2017</option>
												<option value="2018">2018</option>
												<option value="2019">2019</option>
												<option value="2020">2020</option>
												<option value="2021">2021</option>
												<option value="2022">2022</option>
												<option value="2023">2023</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="inputSuccess" class="control-label pay strong">First name</label>
										<div class="controls">
											<input name="billing_firstname" type="text" class="span4 card_holder">
										</div>
									</div>
									<div class="control-group">
										<label for="inputSuccess" class="control-label pay strong">Last name</label>
										<div class="controls">
											<input name="billing_lastname" type="text" class="span4 card_holder">
										</div>
									</div>
									<div class="control-group">
										<label for="inputSuccess" class="control-label pay strong">Address</label>
										<div class="controls">
											<input name="billing_address" type="text" class="span4 card_holder">
										</div>
									</div>
									<div class="control-group">
										<label for="inputSuccess" class="control-label pay strong">City</label>
										<div class="controls">
											<input name="billing_city" type="text" class="span4 card_holder">
										</div>
									</div>
									<div class="control-group">
										<label for="inputSuccess" class="control-label pay strong">State</label>
										<div class="controls">
											<input name="billing_state" type="text" class="span4 card_holder">
										</div>
									</div>	
									<div class="control-group">
										<label for="inputSuccess" class="control-label pay strong">Zip</label>
										<div class="controls">
											<input name="billing_zip" type="text" class="span4 card_holder">
										</div>
									</div>
									<div class="control-group">
										<div class="span11">
										<button class="btn btn-primary btn-large book-now pull-right">Submit payment</button>
										</div>
									</div>
							</form>
							</div>
							<div class="span3 pull-right">
								<p><strong>Total price</strong></p>
								<span class="price strong" id="total_price">
								<?php 
									$price = $_SESSION["price"];
									$diff = $_SESSION["diff"];
									$total = $price * $diff;
									$service = 30;
									$_SESSION["total"] = $total;
									echo "$" . number_format($total * 1.07, 2,'.','');
								?>		
								</span>
								<p>price for <?php echo $diff; ?> night(s)</p>
							</div>	
							<div class="span12">
								<br>
								<br>
							</div>	
						</div>
						<br>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="navbar navbar-default" style="margin-bottom:0px;margin-left:0px;margin-right:0px;clear:both;"></div>

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
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/socialcount.min.js"></script>
		<script src="js/jquery.quicksand.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/global.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	</body>
	<script>
		$(document).ready(function () {
			$('#payment').validate({
				rules: {
					cardnumber: {
						required: true
					},
					cardcode: {
						required: true
					},
					expmonth: {
						required: true
					},
					expyear: {
						required: true
					},
					billing_firstname: {
						required: true
					},
					billing_lastname: {
						required: true
					},
					billing_address: {
						required: true
					},
					billing_city: {
						required: true
					},
					billing_state: {
						required: true
					},
					billing_zip: {
						required: true
					}
				}
			});
		});
	</script>
</html>