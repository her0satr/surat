<?php
	preg_match('/panel\/([a-z0-9]+)\//', $_SERVER['REQUEST_URI'], $match);
	$group_name = (!empty($match[1])) ? $match[1] : 'product';
?>
<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar"><div class="antiScroll"><div class="antiscroll-inner"><div class="antiscroll-content"><div class="sidebar_inner">
	<div id="side_accordion" class="accordion">
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-1" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
					<i class="icon-folder-close"></i> Product
				</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'product') ? 'in' : ''; ?>" id="sub-1">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="<?php echo site_url('panel/product/blog'); ?>">Blog</a></li>
						<li><a href="<?php echo site_url('panel/product/catalog'); ?>">Catalog</a></li>
                        <li><a href="<?php echo site_url('panel/product/category'); ?>">Category</a></li>
						<li><a href="<?php echo site_url('panel/product/item'); ?>">Item</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-2" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle"><i class="icon-th"></i> Order</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'order') ? 'in' : ''; ?>" id="sub-2">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="<?php echo site_url('panel/order/nota'); ?>">Nota</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-3" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle"><i class="icon-th"></i> Store</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'store') ? 'in' : ''; ?>" id="sub-3">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="<?php echo site_url('panel/store/store'); ?>">Config</a></li>
						<!--	<li><a href="<?php echo site_url('panel/store/theme'); ?>">Theme</a></li>	-->
						<li><a href="<?php echo site_url('panel/store/store_image_slide'); ?>">Image Slide</a></li>
						<li><a href="<?php echo site_url('panel/store/store_payment_method'); ?>">Payment</a></li>
						<li><a href="<?php echo site_url('panel/store/bank_account'); ?>">Bank Account</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-4" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle"><i class="icon-th"></i> Account</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'account') ? 'in' : ''; ?>" id="sub-4">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="<?php echo site_url('panel/account/user'); ?>">User</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#sub-5" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle"><i class="icon-th"></i> Master</a>
			</div>
			<div class="accordion-body collapse <?php echo ($group_name == 'master') ? 'in' : ''; ?>" id="sub-5">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="<?php echo site_url('panel/master/blog_status'); ?>">Blog Status</a></li>
						<li><a href="<?php echo site_url('panel/master/item_status'); ?>">Item Status</a></li>
						<li><a href="<?php echo site_url('panel/master/currency'); ?>">Currency</a></li>
						<li><a href="<?php echo site_url('panel/master/payment_method'); ?>">Payment Method</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!--
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#collapseThree" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
					<i class="icon-user"></i> Account manager
				</a>
                </div>
			<div class="accordion-body collapse" id="collapseThree">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li><a href="javascript:void(0)">Members</a></li>
						<li><a href="javascript:void(0)">Members groups</a></li>
						<li><a href="javascript:void(0)">Users</a></li>
						<li><a href="javascript:void(0)">Users groups</a></li>
					</ul>
					
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
					<i class="icon-cog"></i> Configuration
				</a>
			</div>
			<div class="accordion-body collapse" id="collapseFour">
				<div class="accordion-inner">
					<ul class="nav nav-list">
						<li class="nav-header">People</li>
						<li class="active"><a href="javascript:void(0)">Account Settings</a></li>
						<li><a href="javascript:void(0)">IP Adress Blocking</a></li>
						<li class="nav-header">System</li>
						<li><a href="javascript:void(0)">Site information</a></li>
						<li><a href="javascript:void(0)">Actions</a></li>
						<li><a href="javascript:void(0)">Cron</a></li>
						<li class="divider"></li>
						<li><a href="javascript:void(0)">Help</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				<a href="#collapseLong" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
					<i class="icon-leaf"></i> Long content (scrollbar)
				</a>
			</div>
			<div class="accordion-body collapse" id="collapseLong">
				<div class="accordion-inner">
					Some text to show sidebar scroll bar<br>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus rhoncus, orci ac fermentum imperdiet, purus sapien pharetra diam, at varius nibh tellus tristique sem. Nulla congue odio ut augue volutpat congue. Nullam id nisl ut augue posuere ullamcorper vitae eget nunc. Quisque justo turpis, tristique non fermentum ac, feugiat quis lorem. Ut pellentesque, turpis quis auctor laoreet, nibh erat volutpat est, id mattis mi elit non massa. Suspendisse diam dui, fringilla id pretium non, dapibus eget enim. Duis fermentum quam a leo luctus tincidunt euismod sit amet arcu. Duis bibendum ultricies libero sed feugiat. Duis ut sapien risus. Morbi non nulla sit amet eros fringilla blandit id vel augue. Nam placerat ligula lacinia tellus molestie molestie vestibulum leo tincidunt.
					Duis auctor varius risus vitae commodo. Fusce nec odio massa, ut dapibus justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus, mauris sit amet feugiat tempor, nulla diam gravida magna, in facilisis sapien tellus non ligula. Mauris sapien turpis, sodales ac lacinia sit amet, porttitor in lacus. Pellentesque tincidunt malesuada magna, in egestas augue sodales vel. Praesent iaculis sapien at ante sodales facilisis.
				</div>
			</div>
		</div>
		-->
	</div>
	<div class="push"></div>
</div></div></div></div></div>