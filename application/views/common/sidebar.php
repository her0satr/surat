<?php
	preg_match('/trunk\/([a-z0-9]+)\//', $_SERVER['REQUEST_URI'], $match);
	$group_name = (!empty($match[1])) ? $match[1] : 'surat';
?>
<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar"><div class="antiScroll"><div class="antiscroll-inner"><div class="antiscroll-content"><div class="sidebar_inner">
	<div id="side_accordion" class="accordion">
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-1" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
					<i class="icon-folder-close"></i> Surat
				</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'surat') ? 'in' : ''; ?>" id="sub-1">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<!-- <li><a href="<?php echo base_url('surat/key'); ?>">Key</a></li>	-->
						<li><a href="<?php echo base_url('surat/letter'); ?>">Dokumentasi Surat</a></li>
						<li><a href="<?php echo base_url('surat/letter_new'); ?>">Pembuatan Surat</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-2" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle"><i class="icon-th"></i> Administrator</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'administrator') ? 'in' : ''; ?>" id="sub-2">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="<?php echo base_url('administrator/user'); ?>">Pengguna</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-3" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle"><i class="icon-th"></i> Master</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'master') ? 'in' : ''; ?>" id="sub-3">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="<?php echo base_url('master/letter_type'); ?>">Jenis Surat</a></li>
						<li><a href="<?php echo base_url('master/user_type'); ?>">Jenis Pengguna</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="push"></div>
</div></div></div></div></div>