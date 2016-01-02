<?php $uri_string = uri_string(); ?>
<?php echo $uri_string; ?>
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
		<h1>Toa kirjeldus</h1>
		<?php echo form_open_multipart('Management/insertRoom/'.$location_details[0]->ID);?>
		<form class="form" role="form">
			<input type="hidden" name="room_id" value="<?php echo $room_details[0]->menuItem_id; ?>">
		  	<div class="form-group">
		    	<label for="text">Toa nimetus</label>
		    	<input type="text" class="form-control" name="room_name" value="<?php echo $room_details[0]->menuItem_name; ?>" autocomplete="off">
		  	</div>
		  	<div class="form-group">
		  		<label for="text">Hind</label>
		    	<input type="text" class="form-control" name="room_price" value="<?php echo $room_details[0]->menuItem_price; ?>" autocomplete="off">
		 	</div>
		  	<div class="form-group">
		    	<label for="text">Toa kirjeldus</label>
		    	<textarea class="form-control" type="text" rows="5" name="room_description" autocomplete="off"><?php echo $room_details[0]->menuItem_description; ?></textarea>
		  	</div>
			<div class="form-group">
				<label for="category">Kategooria</label>
				<select class="form-control" name="selected_room_category">
					<?php for( $i = 0; $i < sizeOf($categories); $i++) { ?>
						<?php if( $room_details[0]->category_id == $categories[$i]->category_id) { ?>
							<option value="<?php echo $categories[$i]->category_id?>" selected><?php echo $categories[$i]->category_name; ?></option>
						<?php } else { ?>
							<option value="<?php echo $categories[$i]->category_id?>"><?php echo $categories[$i]->category_name; ?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="fileInput">Lisa toale pilt</label>
				<input type="file" id="userfile" name="userfile" size="20">
				<p class="help-block">.jpg .png .gif .tif .tiff</p>
			</div>
			<input type="hidden" name="item_photo" value="not empty"></input>
		  	<button type="submit" class="btn btn-primary btn-block">Salvesta muutused</button>
			<br>
		</form>
		<?php form_close(); ?>
		<?php echo form_open('Management/buttonSelector/'.$location_details[0]->ID.'/'.$uri_string)?>
		<input type="hidden" name="menuItem_id" value="<?php echo $room_details[0]->menuItem_id; ?>">
		<input type="hidden" name="menuItem_name" value="<?php echo $room_details[0]->menuItem_name; ?>">
		<button type="submit" name="action" value="delete_room" class="btn btn-danger">Kustuta tuba</button>
		<?php echo form_close(); ?>
		<br>
	</div>
	<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
		<h1>Toaga seotud pildid</h1>
		<?php for( $i = 0; $i < sizeOf($photos); $i++) { ?>
			<?php echo form_open('Management/buttonSelector/'.$location_details[0]->ID.'/'.$uri_string) ?>
			<div class="well">
			<form>
				<input type="hidden" name="selected_photo" value="<?php echo $photos[$i]->ID; ?>">
				<input type="hidden" name="filename" value="<?php echo $photos[$i]->filename; ?>">
	    		<a href="#" class="thumbnail"><img src="<?php echo $photos[$i]->url; ?>">
	    		</a>
				<button type="submit" name="action" value="delete_photo" class="btn btn-danger btn-block">Kustuta pilt</button>
			</form>
			</div>
		<?php } ?>
	</div>
</div>