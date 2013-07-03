<?php
	$array_menu = array( 'menu' => array('Master', 'Jenis Pengguna') );
	
	$user = $this->User_model->get_session();
?>

<?php $this->load->view( 'common/meta' ); ?>
<body>
	<div id="loading_layer hide"><img src="<?php echo base_url(); ?>static/img/ajax_loader.gif" alt="" /></div>
	
	<div id="maincontainer" class="clearfix">
		<?php $this->load->view( 'common/header' ); ?>
		<div class="hide">
			<div id="RawUser"><?php echo json_encode($user); ?></div>
		</div>
		
		<div id="WinLetterType" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
			<div class="modal-header">
				<a href="#" class="close" data-dismiss="modal">&times;</a>
				<h3>Form Jenis Pengguna</h3>
            </div>
			<div class="modal-body" style="padding-left: 0px;">
				<div class="pad-alert" style="padding-left: 15px;"></div>
				<form class="form-horizontal" style="padding-left: 0px;">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="action" value="update" />
					
					<div class="control-group">
						<label class="control-label" for="input_name">Nama</label>
						<div class="controls">
							<input type="text" id="input_name" name="name" placeholder="Nama Jenis Pengguna" class="span5" rel="twipsy" />
                        </div>
                    </div>
                </form>
            </div>
			<div class="modal-footer">
				<a class="btn cursor cancel">Cancel</a>
				<a class="btn cursor save btn-primary">OK</a>
            </div>
        </div>
		
		<div id="contentwrapper">
			<div class="main_content">
				<?php $this->load->view( 'common/breadcrumb', array( 'array_menu' => $array_menu ) ); ?>
				
				<div class="row-fluid">
					<div class="btn-group">
						<button class="btn btn-gebo AddLetterType">Tambah</button>
                    </div>
                </div>
				
				<div class="row-fluid">
					<div class="span12">
						<table id="grid-letter" class="table table-striped table-bordered dTableR">
							<thead><tr>
								<th>Nama</th>
								<th style="width: 80px;">&nbsp;</th>
							</tr></thead>
							<tbody><tr><td class="dataTables_empty">Loading data from server</td></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
		<?php $this->load->view( 'common/sidebar' ); ?>
    </div>
	
	<?php $this->load->view( 'common/js' ); ?>
	<script>
		$(document).ready(function() {
			grid_letter = null;
			setTimeout('$("html").removeClass("js")', 300);
			
			// user
			var RawUser = $('#RawUser').text();
			eval('var user = ' + RawUser);
			
			Func.InitForm({
				Container: '#WinLetterType',
				rule: { name: { required: true } }
            });
			
			$('.AddLetterType').click(function() {
				$('#WinLetterType form')[0].reset()
				$('#WinLetterType [name="id"]').val(0);
				$('#WinLetterType').modal();
            });
			$('#WinLetterType .save').click(function() {
				if (! $('#WinLetterType form').valid()) {
					return;
                }
				
				var param = Site.Form.GetValue('WinLetterType');
				Func.ajax({ url: web.base + 'master/user_type/action', param: param, callback: function(result) {
					Func.show_message({ message: result.message })
					if (result.status == 1) {
						grid_letter.load();
						$('#WinLetterType').modal('hide');
					}
                } });
            });
			$('#WinLetterType .cancel').click(function() {
				$('#WinLetterType').modal('hide');
            });
			
			function init_table() {
				grid_letter = $('#grid-letter').dataTable( {
					"aaSorting": [[0, 'desc']], "sServerMethod": "POST",
					"bProcessing": true, "bServerSide": true, "sPaginationType": "bootstrap",
					"sAjaxSource": web.base + 'master/user_type/grid',
					"aoColumns": [ null, { "sClass": "center", "bSortable": false } ]
                } );
				grid_letter.load = Func.reload({ id: 'grid-letter' });
				
				$('#grid-letter').on('click','tbody td img.edit', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					$('#WinLetterType [name="id"]').val(record.id);
					$('#WinLetterType [name="name"]').val(record.name);
					$('#WinLetterType').modal();
                });
				
				$('#grid-letter').on('click','tbody td img.delete', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					
					Func.confirm_delete({
						data: { action: 'delete', id: record.id },
						url: web.base + 'master/user_type/action',
						grid: grid_letter
                    });
                });
            }
			init_table();
        });
    </script>
</body>
</html>