<?php
include "dbconnect.php";

if (empty($_POST['rsvName']) || empty ($_POST['rsvPhone'])
|| empty ($_POST['rsvEmail']) || empty ($_POST['rsvDate'])) {
		echo '<script language="javascript">';
		echo "alert('Invalid submission with empty form.');";
		echo "window.location.href = 'reservation.html';";
		echo '</script>';
		exit;
}
else {
	$rsvSalulation = $_POST['rsvSalulation'];
	$rsvName = $_POST['rsvName'];
	$rsvPhone = $_POST['rsvPhone'];
	$rsvEmail = $_POST['rsvEmail'];
	$rsvDate = $_POST['rsvDate'];
	$rsvTime = $_POST['rsvTime'];
	$rsvPax = $_POST['rsvPax'];
	$rsvComment = $_POST['rsvComment'];

	//TODO: Check for available slots
	$query = "INSERT INTO reserve (rsv_salulation, rsv_name, rsv_phone, rsv_email, rsv_date, rsv_time, rsv_pax, rsv_comment) 
	VALUES ('$rsvSalulation', '$rsvName', '$rsvPhone', '$rsvEmail', '$rsvDate', '$rsvTime', '$rsvPax', '$rsvComment')";
	$result = mysqli_query($con, $query);
	if (!$result) {
		echo '<script language="javascript">';
		echo "alert('Reservation failed. Please try again later.')";
		echo '</script>';	}
	else{
		echo '<script language="javascript">';
		echo 'alert("You have sucessfully made a reservation! A confirmation email has been sent to you.");';
		//Enable automatic email
		echo "window.location.href = 'home.html';";
		echo '</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Xiong Mao - Reservation</title>
<meta charset="utf-8">
<link rel="stylesheet" href="xiongmao.css">
<style>
#header {
	text-align: center;
	vertical-align: middle;
}
#reserve {
	text-align: center;
}
#notice {
	padding-left: 30px;
	width: 500px;
	text-align: left;
	display: inline-block;
}
#form {
	margin-left:0px;   
	width: 800px;
	text-align: center;
	vertical-align: top;
	display: inline-block;
}
#left {
	width:390px;
	display: inline-block;
}
#right {
	width:390px;
	vertical-align: top;
	display: inline-block;
}
h2 {
	color:#FF476F;
}
form {
	line-height: 150%;
}
label {
	float: left;
	text-align: right; 
	padding-right: 10px;
	width: 45%;
	display: block;
}  
input, select, textarea {
	margin-left: 20px;
	text-align: left;
	display: block;
}	             
</style> 
<script>
	function checkInput(){
		var name = document.getElementById("rsvName");
	    var nameRegExp = /^[A-Za-z]+\s?[A-Za-z]*$/;
		var nameValid = nameRegExp.test(name.value);
   		if (nameValid != true) {
			alert("The name is not valid.\n" + "It should contain only alphabet characters and space.");
			name.focus();
			name.select();
			return false;
		}

		var phone = document.getElementById("rsvPhone");
	    var phoneRegExp = /^\d+$/;
		var phoneValid = phoneRegExp.test(phone.value);
    	if (phoneValid != true) {
			alert("The phone number is not valid.\n" + "It should contain only digits.");
			phone.focus();
			phone.select();
			return false;
		}

		var date = document.getElementById("rsvDate");
		var dateCurrent = new Date();
		var dateSelect = new Date(date.value);
   		if (dateSelect <= dateCurrent){
			alert("The date is not valid.\n" + "The start date cannot be from today and the past.");
			date.focus();
			date.select();
			return false;
		}

		var pax = document.getElementById("rsvPax");
  	    if ((pax.value<=0)||(pax.value>8)||(pax.value%1!=0)){
			alert("The age is not valid.\n" + "It must be a positive integer between 1-8.");
			pax.focus();
			pax.select();
			return false;
		}
	}
</script>
</head>
<body>
<div id="title-left">
	<img src="Assets/logo.png" id="logo" width="204" height="103">
</div>
<div id="title-right">
	<header>
		<h1>Xiong Mao</h1>
	</header>
	<nav>
		<a href="home.html">Home</a>
		<a href="menu.html">Menu</a>
		<a href="reservation.html">Reservation</a>
		<a href="delivery.html">Delivery</a>
		<a href="event.html">Event</a>
		<a href="contact.html">Contact</a>
		<a href="login_register.html">Login/Register</a>
	</nav>
</div>
<div id="reserve">
	<div id="header">
		<img src="Assets/headerReservation.png" width="1400" height="300">
	</div>
	<div id="notice">
		<h2 align="center">Reservation Notice</h2>
		<p>Please read the following terms and conditions berfore making a reservation.</p>
		<ul>
			<li>Information with asterisk is mandatory in the form.</li>
			<li>If you have any special requests, please include in the comment.</li>
			<li>Reservation must be made at least 1 day before the actual dining day.</li>
			<li>The maximum pax allowed is 8. For dining of more pax, please directly approach to us by contact form, email or telephone.</li>
			<li>Number of reservations is limited for each day.</li>
			<li>You will be informed upon successful reservation.</li>
			<li>In case of cancelation, please inform us at least 1 day in advance.</li>
		</ul>
		<p>By clicking submission button in reservation form, you acknowledge that you have read, understood and accepted the terms and conditions above.</p>
	</div>
	<div id="form">
		<h2 align="center">Reservation Form</h2>
		<form method="post" action="reserve.php" onsubmit="return checkInput();" id="info">
			<div id="left">
				<label for="rsvSalulation">* Salulation:</label>
				<select name="rsvSalulation" id="rsvSalulation">
					<option value="Mr.">Mr.</option>
					<option value="Ms.">Ms.</option>
				</select><br>
  				<label for="rsvName">* Name:</label>
  				<input type="text" name="rsvName" id="rsvName" required><br>
  				<label for="rsvPhone">* Phone:</label>
  				<input type="text" name="rsvPhone" id="rsvPhone" required><br>
  				<label for="rsvEmail">* E-mail:</label>
  				<input type="email" name="rsvEmail" id="rsvEmail" required><br>
  				<label for="rsvDate">* Date:</label>
				<input type="date" name="rsvDate" id="rsvDate" required><br>
			</div>
			<div id="right">
				<label for="rsvTime">* Time:</label>
				<select name="rsvTime" id="rsvTime">
					<option value="12:00">12:00</option>
					<option value="13:00">13:00</option>
					<option value="17:00">17:00</option>
					<option value="18:00">18:00</option>
					<option value="19:00">19:00</option>
				</select><br>
				<label for="rsvPax">* Pax:</label>
				<input type="number" name="rsvPax" id="rsvPax" value="1" min="1" max="8" step="1" required><br>
				<label for="rsvComment">Comment:</label>
				<textarea name="rsvComment" id="rsvComment" rows="4" cols="18"></textarea><br>
				<input type="submit" name="rsvSubmit" id="rsvSubmit" value="Submit" style="margin-left: 165px;">
			</div>	
		</form>
	</div>
</div>
<footer>
	<small>Nanyang Technological University, #01-01 Nanyang Center, 50 Nanyang Walk, Singapore 639929<br>
		Tel: 8888 6666 | Email: <a href="mailto:xiongmao@xiongmao.com">xiongmao@xiongmao.com</a><br>
		<i>Copyright &copy; 2018 Xiong Mao, Inc.<br></i></small>	
</footer>
</body>
</html>