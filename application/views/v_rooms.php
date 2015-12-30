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
		<?php } ?>
	</div>
	<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php for( $i = 0; $i < sizeOf($rooms); $i++) { ?>
			
		<?php } ?>
	</div>
	<div class="col lg-6 col-md-6 col-sm-6 col-xs-12"></div>
</div>