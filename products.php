<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>Products</title>
	<meta charset="utf-8" />
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
				<li class="active"><a href="#">Products</a></li>
				<li><a href="portfolio.html">Portfolio</a></li>
				<li><a href="about.html">About</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</div>		
	</div>
</nav>
<div class="container" id="main">		
	<div class="row">
		<div class="container col-sm-12">
			<img class="img-responsive" id="productsImage" src="images/photo.jpg" alt="picture of codes"/>
		</div>		
		<div class="col-sm-12">			
			<table id="products">
				<tr>
					<th></th>
					<th>BASIC</th>
					<th>AFFORDABLE</th>
					<th>ADVANCED</th>					
					<th>CMS</th>
				</tr>
				<tr>
					<td>Number of Pages</td>
					<td>1 - 3</td>
					<td>4 - 6</td>
					<td>7 - 9</td>
					<td>TBD</td>
				</tr>
				<tr>
					<td>Database Collections</td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-check" aria-hidden="true"></span></td>
					<td><span class="fa fa-check" aria-hidden="true"></span></td>
				</tr>
				<tr>
					<td>Contact Form</td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-check" aria-hidden="true"></span></td>
					<td><span class="fa fa-check" aria-hidden="true"></span></td>
					<td><span class="fa fa-check" aria-hidden="true"></span></td>
				</tr>
				<tr>
					<td>Administrative Access</td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-check" aria-hidden="true"></span></td>
				</tr>
				<tr>
					<td>Hosting (monthly)</td>
					<td>$10</td>
					<td>$10</td>
					<td>$10</td>
					<td>TBD</td>
				</tr>
				<tr>
					<td>Hourly Rate</td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td>$50</td>
					<td>$50</td>
				</tr>
				<tr>
					<td>Flat Rate</td>
					<td>$295</td>
					<td>$395</td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
					<td><span class="fa fa-times" aria-hidden="true"></span></td>
				</tr>
			</table>			
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