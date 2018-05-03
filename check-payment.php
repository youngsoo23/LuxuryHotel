<?php
	include '../../cmps3420/connect.php';
	
	$payment_id = $_POST["payment_id"];
	$lastname = $_POST["lastname"];

	$oracle = connect();

	$query = "SELECT FNAME, LNAME, BID, RDATE, SDATE, EDATE, ROOM_TYPE, CPRICE FROM (AVYO_GUEST NATURAL JOIN AVYO_RESERVATION NATURAL JOIN AVYO_ROOM) WHERE BID = :payment_id AND LOWER(LNAME) = LOWER(:lastname)";
	
	$prepared_statement = oci_parse($oracle, $query);
	oci_bind_by_name($prepared_statement, ':payment_id', $payment_id);
	oci_bind_by_name($prepared_statement, ':lastname', $lastname);
	oci_execute($prepared_statement);
	
	$row = oci_fetch_assoc($prepared_statement);
	$booking_id = $row["BID"];
	$first_name = ucfirst($row["FNAME"]);
	$last_name = ucfirst($row["LNAME"]);
	$check_in = date("M d, Y", strtotime($row["SDATE"]));
	$check_out = date("M d, Y", strtotime($row["EDATE"]));
	$room_type = ucfirst($row["ROOM_TYPE"]);
	$price = floatval($row["CPRICE"]);

	if (!isset($booking_id)) {
 		session_start();
 		$_SESSION["error"] = "The reservation was not found. Please try again";
		header('Location: reservation.php');
    }

	oci_free_statement($prepared_statement);
		
	oci_close($oracle);
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
		</style>
			
	    <!--[if lt IE 9]>
			<link rel="stylesheet" href="css/bootstrap_ie7.css" type="text/css">
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<br/>
				<div class="span12 logo">
					<div class="row">
						<div class="span12 logo">
							<h1>Luxury<span> Hotel</span></h1>
							<p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<br>
				<br>
				<h1>Confirmation</h1>
			</div>
			<div class="row-fluid">
				<hr/>
				<div class="row-fluid">
					<div class="span5">
						<h3><span>Reservation Details</span></h3>
					</div>
					<div class="span2"></div>
					<div class="span4">
						<h3><span>Policies</span></h3>
					</div>
					<div class="span5">
						<table class="table table-condensed">
							<tr>
								<td style="border-top: none;"><b>Confirmation Number</b></td>
								<td style="border-top: none;"><?php echo $booking_id?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Guest Name</b></td>
								<td style="border-top: none;"><?php echo $first_name . " " . $last_name; ?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Check-in Date</b></td>
								<td style="border-top: none;"><?php echo $check_in; ?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Check-out Date</b></td>
								<td style="border-top: none;"><?php echo $check_out; ?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Room Type</b></td>
								<td style="border-top: none;"><?php echo $room_type; ?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Nightly Rate</b></td>
								<td style="border-top: none;"><?php echo "$" . $price;?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Total Price</b></td>
								<td style="border-top: none;">
								<?php 
									$diff = (strtotime($check_out) - strtotime($check_in)) / 86400;
									$total = $price * $diff * 1.07; 
									echo "$" . number_format($total, 2, '.', ''); ?>
								</td>
							</tr>
						</table>
						The above rate may not reflect all possible fees, additional charges or taxes associated with the reservation. For clarification regarding these charges please contact our reservations department.
					</div>
					<div class="span2"></div>
					<div class="span4">
						<table class="table table-condensed">
							<tr>
								<td style="border-top: none;"><b>Check-in Time</b></td>
								<td style="border-top: none;">1:00 PM</td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Check-out Time</b></td>
								<td style="border-top: none;">12:00 PM</td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Cancellation Policy</b></td>
								<td style="border-top: none;">Cancellations must be received by 4:00 PM the day prior to arrival to avoid a charge of none night's room and tax.</td>
							</tr>
						</table>
						We strive to provide our guests with a smoke-free environment.
					</div>
				</div>
			</div>
			<br>
			<hr>
			<br>
			<div class="row">
				<div class="center">
					11911 Bedfordshire Dr, Bakersfield, CA 93311
					<br>
					Tel: +123-123-1234
					<br>
					Fax: +321-321-4321
					<br>
					Email: contact@luxuryhotel.com
				</div>
			</div>
			<br>
			<br>	
			<center>
				<a class="btn btn-primary" href="index.php">Click Here to Return</a>
			</center>
			<br>
			<br>
			<br>
			<br>
		</div>
<!-- 		<footer class="footer">
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
		</footer> -->
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/socialcount.min.js"></script>
		<script src="js/jquery.quicksand.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/global.js"></script>
	</body>
</html>