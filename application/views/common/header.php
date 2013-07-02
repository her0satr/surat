<?php
	$is_login = true;
//	$user = $this->User_model->get_session();
?>
<header id="cnt-header">
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="<?php echo site_url('panel/home'); ?>"><i class="icon-home icon-white"></i> Admin Surat</a>
				<ul class="nav user_menu pull-right">
					<?php if ($is_login) { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo @$user['fullname']; ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">asjdhg</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url('logout'); ?>">Log Out</a></li>
							</ul>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</header>