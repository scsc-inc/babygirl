<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Members Page</title>

</head>
<body>

<div id="container">

<h1>Members</h1>
	<?php 
		echo "<pre>";
		print_r($this->session->all_userdata());
		echo "</pre>";
				
		echo anchor(base_url()."home/logout", "Logout"); 
	?>

	<div id="footer">
		<p>Copywrite (c) 2014 www.scsc-inc.com All rights reserved</p>
	</div>	
</div>

</body>
</html>