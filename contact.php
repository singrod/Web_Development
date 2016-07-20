<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php
/* Process Form Info	
_______________________________________________________________________________*/
if(isset($_POST["submit"])){
	// Details to be sent in email
	$firstName = urldecode($_POST["firstName"]);
	$lastName = urldecode($_POST["lastName"]);
	$email_from = urldecode($_POST["email"]);
	$phone = urldecode($_POST["phone"]);
	$customerMessage = urldecode($_POST["customerMessage"]);
	// validations
	$required_fields = array("firstName", "lastName", "email");	
	validate_presences($required_fields);	
	$fields_with_max_lengths = array("firstName" => 30);
	validate_max_lengths($fields_with_max_lengths);
	$fields_with_max_lengths = array("lastName" => 30);
	validate_max_lengths($fields_with_max_lengths);	
	validate_email($email_from);	
	if(empty($errors)){		
		// Represent the destination and subject; adjust as needed
		$email_to = "msingleton29@cfl.rr.com"; 
		$email_subject = "Website Info Request!";	
		// Create email string
		$email_message = "Request details below.\r\n\r\n";
		$email_message .= "First Name: " . clean_string($firstName) . "\r\n";
		$email_message .= "Last Name: " . clean_string($lastName) . "\r\n";
		$email_message .= "Email: " . clean_string($email_from) . "\r\n"; 
		$email_message .= "Phone: " . clean_string($phone) . "\r\n"; 
		$email_message .= "Message: " . clean_string($customerMessage) . "\r\n";
		// Create email headers 
		$headers = 'From: '. $email_from . "\r\n" . 'Reply-To: '. $email_from . "\r\n" . 'X-Mailer: PHP/' . phpversion();		
		// Send email 
		mail($email_to, $email_subject, $email_message, $headers);
		redirect_to("index.html");		
	} else {
		// echo message(); 
		 echo form_errors($errors);
	} // empty($errors)
} else { 
	// This is probably a GET request
} // end: isset($_POST["submit"] 
/* End Process 
_______________________________________________________________________________*/
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>Mark's Web Development - Contact</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="fonts/font-awesome-4.6.2/font-awesome-4.6.2/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
<div class="jumbotron">
	<h1>Mark's Web Development</h1>
</div>
<nav class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">			
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			</button>			
			<a href="#" class="navbar-brand">Spread Your Word!</a>				
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.html" >Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="portfolio.html">Portfolio</a></li>
				<li><a href="about.html">About</a></li>
				<li class="active"><a href="#">Contact</a></li>
			</ul>
		</div>		
	</div>
</nav>
<div class="container" id="main">		
	<div class="row">
		<div class="container col-sm-12">
			<img class="img-responsive" id="contactImage" src="images/pc-guy4.png" alt="man sitting at computer"/>
		</div>
		<div id="contact" class="col-sm-4">			
			<h2>Direct Contact</h2>
<<<<<<< HEAD
			<p><span class="fa fa-phone" aria-hidden="true"></span>&nbsp;&nbsp; (888) 111-2222</p>
=======
			<p><span class="fa fa-phone" aria-hidden="true"></span>&nbsp;&nbsp; (800) 111-2222</p>
>>>>>>> f9d444348ffdd59d4469af587d13b641ceca37fd
			<p><span class="fa fa-envelope-o" aria-hidden="true"></span>&nbsp;&nbsp; msingleton29@cfl.rr.com</p>
		</div>
		<div id="contact" class="col-sm-8">			
			<form action="contact.php" method="post">
				<h2>Contact Me Today!</h2>
				<br />
				<input type="text" name="firstName" placeholder="First Name *" value=""required /><br /><br />
				<input type="text" name="lastName" placeholder="Last Name *" value="" required/><br /><br />
				<input type="email" name="email" placeholder="Email *" value="" required/><br /><br />
				<input type="text" name="phone" placeholder="Phone" value="" /><br /><br />
				<textarea rows="5" cols="57" name="customerMessage" placeholder="Message" value=""></textarea><br /><br />
				<input class="btn" type="submit" name="submit" value="Submit" />
			</form>			
		</div>	
	</div>
	<footer class="col-sm-12 copyright">
		<p>&copy; 2016. All Rights Reserved. Powered by Mark's Web Development.</p>
	</footer>	
</div>
<script src="scripts/jquery-2.2.3.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
</body>
</html>