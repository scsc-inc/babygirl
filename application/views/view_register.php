<div id='content'>
	
	<h1>Register</h1>
	
	<?php 
		echo form_open('index.php/home/register_validation');
		
		echo validation_errors();
		
		echo '</p> Email: ';
		echo form_input('email');
		echo '</p> Enter Password: ';
		echo form_password('pw1');
		echo '</p> Confirm Password: ';
		echo form_password('pw2');
		echo '</p>';
		echo form_submit('register','Register');		
		echo '</p>';
		
		echo form_close();
	
	?>

	</p> <?php echo anchor(base_url().'home/login', 'Return to Login Screen'); ?>
	
</div>
