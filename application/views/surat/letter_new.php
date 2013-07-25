<?php
	$array_menu = array( 'menu' => array( 'Surat', 'Pembuatan Surat' ) );
	
	$user = $this->User_model->get_session();
	$array_letter_type = $this->Letter_Type_model->get_array();
?>

<?php $this->load->view( 'common/meta' ); ?>
<body>
	<div id="loading_layer"><img src="<?php echo base_url(); ?>static/img/ajax_loader.gif" alt="" /></div>
	
	<div id="maincontainer" class="clearfix">
		<?php $this->load->view( 'common/header' ); ?>
		<div class="hide">
			<div id="RawUser"><?php echo json_encode($user); ?></div>
		</div>
		
		<div id="WinLetter" class="modal modal-bigest hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
			<div class="modal-header">
				<a href="#" class="close" data-dismiss="modal">&times;</a>
				<h3>Form Pembuatan Surat</h3>
            </div>
			<div class="modal-body" style="padding-left: 0px;">
				<div class="pad-alert" style="padding-left: 15px;"></div>
				<form class="form-horizontal" style="padding-left: 0px;">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="action" value="update" />
					
					<div class="control-group">
						<label class="control-label">Jenis Surat</label>
						<div class="controls"><select name="letter_type_id" class="span5">
							<?php echo ShowOption(array( 'Array' => $array_letter_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
						</select></div>
					</div>
					<div class="control-group">
						<label class="control-label">No Surat</label>
						<div class="controls"><input type="text" name="no_surat" placeholder="No Surat" class="span5" rel="twipsy" /></div>
                    </div>
					<div class="control-group">
						<label class="control-label">Tanggal</label>
						<div class="controls"><input type="text" name="date_surat" placeholder="Tanggal Surat" class="span3 datepicker" rel="twipsy" /></div>
                    </div>
					<div style="padding: 0 0 0 10px;">
						<textarea style="width: 100%; height: 500px;" class="tinymce" name="desc"></textarea>
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
						<button class="btn btn-gebo AddLetter">Tambah</button>
                    </div>
                </div>
				
				<div class="row-fluid">
					<div class="span12">
						<table id="grid-letter" class="table table-striped table-bordered dTableR">
							<thead><tr>
								<th>Tanggal</th>
								<th>Jenis Surat</th>
								<th>No Surat</th>
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
				Container: '#WinLetter',
				rule: { letter_type_id: { required: true }, no_surat: { required: true }, date_surat: { required: true } }
            });
			
			$('.AddLetter').click(function() {
				$('#WinLetter form')[0].reset()
				$('#WinLetter [name="id"]').val(0);
				$('#WinLetter').modal();
            });
			$('#WinLetter .save').click(function() {
				if (! $('#WinLetter form').valid()) {
					return;
                }
				
				var param = Site.Form.GetValue('WinLetter');
				param.date_surat = Func.SwapDate(param.date_surat);
				Func.ajax({ url: web.base + 'surat/letter_new/action', param: param, callback: function(result) {
					Func.show_message({ message: result.message })
					if (result.status == 1) {
						grid_letter.load();
						$('#WinLetter').modal('hide');
					}
                } });
            });
			$('#WinLetter .cancel').click(function() {
				$('#WinLetter').modal('hide');
            });
			
			function init_table() {
				grid_letter = $('#grid-letter').dataTable( {
					"aaSorting": [[0, 'asc']], "sServerMethod": "POST",
					"bProcessing": true, "bServerSide": true, "sPaginationType": "bootstrap",
					"sAjaxSource": web.base + 'surat/letter_new/grid',
					"aoColumns": [ null, null, null, { "sClass": "center", "bSortable": false } ]
                } );
				grid_letter.load = Func.reload({ id: 'grid-letter' });
				
				$('#grid-letter').on('click','tbody td img.edit', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					$('#WinLetter [name="id"]').val(record.id);
					$('#WinLetter [name="letter_type_id"]').val(record.letter_type_id);
					$('#WinLetter [name="no_surat"]').val(record.no_surat);
					$('#WinLetter [name="date_surat"]').val(Func.SwapDate(record.date_surat));
					$('#WinLetter [name="desc"]').val(record.desc);
					$('#WinLetter').modal();
                });
				
				$('#grid-letter').on('click','tbody td img.delete', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					
					Func.confirm_delete({
						data: { action: 'delete', id: record.id },
						url: web.base + 'surat/letter_new/action',
						grid: grid_letter
                    });
                });
				
				$('#grid-letter').on('click','tbody td img.print', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					window.open(web.base + 'surat/letter_new/cetak/' + record.id);
                });
            }
			init_table();
        });
    </script>
</body>
</html>