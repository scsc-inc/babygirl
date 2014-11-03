
	<div id="content">

		<h1>My Thank You notes</h1>
		
	
		<?php 

			echo validation_errors();
	
			foreach($results as $row){
		
				echo "<b>" . $row->sponsor_name  $row->note  . "</b><br>";

			}
			
		?>		
		<p>
		
			<?php echo anchor(base_url()."index.php/home/say_thankyou", "Add Thank You note", array('class' => 'button')); ?>
		
		</p>

	</div>
