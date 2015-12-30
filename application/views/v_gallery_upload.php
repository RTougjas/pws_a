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
	</div>
	<div class="col lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="row">
			<?php for( $i = 0; $i < sizeOf($photos); $i++) { ?>
			    <a href="#" class="thumbnail">
			      <img src="<?php echo $photos[$i]->url; ?>">
			    </a>
			<?php } ?>
		  </div>
		</div>
	</div>
	<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php echo form_open_multipart('Management/doUpload/'.$location_details[0]->ID);?>
	    <div class="form-group">
	    	<label for="fileInput">Lisa failina</label>
	            <input type="file" id="userfile" name="userfile" size="20">
	            <p class="help-block">.jpg .png .gif .tif .tiff</p>
	    </div>
		<input type="submit" class="btn btn-primary" value="Lae pilt">
	</div>
	<div class="col lg-3 col-md-3 col-sm-3 col-xs-12"></div>
</div>