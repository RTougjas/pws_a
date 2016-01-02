<?php $current_url = current_url(); ?>
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
	</div> <!-- row -->
	<div class="row">
		<div class="text-center">
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
	</div> <!-- row -->
	<br>
	<div class="container">
		<div class="row">
			<?php for( $i = 0; $i < sizeOf($photos); $i++) { ?>
				<div class="col lg-3 col-md-3 col-sm-3 col-xs-6">
					<div class="well">
					<?php echo form_open('Management/buttonSelector/'.$location_details[0]->ID) ?>
					<form>
						<input type="hidden" name="selected_photo" value="<?php echo $photos[$i]->ID; ?>">
						<input type="hidden" name="filename" value="<?php echo $photos[$i]->filename; ?>">
			    		<a href="#" class="thumbnail"><img src="<?php echo $photos[$i]->url; ?>">
			    		</a>
						<button type="submit" name="action" value="delete_photo" class="btn btn-danger">Kustuta</button>
					</form>
					<?php form_close(); ?>
					</div>
				</div>
			<?php } ?>
		</div> <!-- row -->
	</div> <!-- container -->
	<div class="col lg-2 col-md-2 col-sm-2 col-xs-12"></div>
	<div class="container">
		<div class="row">
			<div class="col lg-3 col-md-3 col-sm-3 col-xs-12"></div>
			<div class="col lg-3 col-md-3 col-sm-3 col-xs-12">
			<?php echo form_open_multipart('Management/doUpload/'.$location_details[0]->ID);?>
				<div class="form-group">
					<label for="fileInput">Lisa failina</label>
					<input type="file" id="userfile" name="userfile" size="20">
					<p class="help-block">.jpg .png .gif .tif .tiff</p>
				</div>
				<input type="submit" class="btn btn-primary" value="Lae pilt">
				<?php form_close();?>
			</div>
			<div class="col lg-3 col-md-3 col-sm-3 col-xs-12"></div>
			<div class="col lg-3 col-md-3 col-sm-3 col-xs-12"></div>
		</div>
	</div>
</div>