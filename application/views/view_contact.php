	<div id="contact">
		<?php 
			$this->load->helper("form");
			echo $message;
			echo validation_errors();
			
			echo form_open("index.php/home/send_email");
			
			$data = array (
				"name" => "FullName",
				"id" => "FullName",
				"value" => set_value("FullName")
			);			
			echo form_label("Name","FullName");
			
			echo form_input($data);

			$data = array (
				"name" => "Email",
				"id" => "Email",
				"value" => set_value("Email")
			);			
			echo form_label("Email","Email");
			
			echo form_input($data);

			$data = array (
				"name" => "Message",
				"id" => "Message",
				"value" => set_value("Message")
			);			
			echo form_label("Message","Message");
			
			echo form_textarea($data);			
			
			echo form_submit("Submit","Submit");
			echo form_close();
		?>
	</div>
