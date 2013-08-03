<?php
	$array_menu = array( 'menu' => array('Surat', 'Dokumentasi Surat') );
	
	$user = $this->User_model->get_session();
	$array_key = $this->Key_model->get_array();
	$array_letter_type = $this->Letter_Type_model->get_array();
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
			<iframe name="iframe_letter" src="<?php echo base_url('home/upload?callback=upload_letter&filetype=document'); ?>"></iframe>
		</div>
		
		<div id="WinLetter" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
			<div class="modal-header">
				<a href="#" class="close" data-dismiss="modal">&times;</a>
				<h3>Form Surat</h3>
            </div>
			<div class="modal-body" style="padding-left: 0px;">
				<div class="pad-alert" style="padding-left: 15px;"></div>
				<form class="form-horizontal" style="padding-left: 0px;">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="action" value="update" />
					
					<div class="control-group">
						<label class="control-label">Jenis Surat</label>
						<div class="controls"><select name="letter_type_id">
							<?php echo ShowOption(array( 'Array' => $array_letter_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
						</select></div>
					</div>
					<div class="control-group hide">
						<label class="control-label">Kunci</label>
						<div class="controls"><select name="public_key">
							<?php echo ShowOption(array( 'Array' => $array_key, 'ArrayID' => 'name', 'ArrayTitle' => 'name' )); ?>
						</select></div>
                    </div>
					<div class="control-group">
						<label class="control-label">No Surat</label>
						<div class="controls">
							<input type="text" name="letter_no" placeholder="No Surat" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Pengirim</label>
						<div class="controls">
							<input type="text" name="source" placeholder="Pengirim" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Tanggal Cetak</label>
						<div class="controls">
							<input type="text" name="date_print" placeholder="Tanggal Cetak" class="span3 datepicker" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Tanggal Konfirmasi</label>
						<div class="controls">
							<input type="text" name="date_confirm" placeholder="Tanggal Konfirmasi" class="span3 datepicker" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Keterangan</label>
						<div class="controls"><textarea name="desc" class="span5"></textarea></div>
                    </div>
					<div class="control-group">
						<label class="control-label">Upload</label>
						<div class="controls"><a class="btn btn-primary btn-upload cursor">Tambah File</a></div>
                    </div>
					<div class="control-group">
						<label class="control-label">&nbsp;</label>
						<div class="controls"><ul class="list-file"></ul></div>
                    </div>
					<div>
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
								<th>ID</th>
								<th>No Surat</th>
								<th>Jenis Surat</th>
								<th>Pengirim</th>
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
		var page = {
			init_list: function() {
				$('.remove-file').click(function() {
					$(this).parents('li').remove();
				});
			},
			generate_list: function(array_file) {
				var content = '';
				for (var i = 0; i < array_file.length; i++) {
					var raw_text = array_file[i].file_name;
					raw_text += '<input type="hidden" name="array_file[]" value="' + array_file[i].file_name + '" /> ';
					raw_text += '(<a class="cursor remove-file">hapus</a> | <a class="download-file" target="_blank" href="' + array_file[i].file_link + '">download</a>)';
					content += '<li>' + raw_text + '</li>';
				}
				
				$('.list-file').append(content);
				page.init_list();
			},
			clear_list: function() {
				$('.list-file').html('');
			}
		}
		
		upload_letter = function(p) {
			if (p.message.length > 0) {
				Func.show_message({ message: p.message })
				return;
			}
			
			page.generate_list([p]);
		}
		
		$(document).ready(function() {
			grid_letter = null;
			setTimeout('$("html").removeClass("js")', 300);
			
			$('#WinLetter .btn-upload').click(function() { window.iframe_letter.browse() });
			
			// user
			var RawUser = $('#RawUser').text();
			eval('var user = ' + RawUser);
			
			Func.InitForm({
				Container: '#WinLetter',
				rule: { source: { required: true }, letter_no: { required: true }, public_key: { required: true }, date_print: { required: true }, letter_type_id: { required: true } }
            });
			
			$('.AddLetter').click(function() {
				page.clear_list();
				$('#WinLetter form')[0].reset()
				$('#WinLetter [name="id"]').val(0);
				$('#WinLetter').modal();
            });
			$('#WinLetter .save').click(function() {
				if (! $('#WinLetter form').valid()) {
					return;
                }
				
				var param = Site.Form.GetValue('WinLetter');
				param.date_print = Func.SwapDate(param.date_print);
				param.date_confirm = Func.SwapDate(param.date_confirm);
				Func.ajax({ url: web.base + 'surat/letter/action', param: param, callback: function(result) {
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
					"aaSorting": [[0, 'desc']], "sServerMethod": "POST",
					"bProcessing": true, "bServerSide": true, "sPaginationType": "bootstrap",
					"sAjaxSource": web.base + 'surat/letter/grid',
					"aoColumns": [ { "bSearchable": false, "bVisible": false }, null, null, null, { "sClass": "center", "bSortable": false } ]
                } );
				grid_letter.load = Func.reload({ id: 'grid-letter', hide: true });
				
				$('#grid-letter').on('click','tbody td img.edit', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					
					$('#WinLetter [name="id"]').val(record.id);
					$('#WinLetter [name="desc"]').val(record.desc);
					$('#WinLetter [name="source"]').val(record.source);
					$('#WinLetter [name="letter_no"]').val(record.letter_no);
					$('#WinLetter [name="public_key"]').val(record.public_key);
					$('#WinLetter [name="date_print"]').val(Func.SwapDate(record.date_print));
					$('#WinLetter [name="date_confirm"]').val(Func.SwapDate(record.date_confirm));
					$('#WinLetter [name="letter_type_id"]').val(record.letter_type_id);
					
					page.clear_list();
					page.generate_list(record.array_file);
					
					$('#WinLetter').modal();
                });
				
				$('#grid-letter').on('click','tbody td img.delete', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					
					Func.confirm_delete({
						data: { action: 'delete', id: record.id },
						url: web.base + 'surat/letter/action',
						grid: grid_letter
                    });
                });
				
				$('#grid-letter').on('click','tbody td img.disposisi', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					window.location = web.base + 'surat/disposisi/index/' + record.id;
                });
            }
			init_table();
        });
    </script>
</body>
</html>