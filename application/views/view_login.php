<div id="content">
	
	<h1>Login</h1>

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

	</p> <?php echo anchor(base_url()."home/register", "Register"); ?>
	
	<div id="footer">
		<p>Copywrite (c) 2014 www.scsc-inc.com All rights reserved</p>
	</div>	
</div>
