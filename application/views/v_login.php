<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ditto</title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url("bootstrap/css/bootstrap.min.css");?>" rel="stylesheet">
		<link href="<?php echo base_url("css/styles.css");?>" rel="stylesheet">
    </head>
<body>
	<?php $this->lang->load('tekst_lang', 'estonian')?>
	<?php echo form_open("User/login");?>
		<div class="text-center">
			<div class="col lg-4 col-md-4 col-sm-4 col-xs-12"></div>
			<div class="col lg-4 col-md-4 col-sm-4 col-xs-12">
				<br>
				<?php echo validation_errors(); ?>
				<?php if ( strlen($this->session->flashdata('error') ) > 0) { ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php } ?>
				<br>
				<form>
	  				<div class="form-group">
	    				<label for="text"><?php echo $this->lang->line('first_name_req')?></label>
	    				<input type="text" class="form-control" name="username" placeholder="<?php echo $this->lang->line('username')?>" autocomplete="off">
	  	  			</div>
	  	  			<div class="form-group">
	    				<label for="password"><?php echo $this->lang->line('password_req')?></label>
	    				<input type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('password')?>">
	 	   			</div>
					<button type="submit" class="btn btn-success btn-block"><?php echo $this->lang->line('btn_login');?></button>
				</form>
			</div>
			<div class="col lg-4 col-md-4 col-sm-4 col-xs-12"></div>
			<div id="pin_field">&nbsp</div>
		</div>
