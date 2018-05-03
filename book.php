<?php
	session_start();
	$_SESSION["is_active"] = TRUE;
	$_SESSION["num_rooms"] = $_POST["num_rooms"];
	$_SESSION["num_adults"] = $_POST["num_adults"];
	$_SESSION["num_kids"] = $_POST["num_kids"];
	$_SESSION["check_in"] = $_POST["check_in"];
	$_SESSION["check_out"] = $_POST["check_out"];
	$_SESSION["room_type"] = $_POST["room_type"];

	require("../../cmps3420/connect.php");
	$oracle = connect();
	$query = "SELECT RNO, CPRICE 
			  FROM AVYO_ROOM 
			  WHERE CPRICE = (SELECT MIN(CPRICE)
			  				  FROM (SELECT *
			  				  	    FROM AVYO_ROOM
			  				  	    WHERE HID = 1 AND
			  				  	   		  ROOM_TYPE = :room_type AND
			  				  	   		  RNO NOT IN (SELECT RNO
			  				  	   		 			  FROM AVYO_RESERVATION
			  				  	   		 			  WHERE (SDATE BETWEEN TO_DATE(:checkin, 'MON DD, YYYY') AND 
			  				  	   		 			  					   TO_DATE(:checkout, 'MON DD, YYYY')) AND
			  				  	   		 			 	    (EDATE BETWEEN TO_DATE(:checkin, 'MON DD, YYYY') AND 
			  				  	   		 			 	                   TO_DATE(:checkout, 'MON DD, YYYY')))))";
	$prepared_statement = oci_parse($oracle, $query);
	oci_bind_by_name($prepared_statement, ':room_type', strtolower($_SESSION["room_type"]));
	oci_bind_by_name($prepared_statement, ':checkin', $_SESSION["check_in"]);
	oci_bind_by_name($prepared_statement, ':checkout', $_SESSION["check_out"]);
	oci_execute($prepared_statement);
	$row = oci_fetch_assoc($prepared_statement);
	$_SESSION["room_no"] = $row['RNO'];
	$_SESSION["price"] = $row['CPRICE'];
	oci_free_statement($prepared_statement);
	oci_close($oracle);
	if (!isset($_SESSION["room_no"])) {
		$_SESSION["error"] = "There are currently no rooms available that match your criteria. We apologize for the inconvenience";
		header('Location: index.php');
	}
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
		</style>	    <!--[if lt IE 9]>
			<link rel="stylesheet" href="css/bootstrap_ie7.css" type="text/css">
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container-fluid" style="height: 100%">
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
			<div class="row booking_summary">
				<div class="span12">
					<div class="row">
						<div class="span9">
						<form action="book-pay.php" method="post" class="form-horizontal" id="contact">
							<fieldset>
								<br>
								<br>
								<h1>
									Guest information
									<br />
									<small>Fill out the form to complete your reservation.</small>
								</h1>
								<br>
								<div class="row">
									<div class="span8">
										<legend><span>Name</span></legend>
									</div>
									<div class="span3">
										<label>
											<input name="firstname" type="text" placeholder="First...">
										</label>
									</div>	

									<div class="span3">
										<label>
											<input name="lastname" type="text" placeholder="Last...">
										</label>
									</div>
								</div>		
								<br />
								<div class="row">
									<div class="span8">
										<legend><span>Contact Details</span></legend>
									</div>
									<div class="span3">
										<label>Email address
											<input name="email" type="text" >
										</label>
									</div>
									<div class="span3">
										<label>Phone number
											<input name="phone" type="text" placeholder="(+##)-###-###-####">
										</label>
									</div>
								</div>
								<br />	
								<br />
								<div class="row">
									<div class="span8">
										<br />
										<button class="btn btn-primary btn-large book-now pull-right">Continue</button>
										<br />
										<br />
									</div>
								</div>
							</fieldset>
						</form>
						</div>
						<div class="span3">
							<br>
							<br>
							<h3><span>Your</span> summary</h3>
							<p>
								Your choosen dates are:
								<div class="pull-left">Arrival : <i><?php echo $_SESSION["check_in"]; ?></i></div><br />
								<div class="pull-left">Departure : <i><?php echo $_SESSION["check_out"]; ?></i></div><br />
								<br>
								Your choosen room is:
								<div class="pull-left">
									<i>
										<?php
											echo "A " . $_SESSION["room_type"] . " room for " . $_SESSION["num_adults"] . " adult(s) and " . $_SESSION["num_kids"] . " child(ren)";
										?>
									</i>
								</div>
								<br>
								<br>
								<br>
							</p>
						</div>
					</div>
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
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	</body>
	<script>
		$(document).ready(function () {
			$('#contact').validate({
				rules: {
					firstname: {
						required: true
					},
					lastname: {
						required: true
					},
					email : {
						required: true
					},
					phone: {
						required: true
					}
				}
			});
		});
	</script>
</html>