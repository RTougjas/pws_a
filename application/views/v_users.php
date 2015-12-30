<?php $this->lang->load('tekst_lang', 'estonian')?>
<?php echo form_open("User/login");?>
<div class="container">
	<div class="row">
		<div class="col lg-6 col-md-6 col-sm-6 col-xs-12">
			<h1>
				<?php if ( strlen($title) > 0) { ?>
					<span class="label label-info"><?php echo $title; ?></span>
				<?php } ?>
			</h1>
			<br>
			<table class="table">
				<tr>
					<th>Eesnimi</th>
					<th>Perenimi</th>
					<th>Email</th>
					<th>Õigused</th>
					<th></th>
				</tr>
				<?php for( $i = 0; $i < sizeOf($users); $i++) { ?>
					<tr>
						<td><?php echo $users[$i]->first_name; ?></td>
						<td><?php echo $users[$i]->last_name; ?></td>
							<!-- <td><a href="<?php echo site_url('User/edit_group/'.$users[$i]->user_id)?>"><?php echo $users[$i]->name; ?></td> -->
						<td><?php echo $users[$i]->email; ?></td>
						<td><a href=""><?php echo $users[$i]->name; ?></td>
						<?php if( !$this->ion_auth->is_admin() ) { ?>
							<td><a href="<?php echo site_url('User/deleteUser/'.$users[$i]->user_id) ;?>" class="btn btn-danger disabled" role="button">Kustuta</a></td>
						<?php } else { ?>
							<?php if( $users[$i]->user_id != $this->session->userdata('user_id')) { ?>
								<td><a href="<?php echo site_url('User/deleteUser/'.$users[$i]->user_id) ;?>" class="btn btn-danger" role="button">Kustuta</a></td>
							<?php } else { ?>
								<td><a href="<?php echo site_url('User/deleteUser/'.$users[$i]->user_id) ;?>" class="btn btn-danger disabled" role="button">Kustuta</a></td>
							<?php } ?>
						<?php } ?>
						</tr>
				<?php } ?>
			</table>
		</div>
		<div class="col lg-3 col-md-3 col-sm-3 col-xs-12"></div>
	</div>
</div>