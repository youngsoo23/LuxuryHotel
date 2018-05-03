<?php
	include '../../cmps3420/connect.php';

	session_start();
	
	//Guest Information
	$firstname = $_SESSION["firstname"];
	$lastname = $_SESSION["lastname"];
	$email = $_SESSION["email"];
	$phone = $_SESSION["phone"];

	//Reservation Information
	$check_in = $_SESSION["check_in"];
	$check_out = $_SESSION["check_out"];
	$room_number = $_SESSION["room_no"];
	$price = $_SESSION["price"];

	//Billing Information
	$card_type = $_POST["cardtype"];
	$card_number = $_POST["cardnumber"];
	$billing_firstname = $_POST["billing_firstname"];
	$billing_lastname = $_POST["billing_lastname"];
	$billing_address = $_POST["billing_address"];
	$billing_city = $_POST["billing_city"];
	$billing_state = $_POST["billing_state"];
	$billing_zip = $_POST["billing_zip"];

	//
	$oracle = connect();
	$query = "INSERT INTO avyo_guest (fName, lName, email, phone) VALUES (:firstname, :lastname, :email, :phone)";
	$prepared_statement = oci_parse($oracle, $query);
	oci_bind_by_name($prepared_statement, ':firstname', $firstname);
	oci_bind_by_name($prepared_statement, ':lastname', $lastname);
	oci_bind_by_name($prepared_statement, ':email', $email);
	oci_bind_by_name($prepared_statement, ':phone', $phone);
	oci_execute($prepared_statement);
	oci_free_statement($prepared_statement);

	$query = oci_parse($oracle, "SELECT MAX(GID) AS GID FROM AVYO_GUEST");
	oci_execute($query);
	$guest_id;
	while ($row = oci_fetch_assoc($query)) {
		$guest_id = $row["GID"];
	}
	oci_free_statement($query);

	$query = "INSERT INTO avyo_payment (card_number, fName, lName, street, city, state, zip) 
			  VALUES (:card_number, :billing_firstname, :billing_lastname, :billing_address, :billing_city, :billing_state, :billing_zip)";
	$prepared_statement = oci_parse($oracle, $query);
	oci_bind_by_name($prepared_statement, ':card_number', $card_number);
	oci_bind_by_name($prepared_statement, ':billing_firstname', $billing_firstname);
	oci_bind_by_name($prepared_statement, ':billing_lastname', $billing_lastname);
	oci_bind_by_name($prepared_statement, ':billing_address', $billing_address);
	oci_bind_by_name($prepared_statement, ':billing_city', $billing_city);
	oci_bind_by_name($prepared_statement, ':billing_state', $billing_state);
	oci_bind_by_name($prepared_statement, ':billing_zip', $billing_zip);
	oci_execute($prepared_statement);
	oci_free_statement($prepared_statement);

	$query = oci_parse($oracle, "SELECT MAX(PID) AS PID FROM AVYO_PAYMENT");
	oci_execute($query);
	$payment_id;
	while ($row = oci_fetch_assoc($query)) {
		$payment_id = $row["PID"];
	}
	oci_free_statement($query);

	$query = "INSERT INTO avyo_reservation (hID, rNO, gID, pID, rDate, sDate, eDate, price)
			   VALUES(1, :room_number, :guest_id, :payment_id, CURRENT_TIMESTAMP, TO_DATE(:check_in, 'MON DD, YYYY'), TO_DATE(:check_out, 'MON DD, YYYY'), :price)";
	$prepared_statement = oci_parse($oracle, $query);
	oci_bind_by_name($prepared_statement, ':room_number', $room_number);
	oci_bind_by_name($prepared_statement, ':guest_id', $guest_id);
	oci_bind_by_name($prepared_statement, ':payment_id', $payment_id);
	oci_bind_by_name($prepared_statement, ':check_in', $check_in);
	oci_bind_by_name($prepared_statement, ':check_out', $check_out);
	oci_bind_by_name($prepared_statement, ':price', $price);
		
	oci_execute($prepared_statement);
	oci_free_statement($prepared_statement);	
		$query = oci_parse($oracle, "SELECT MAX(BID) AS BID FROM AVYO_RESERVATION");
	oci_execute($query);
	$booking_id;
	while ($row = oci_fetch_assoc($query)) {
		$booking_id = $row["BID"];
	}
	oci_free_statement($query);   
//----------------------------------------------------------			



	oci_close($oracle);
	session_destroy();
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
				Reservation Date: <?php echo date("m-d-Y  h:i:s A"); ?>
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
								<td style="border-top: none;"><?php echo $booking_id ?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Guest Name</b></td>
								<td style="border-top: none;"><?php echo $firstname . " " . $lastname; ?></td>
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
								<td style="border-top: none;"><?php echo $_SESSION["room_type"]; ?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Nightly Rate</b></td>
								<td style="border-top: none;"><?php echo "$" . $_SESSION["price"];?></td>
							</tr>
							<tr>
								<td style="border-top: none;"><b>Total Price</b></td>
								<td style="border-top: none;">
									<?php
										echo "$" . number_format($_SESSION["total"] * 1.07, 2,'.','');
									?>
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