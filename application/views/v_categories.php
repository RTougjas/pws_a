<div class="container">
		<div class="row">
			<div class="text-center">
				<h1>
					<?php if ( strlen($title) > 0) { ?>
						<span class="label label-success"><?php echo $title; ?>
							<small>
								<?php echo ' '.$location_details[0]->name; ?>
							</small>
						</span>
					<?php } ?>
				</h1>
			</div>
		</div>
		<div class="row">
			<?php echo validation_errors(); ?>
			<?php if ( strlen($this->session->flashdata('success') ) > 0) { ?>
				<div class="text-center">
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
		<h2>Kõik Kategooriad</h2>
		<br>
		<?php if( sizeOf($categories) == 0 ) { ?>
			<div class="well well-sm">
				Puuduvad kategooriad
			</div>
		<?php } ?>
		<?php for( $i = 0; $i < sizeOf($categories); $i++) { ?>
			<div class="well">
			<?php echo form_open("Management/buttonSelector/".$location_details[0]->ID);?>
			<form class="form">
				<input type="hidden" value="<?php echo $categories[$i]->category_id;?>" name="category_id">
				<div class="form-group">
					<h3><?php echo $categories[$i]->category_name;?></h3>
					<input type="text" class="form-control" name="category_name" value="<?php echo $categories[$i]->category_name;?>" autocomplete="off">
				</div>
				<div class="form-group">
					<label for="category">Üldine kategooria</label>
					<select class="form-control" name="selected_general_category">
						<?php for($j = 0; $j < sizeOf($general_categories); $j++) { ?>
							<?php if( $categories[$i]->general_id == $general_categories[$j]->ID ) { ?>
								<option value="<?php echo $general_categories[$j]->ID?>" selected><?php echo $general_categories[$j]->name; ?></option>
							<?php } else { ?>
								<option value="<?php echo $general_categories[$j]->ID?>"><?php echo $general_categories[$j]->name; ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
			  <button type="submit" class="btn btn-primary btn-block" name="action" value="update_category">Uuenda</button>
			  <br>
			  <button type="submit" class="btn btn-danger" name="action" value="delete_category">Kustuta</button>
			</form>
			</div>
		<?php } ?>
		<br>
	</div>
	<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="row"></div>
		<div class="row"></div>
		<h2>Lisa uus kategooria</h2>
		<br>
		<div class="well">
		<?php echo form_open("Management/insertCategory/".$location_details[0]->ID);?>
		<form class="form">
			<div class="form-group">
		    	<label for="nimetus">Nimetus</label>
		    	<input type="text" class="form-control" name="category_name" autocomplete="off">
		  	</div>
		  	<div class="form-group">
		    	<label for="category">Üldine kategooria</label>
		    	<select class="form-control" name="selected_general_category">
		      	  	<?php for($i = 0; $i < sizeOf($general_categories); $i++) { ?>
						<option value="<?php echo $general_categories[$i]->ID?>"><?php echo $general_categories[$i]->name; ?></option>
					<?php } ?>
		    	</select>
		  	</div>
		  	<button type="submit" class="btn btn-primary btn-block" name="action" value="update">Lisa kategooria</button>
		</form>
		</div>
	</div>
</div>