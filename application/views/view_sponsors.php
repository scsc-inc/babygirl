
	<div id="content">

		<h1>My Sponsors</h1>
		
	
		<?php 

			echo validation_errors();
	
			foreach($results as $row){
		
				echo "<b>" . $row->sponsor_name . "</b><br>";

			}
			
		?>		
		<p>
		
			<?php echo anchor(base_url()."index.php/home/sponsors_form", "Add Sponsor", array('class' => 'button')); ?>
		
		</p>

	</div>
