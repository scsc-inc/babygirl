<div id="content">
	
	<h1>Register</h1>
	
	<?php 
		echo form_open("home/register_validation");
		
		echo validation_errors();
		
		echo "</p> Email: ";
		echo form_input("email");
		echo "</p> Enter Password: ";
		echo form_password("password1");
		echo "</p> Confirm Password: ";
		echo form_password("password2");
		echo "</p>";
		echo form_submit("submit","Register");		
		echo "</p>";
		
		echo form_close();
	
	?>

	</p> <?php echo anchor(base_url()."home/login", "Return to Login Screen"); ?>
	
	<div id="footer">
		<p>Copywrite (c) 2014 www.scsc-inc.com All rights reserved</p>
	</div>	
</div>
