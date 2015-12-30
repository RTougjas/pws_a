<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin</title>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url("bootstrap/css/bootstrap.min.css");?>" rel="stylesheet">
		<link href="<?php echo base_url("css/styles.css");?>" rel="stylesheet">
		<?php $this->lang->load( 'tekst_lang', 'estonian' )?>
		<?php $location = $this->session->userdata( 'location' );?>
    </head>
<body>	
	<div class="container">
		<div class="row">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Brand</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<?php for( $i = 0; $i < sizeOf($location); $i++) { ?>
								<?php if( $location[$i]->location_id == 1 ) { ?>
									<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tartu<span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo site_url('Menu/displayMenuItems/'.$location[$i]->location_id);?>">Tooted</a></li>
											<li><a href="#">Toodete kategooriad</a></li>
											<li><a href="#">Something else here</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#">Separated link</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#">One more separated link</a></li>
										</ul>
									</li>
								<?php } else if ( $location[$i]->location_id == 2) { ?>
									<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Võru<span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="#">Menüü</a></li>
											<li><a href="#"></a></li>
											<li><a href="#">Toad</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#">Separated link</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#">One more separated link</a></li>
										</ul>
									</li>
								<?php } ?>
							<?php } ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('identity'); ?><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('user/create_user'); ?>">Loo kasutaja</a></li>
									<li><a href="<?php echo site_url('user/index'); ?>">Kasutajad</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="<?php echo site_url('user/change_password'); ?>">Muuda parool</a></li>
									<li><a href="<?php echo site_url('user/logout'); ?>">Logi välja</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div> <!-- row -->
	</div> <!-- container -->