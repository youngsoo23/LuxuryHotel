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
			}		</style>	    <!--[if lt IE 9]>
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
									<li class="active"><a href="index.php">Home</a></li>
									<li class=""><a href="rooms.php">Rooms</a></li>
									<li class=""><a href="facilities.php">Facilities</a></li>
									<li class=""><a href="reservation.php">Check Reservation</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12"></div>
				<div class="span12"></div>
			</div>
			<div class="row-fluid home">
				<div class="span12">
					<center>
						<div style="color:red">
							<b>
							<?php
								session_start();
								echo $_SESSION["error"];
								session_destroy();
							?>
							</b>
						</div>
					</center>
					<h2>
						<span>select</span> your room
						<br> 
						<span>choose</span> your dates and book
					</h2>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12"></div>
			</div>
			<form action="book.php" method="post" class="form-inline" id="form">
				<input id="room_type" type="hidden" name="room_type">
				<div class="row-fluid home">
					<div class="span3">
						<div id="single" class="room_selector" value="single">
							<h5>
								<a href="#" class="pull-left">
									<i class="icon-chevron-left"></i>
								</a>
								Single
								<a href="#" class="pull-right ">
									<i class="icon-chevron-right"></i>
								</a>
							</h5>
							<img src="css/images/rooms/single_room.jpg" alt="" />
							<p>All single rooms have one single bed and sleeps one adult.</p><br>
						</div>
						<div id="double" class="room_selector" style="display: none;" value="double">
							<h5>
								<a href="#" class="pull-left ">
									<i class="icon-chevron-left"></i>
								</a>
								Double
								<a href="#" class="pull-right ">
									<i class="icon-chevron-right"></i>
								</a>
							</h5>
							<img src="css/images/rooms/double_room.jpg" alt="" />
							<p>All double rooms have a double bed and sleeps two adults.</p><br>
						</div>		
						<div id="suite" class="room_selector" style="display: none;" value="suite">
							<h5>
								<a href="#" class="pull-left ">
									<i class="icon-chevron-left"></i>
								</a>
								Suite
								<a href="#" class="pull-right ">
									<i class="icon-chevron-right"></i>
								</a>
							</h5>
							<img src="css/images/rooms/luxury_room.jpg" alt="" />
							<p>All suites have two double beds and a balcony. Sleeps up to four adults.</p>
						</div>		
					</div>
					<div class="span3 home_calendar">
						<div class="form-horizontal">			
							<div class="control-group">
								<label class="control-label pull-left" for="inputEmail">Arrive</label>
								<div class="controls">
									<input name="check_in" type="text" value="" class="span2 check-in-date" readonly="true"/>
								</div>
							</div>
						</div>
						<div class="datepicker_from"></div>
					</div>
					<div class="span3 home_calendar">
						<div class="form-horizontal">			
							<div class="control-group">
								<label class="control-label pull-left" for="inputEmail">Depart</label>
								<div class="controls">
									<input name="check_out" type="text" value="" class="span2 check-out-date" readonly="true"/>
								</div>
							</div>
						</div>
						<div class="datepicker_to"></div>
					</div>
					<div class="span3">
						<div class="form-horizontal">
<!-- 							<div class="control-group">
								<label class="control-label">Rooms</label>
								<div class="controls">
									<select name="num_rooms" class="span1 select_rooms">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								</div>
							</div> -->
							<div class="control-group">
								<label class="control-label" for="inputEmail">Adults</label>
								<div class="controls">
									<select name="num_adults" class="span1 select_adults">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>								
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="inputEmail">Children</label>
								<div class="controls">
									<select name="num_kids" class="span1 select_kids">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								</div>
							</div>
						</div>
						<br>
						<br>
						<br>
						<br>
						<br>
						<button class="btn btn-primary btn-large book-now">Book Now</button>
					</div>		
				</div>	
			</form>
			<div class="row-fluid">
				<div class="span12"></div>
			</div>
			<hr/>
			<div class="row-fluid">
				<div class="span3"></div>
				<div class="span3">
					<h3>Rooms</h3>
					<a href="rooms.php"><img src="css/images/rooms.jpg" alt="" /></a>
					<p>View our range of availiable rooms and options</p>
				</div>
				<div class="span3">
					<h3>Amenities</h3>
					<a href="facilities.php"><img src="css/images/services.png" alt="" /></a>
					<p>We have a gym, swimming pool, golf course, and much more</p>
				</div>
				<div class="span3"></div>	
			</div>
			<div class="row-fluid">
				<div class="span12"></div>
			</div>
			<div class="row">
				<div class="span12 what_people_say">
					<div id="quotes">
						<blockquote class="textItem" style="display: none;">
							<p>This is the best hotel I've ever been to.</p>
							<small>Huaqing Wang</small>
						</blockquote>			
						<blockquote class="textItem" style="display: none;">
							<p>The food is incredible.</p>
							<small>Huaqing Wang</small>
						</blockquote>			
						<blockquote class="textItem" style="display: none;">
							<p>Beyond All Expectations</p>
							<small>Huaqing Wang</small>
						</blockquote>
					</div>
				</div>	
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12"></div>
		</div>
		<footer class="footer">
			<div class="container ">
				<div class="row footer_section_pre ">
					<div class="span4 ">
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

		<script type="text/javascript">
			$("#form").submit(function(event) {
				var room_type = $('.room_selector:visible > h5').text().trim();
				$('#room_type').val(room_type);
			});
		</script>
	</body>
</html>