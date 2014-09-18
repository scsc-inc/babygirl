<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login Page</title>

</head>
<body>
<h1>Login</h1>
<div id="container">
	<?php 
		echo form_open("home/login_validation");
		echo validation_errors();
		echo "</p> Email: ";
		echo form_input("email");
		echo "</p> Password: ";
		echo form_password("password");
		echo "</p>";
		echo form_submit("submit","Login");		
		echo "</p>";
		
		echo form_close();
	
	?>

	<div id="footer">
		<p>Copywrite (c) 2014 www.scsc-inc.com All rights reserved</p>
	</div>	
</div>

</body>
</html>