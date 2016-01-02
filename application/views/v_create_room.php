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
			<div class="alert alert-success" role="alert">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
		<?php } else if( strlen($this->session->flashdata('error') ) > 0) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $this->session->flashdata('error'); ?>
			</div>
		<?php } ?>
	</div>
	<br>
	<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php echo form_open_multipart('Management/insertRoom/'.$location_details[0]->ID);?>
		<form class="form" role="form">
		  	<div class="form-group">
		    	<label for="text">Toa nimetus</label>
		    	<input type="text" class="form-control" name="room_name" value="<?php echo set_value('room_name');?>" autocomplete="off">
		  	</div>
		  	<div class="form-group">
		  		<label for="text">Hind</label>
		    	<input type="text" class="form-control" name="room_price" value="<?php echo set_value('room_price');?>" autocomplete="off">
		 	</div>
		  	<div class="form-group">
		    	<label for="text">Toa kirjeldus</label>
		    	<textarea class="form-control" type="text" rows="5" name="room_description" autocomplete="off"><?php echo set_value('room_description');?></textarea>
		  	</div>
			<div class="form-group">
				<label for="category">Kategooria</label>
				<select class="form-control" name="selected_room_category">
					<?php for( $i = 0; $i < sizeOf($categories); $i++) { ?>
						<option value="<?php echo $categories[$i]->category_id?>" selected><?php echo $categories[$i]->category_name; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="fileInput">Toa põhipilt</label>
				<input type="file" id="userfile" name="userfile" size="20">
				<p class="help-block">.jpg .png .gif .tif .tiff</p>
			</div>
			<input type="hidden" name="item_photo" value="not empty"></input>
		  	<button type="submit" class="btn btn-success btn-block">Loo tuba</button>
		</form>
		<?php form_close(); ?>
	</div>
	<div class="col lg-6 col-md-6 col-sm-6 col-xs-12"></div>
</div>