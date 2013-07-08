<?php $this->load->view( 'common/meta' ); ?>
<body>
	<div id="loading_layer" style="display:none"><img src="<?php echo base_url(); ?>static/img/ajax_loader.gif" alt="" /></div>
	
	<div id="maincontainer" class="clearfix">
		<?php $this->load->view( 'common/header' ); ?>
		
		<div id="contentwrapper">
			<div class="main_content">
				<?php $this->load->view( 'common/breadcrumb' ); ?>
				
				<div class="row-fluid">
					<div class="span12">
						<h3 class="heading">Selamat Datang di Sistem Informasi Surat</h3>
						<div class="alert alert-info">Sistem Informasi Surat adalah ....</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view( 'common/sidebar' ); ?>
	</div>
	
	<?php $this->load->view( 'common/js' ); ?>
	<script>
		$(document).ready(function() {
			setTimeout('$("html").removeClass("js")', 300);
		});
	</script>
</body>
</html>