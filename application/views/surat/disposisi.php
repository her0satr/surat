<?php
	preg_match('/\/(\d+)$/i', $_SERVER['REQUEST_URI'], $match);
	$letter_id = (isset($match[1])) ? $match[1] : 0;
	$letter = $this->Letter_model->get_by_id(array( 'id' => $letter_id ));
	
	$array_menu = array( 'menu' => array('Surat', 'Disposisi Surat') );
	
	$user = $this->User_model->get_session();
	$array_user = $this->User_model->get_array();
?>

<?php $this->load->view( 'common/meta' ); ?>
<style>
.btn_action { width: 80px !important; }
</style>
<body>
	<div id="loading_layer"><img src="<?php echo base_url(); ?>static/img/ajax_loader.gif" alt="" /></div>
	
	<div id="maincontainer" class="clearfix">
		<?php $this->load->view( 'common/header' ); ?>
		<div class="hide">
			<div id="RawUser"><?php echo json_encode($user); ?></div>
			<div id="RawLetter"><?php echo json_encode($letter); ?></div>
		</div>
		
		<div id="WinDisposisi" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
			<div class="modal-header">
				<a href="#" class="close" data-dismiss="modal">&times;</a>
				<h3>Form Disposisi</h3>
            </div>
			<div class="modal-body" style="padding-left: 0px;">
				<div class="pad-alert" style="padding-left: 15px;"></div>
				<form class="form-horizontal" style="padding-left: 0px;">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="letter_id" value="0" />
					<input type="hidden" name="action" value="update" />
					
					<div class="control-group">
						<label class="control-label">Pengguna</label>
						<div class="controls"><select name="user_id">
							<?php echo ShowOption(array( 'Array' => $array_user, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
						</select></div>
                    </div>
					<div class="control-group">
						<label class="control-label">No Agenda</label>
						<div class="controls">
							<input type="text" name="no_agenda" placeholder="No Agenda" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Tanggal Surat</label>
						<div class="controls">
							<input type="text" name="date_letter" placeholder="Tanggal Surat" class="span3 datepicker" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Tanggal Penyelesaian</label>
						<div class="controls">
							<input type="text" name="date_finish" placeholder="Tanggal Penyelesaian" class="span3 datepicker" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">No Tanggal Surat Masuk</label>
						<div class="controls">
							<input type="text" name="no_date_letter" placeholder="No Tanggal Surat Masuk" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Asal Surat</label>
						<div class="controls">
							<input type="text" name="source" placeholder="Asal Surat" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Interuksi Informasi</label>
						<div class="controls">
							<input type="text" name="instruction" placeholder="Interuksi Informasi" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Diterukan</label>
						<div class="controls">
							<input type="text" name="continued" placeholder="Diterukan" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Catatan</label>
						<div class="controls">
							<input type="text" name="note" placeholder="Catatan" class="span5" rel="twipsy" />
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
						<button class="btn btn-gebo AddDisposisi">Tambah</button>
                    </div>
                </div>
				
				<div class="row-fluid">
					<div class="span12">
						<table id="grid-letter" class="table table-striped table-bordered dTableR">
							<thead><tr>
								<th>ID</th>
								<th>Kepada</th>
								<th>No Agenda</th>
								<th>Tanggal Surat</th>
								<th>Tanggal Penyelesaian</th>
								<th class="btn_action">&nbsp;</th>
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
			
			// letter
			var RawLetter = $('#RawLetter').text();
			eval('var letter = ' + RawLetter);
			
			Func.InitForm({
				Container: '#WinDisposisi',
				rule: { user_id: { required: true }, letter_id: { required: true }, no_agenda: { required: true }, date_letter: { required: true } }
            });
			
			$('.AddDisposisi').click(function() {
				$('#WinDisposisi form')[0].reset()
				$('#WinDisposisi [name="id"]').val(0);
				$('#WinDisposisi [name="letter_id"]').val(letter.id);
				$('#WinDisposisi').modal();
            });
			$('#WinDisposisi .save').click(function() {
				if (! $('#WinDisposisi form').valid()) {
					return;
                }
				
				var param = Site.Form.GetValue('WinDisposisi');
				param.date_letter = Func.SwapDate(param.date_letter);
				param.date_finish = Func.SwapDate(param.date_finish);
				Func.ajax({ url: web.base + 'surat/disposisi/action', param: param, callback: function(result) {
					Func.show_message({ message: result.message })
					if (result.status == 1) {
						grid_letter.load();
						$('#WinDisposisi').modal('hide');
					}
                } });
            });
			$('#WinDisposisi .cancel').click(function() {
				$('#WinDisposisi').modal('hide');
            });
			
			function init_table() {
				grid_letter = $('#grid-letter').dataTable( {
					"aaSorting": [[0, 'desc']], "sServerMethod": "POST",
					"bProcessing": true, "bServerSide": true, "sPaginationType": "bootstrap",
					"sAjaxSource": web.base + 'surat/disposisi/grid',
					"fnServerParams": function ( aoData ) { aoData.push( { "name": "letter_id", "value": letter.id }  ) },
					"aoColumns": [ { "bSearchable": false, "bVisible": false }, null, null, null, null, { "sClass": "center", "bSortable": false } ]
                } );
				grid_letter.load = Func.reload({ id: 'grid-letter', hide: true });
				
				$('#grid-letter').on('click','tbody td img.edit', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					
					Func.populate({ cnt: '#WinDisposisi', record: record });
					/*
					$('#WinDisposisi [name="id"]').val(record.id);
					$('#WinDisposisi [name="user_id"]').val(record.user_id);
					$('#WinDisposisi [name="source"]').val(record.source);
					$('#WinDisposisi [name="letter_no"]').val(record.letter_no);
					$('#WinDisposisi [name="public_key"]').val(record.public_key);
					$('#WinDisposisi [name="date_print"]').val(Func.SwapDate(record.date_print));
					$('#WinDisposisi [name="date_confirm"]').val(Func.SwapDate(record.date_confirm));
					$('#WinDisposisi [name="letter_type_id"]').val(record.letter_type_id);
					/*	*/
					
					$('#WinDisposisi').modal();
                });
				
				$('#grid-letter').on('click','tbody td img.delete', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					
					Func.confirm_delete({
						data: { action: 'delete', id: record.id },
						url: web.base + 'surat/disposisi/action',
						grid: grid_letter
                    });
                });
            }
			init_table();
        });
    </script>
</body>
</html>