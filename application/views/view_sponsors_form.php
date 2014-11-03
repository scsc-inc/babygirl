<div id="content">
	
	<h1>Add Sponsor</h1>

	<?php 
		echo form_open("index.php/home/insert_sponsor");
		
		echo validation_errors();

		echo "</p> Sponsor: ";
		echo form_input("sponsor_name");
		
		echo "<p>";
		$data = array(
			'name'    => 'submit',    // button name
			'content' => 'Submit',    // this is the button text
			'type'    => 'submit',  // button type (important!)
			'class'   => 'button'
		);
		echo form_button($data);

		$data = array(
			'name'    => 'sponsor_list',
			'content' => 'Sponsors',
			'class'   => 'button',
			'type'    => 'submit',  // button type (important!)
			'onclick' => 'index.php/home/sponsors_form;' // you can pass inline statements through the parameter array
		);

		echo form_button($data);
		echo "</p>";
	
	echo form_close();
	
	?>

</div>
