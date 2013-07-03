<?php
	$array_menu = array( 'menu' => array('Administrator', 'User') );
	
	$user = $this->User_model->get_session();
	$array_user_type = $this->User_Type_model->get_array();
?>

<?php $this->load->view( 'common/meta' ); ?>
<body>
	<div id="loading_layer hide"><img src="<?php echo base_url(); ?>static/img/ajax_loader.gif" /></div>
	
	<div id="maincontainer" class="clearfix">
		<?php $this->load->view( 'common/header' ); ?>
		<div class="hide">
			<div id="RawUser"><?php echo json_encode($user); ?></div>
		</div>
		
		<div id="WinUser" class="modal modal-big hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
			<div class="modal-header">
				<a href="#" class="close" data-dismiss="modal">&times;</a>
				<h3>Form User</h3>
            </div>
			<div class="modal-body" style="padding-left: 0px;">
				<div class="pad-alert" style="padding-left: 15px;"></div>
				<form class="form-horizontal" style="padding-left: 0px;">
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="action" value="update" />
					
					<div class="control-group">
						<label class="control-label" for="input_name">Nama</label>
						<div class="controls">
							<input type="text" id="input_name" name="name" placeholder="Nama User" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label" for="input_email">Email</label>
						<div class="controls">
							<input type="text" id="input_email" name="email" placeholder="Email User" class="span5" rel="twipsy" />
                        </div>
                    </div>
					<div class="control-group">
						<label for="input_user_type_id" class="control-label">Jenis User</label>
						<div class="controls"><select name="user_type_id" id="input_user_type_id">
							<?php echo ShowOption(array( 'Array' => $array_user_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
						</select></div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input_passwd">Password</label>
						<div class="controls">
							<input type="password" id="input_passwd" name="passwd" placeholder="Password User" class="span5" rel="twipsy" />
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
						<button class="btn btn-gebo AddUser">Tambah</button>
                    </div>
                </div>
				
				<div class="row-fluid">
					<div class="span12">
						<table id="grid-key" class="table table-striped table-bordered dTableR">
							<thead><tr>
								<th>Nama</th>
								<th>Email</th>
								<th>Jenis Pengguna</th>
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
			grid_key = null;
			setTimeout('$("html").removeClass("js")', 300);
			
			// user
			var RawUser = $('#RawUser').text();
			eval('var user = ' + RawUser);
			
			Func.InitForm({
				Container: '#WinUser',
				rule: { name: { required: true }, email: { required: true }, user_type_id: { required: true } }
            });
			
			$('.AddUser').click(function() {
				$('#WinUser form')[0].reset()
				$('#WinUser [name="id"]').val(0);
				$('#WinUser').modal();
            });
			$('#WinUser .save').click(function() {
				if (! $('#WinUser form').valid()) {
					return;
                }
				
				var param = Site.Form.GetValue('WinUser');
				
				// add validation
				if (param.id == 0 && param.passwd == '') {
					Func.show_message({ message: 'Password tidak boleh kosong untuk pengguna baru.' })
					return false;
				}
				
				Func.ajax({ url: web.base + 'administrator/user/action', param: param, callback: function(result) {
					Func.show_message({ message: result.message })
					if (result.status == 1) {
						grid_key.load();
						$('#WinUser').modal('hide');
					}
                } });
            });
			$('#WinUser .cancel').click(function() {
				$('#WinUser').modal('hide');
            });
			
			function init_table() {
				grid_key = $('#grid-key').dataTable( {
					"aaSorting": [[0, 'desc']], "sServerMethod": "POST",
					"bProcessing": true, "bServerSide": true, "sPaginationType": "bootstrap",
					"sAjaxSource": web.base + 'administrator/user/grid',
					"aoColumns": [ null, null, null, { "sClass": "center", "bSortable": false } ]
                } );
				grid_key.load = Func.reload({ id: 'grid-key' });
				
				$('#grid-key').on('click','tbody td img.edit', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					$('#WinUser [name="id"]').val(record.id);
					$('#WinUser [name="name"]').val(record.name);
					$('#WinUser [name="email"]').val(record.email);
					$('#WinUser [name="user_type_id"]').val(record.user_type_id);
					$('#WinUser').modal();
                });
				
				$('#grid-key').on('click','tbody td img.delete', function () {
					var raw = $(this).parent('td').find('.hide').text();
					eval('var record = ' + raw);
					
					Func.confirm_delete({
						data: { action: 'delete', id: record.id },
						url: web.base + 'administrator/user/action',
						grid: grid_key
                    });
                });
            }
			init_table();
        });
    </script>
</body>
</html>