
	<div id="content">

		<h1>Thank you!</h1>
	

		<?php 
		
			$this->load->helper("form");
	
			echo validation_errors();
			
			echo form_open("index.php/home/insert_thankyou");

			echo "<p class='formfield'>";
			echo "<select size = 1 name = my_sponsors>";
			foreach($results as $row){
		
				echo "<option value = "  . $row->sponsor_id  . ">" . $row->sponsor_name 	. "</option>";

			}
			echo "</select>";
		
			$text_box = array(
				'name'        => 'note',
				'id'          => 'text_box',
				'value'       => '',
				'rows'        => '10',
				'cols'        => '60',
				'style'       => 'width:50%',
			);			
			
			echo "&nbsp;" ;
			
			echo form_label("Note","note");
			
			echo form_textarea($text_box) .  "<br>";			
			
			echo "</p>";
			
			echo form_submit("Submit","Submit");
	
			echo form_close();
			
			
		?>		
			
		
		
	</div>
