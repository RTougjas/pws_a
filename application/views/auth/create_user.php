<?php $this->lang->load('tekst_lang', 'estonian')?>
<?php echo form_open("User/create_user");?>
<div class="container">
	<div class="row">
			<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
				<?php echo validation_errors(); ?>
				<?php if ( strlen($this->session->flashdata('success') ) > 0) { ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php } ?>
				<h1>
					<?php if ( strlen($title) > 0) { ?>
						<span class="label label-info"><?php echo $title; ?></span>
					<?php } ?>
				</h1>
				<br>
				<form>
		  			<div class="form-group">
		    			<label for="text"><?php echo $this->lang->line('first_name_req')?></label>
		    			<input type="text" class="form-control" name="first_name" placeholder="eesnimi" autocomplete="off">
		  	  		</div>
		  			<div class="form-group">
		    			<label for="text"><?php echo $this->lang->line('last_name_req')?></label>
		    			<input type="text" class="form-control" name="last_name" placeholder="perekonnanimi" autocomplete="off">
		  	  		</div>
		  			<div class="form-group">
		    			<label for="email"><?php echo $this->lang->line('email')?></label>
		    			<input type="email" class="form-control" name="email" placeholder="email" autocomplete="off">
		  	  		</div>
					<div class="form-group">
						<label for="location">Asukoht</label>
						<select class="form-control" name="group">
						    <?php for( $i = 0; $i < sizeof($groups); $i++) { ?>
								<option value="<?php echo $groups[$i]->id?>"><?php echo $groups[$i]->name;?></option>
							<?php } ?>
						</select>
					</div>
		  			<div class="form-group">
		    			<label for="password"><?php echo $this->lang->line('password_req')?></label>
		    			<input type="password" class="form-control" name="password" placeholder="parool" >
		  	  		</div>
		  			<div class="form-group">
		    			<label for="password"><?php echo $this->lang->line('password_confirm_req')?></label>
		    			<input type="password" class="form-control" name="password_confirm" placeholder="parool uuesti" >
		  	  		</div>
					<button type="submit" class="btn btn-success btn-block"><?php echo $this->lang->line('btn_create_user');?></button>
					<br>
				</form>
			</div>
			<div class="col lg-3 col-md-3 col-sm-3 col-xs-12"></div>
			<div class="col lg-3 col-md-3 col-sm-3 col-xs-12"></div>
		</div>
</div>	
<?php echo form_close();?>
