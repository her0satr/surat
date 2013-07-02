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
						<h3 class="heading">Server-side processing with hidden row</h3>
						<div class="alert alert-info">Before you can use this datatable you need to adjust some options in <code>lib/datatables/server_side.php</code>.</div>
						<table id="dt_e" class="table table-striped table-bordered dTableR">
							<thead>
								<tr>
									<th></th>
									<th>Rendering engine</th>
									<th>Browser</th>
									<th>Platform(s)</th>
									<th>Engine version</th>
									<th>CSS grade</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="dataTables_empty" colspan="6">Loading data from server</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<h3 class="heading">Alerts</h3>
						<div class="alert">
							<a class="close" data-dismiss="alert">×</a>
							<strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.
						</div>
						<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							<strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.
						</div>
						<div class="alert alert-success">
							<a class="close" data-dismiss="alert">×</a>
							<strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.
						</div>
						<div class="alert alert-info">
							<a class="close" data-dismiss="alert">×</a>
							<strong>Lorem ipsum!</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">
						<div class="alert alert-block alert-error fade in">
							<a href="#" data-dismiss="alert" class="close">×</a>
							<h4 class="alert-heading">Lorem ipsum!</h4>
							<ul>
								<li>Lorem ipsum dolor sit amet.</li>
								<li>Lorem ipsum dolor sit amet.</li>
								<li>Lorem ipsum dolor sit amet.</li>
							</ul>
							<p><a href="#" class="btn btn-inverse"><i class="splashy-check"></i> Take this action</a> or <a href="#" class="btn"><i class="splashy-error_small"></i> Cancel</a></p>
						</div>
					</div>
					<div class="span6">
						<div class="alert alert-block alert-warning fade in">
							<h4 class="alert-heading">Lorem ipsum!</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae tristique erat.</p>
							<p><a href="#" class="btn btn-inverse">Take this action</a> or <a href="#" class="btn">Cancel</a></p>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<h3 class="heading">Buttons</h3>
						<div class="row-fluid">
							<div class="span3">
								<div class="btn-group">
									<button class="btn">Left</button>
									<button class="btn">Middle</button>
									<button class="btn">Right</button>
								</div>
							</div>
							<div class="span3">
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</div>	
							</div>
							<div class="span3">
								<div class="btn-group">
									<button class="btn btn-info">Info</button>
									<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</div>	
							</div>
							<div class="span3">
								<div class="btn-group dropup">
									<button class="btn">Dropup</button>
									<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</div>	
							</div>
						</div>
						<div class="row-fluid">
							<div class="span3">
								<div class="sepH_c">
									<p><button class="btn">lorem ipsum</button></p>
									<code>.btn</code>
								</div>
								<p><button class="btn btn-primary">lorem ipsum</button></p>
								<code>.btn .btn-primary</code>
							</div>
							<div class="span3">
								<div class="sepH_c">
									<p><button class="btn btn-info">lorem ipsum</button></p>
									<code>.btn .btn-info</code>
								</div>
								<p><button class="btn btn-success">lorem ipsum</button></p>
								<code>.btn .btn-success</code>
							</div>
							<div class="span3">
								<div class="sepH_c">
									<p><button class="btn btn-warning">lorem ipsum</button></p>
									<code>.btn .btn-warning</code>
								</div>
								<p><button class="btn btn-danger">lorem ipsum</button></p>
								<code>.btn .btn-danger</code>
							</div>
							<div class="span3">
								<div class="sepH_c">
									<p><button class="btn btn-inverse">lorem ipsum</button></p>
									<code>.btn .btn-inverse</code>
								</div>
								<p><button class="btn btn-gebo">lorem ipsum</button></p>
								<code>.btn .btn-gebo</code>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span3">
								<p><button class="btn btn-large">lorem ipsum</button></p>
								<code>.btn .btn-large</code>
							</div>
							<div class="span3">
								<p><button class="btn btn-small">lorem ipsum</button></p>
								<code>.btn .btn-small</code>
							</div>
							<div class="span3">
								<p><button class="btn btn-mini">lorem ipsum</button></p>
								<code>.btn .btn-mini</code>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span3">
								<a href="javascrpt:void(0)" class="btn">Link</a>
							</div>
							<div class="span3">
								<form>
									<button type="submit" class="btn">Button</button>
								</form>		
							</div>
							<div class="span3">
								<form>
									<input type="button" value="Input" class="btn" />
								</form>		
							</div>
							<div class="span3">
								<form>
									<input type="submit" value="Submit" class="btn" />
								</form>		
							</div>
						</div>
						<div class="row-fluid">
							<div class="span3">
								<a href="javascrpt:void(0)" class="btn disabled">Link disabled</a>
							</div>
							<div class="span3">
								<form>
									<button type="submit" class="btn" disabled>Button disabled</button>
								</form>		
							</div>
						</div>
						<h3 class="heading">Button states</h3>
						<div class="row-fluid">
							<div class="span3">
								<button class="btn" data-loading-text="Loading..." id="fat-btn">Loading State</button>
							</div>
							<div class="span3 btns_state">
								<div class="sepH_a">
									<button data-toggle="button" class="btn">Single Toggle</button>
								</div>
								<span class="btn_txt"></span>
							</div>
							<div class="span3 btns_state">
								<div data-toggle="buttons-checkbox" class="btn-group clearfix sepH_a">
									<button class="btn">Left</button>
									<button class="btn">Middle</button>
									<button class="btn">Right</button>
								</div>
								<span class="btn_txt"></span>
							</div>
							<div class="span3 btns_state">
								<div data-toggle="buttons-radio" class="btn-group clearfix sepH_a">
									<button class="btn">Left</button>
									<button class="btn">Middle</button>
									<button class="btn">Right</button>
								</div>
								<span class="btn_txt"></span>
							</div>
						</div>
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
			
			function init_table() {
				var oTable;
				
				// Detail formating
				function fnFormatDetails ( nTr ) {
					var aData = oTable.fnGetData( nTr );
					var sOut = '<table cellpadding="5" cellspacing="0" border="0" class="table table-bordered" >';
					sOut += '<tr><td>Rendering engine: 45</td><td>'+aData[1]+' '+aData[5]+'</td></tr>';
					sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
					sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
					sOut += '</table>';
					return sOut;
				}
				
				oTable = $('#dt_e').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
					"sAjaxSource": web.host + 'home/grid',
					"aoColumns": [
						{ "sClass": "center", "bSortable": false },
						null,
						null,
						null,
						{ "sClass": "center" },
						{ "sClass": "center" }
					],
					"aaSorting": [[1, 'asc']]
				} );
				
				 
				// expand or collapse function
				$('#dt_e').on('click','tbody td img', function () {
					var nTr = $(this).parents('tr')[0];
					if ( oTable.fnIsOpen(nTr) ) {
						this.src = web.host + 'static/img/details_open.png';
						oTable.fnClose( nTr );
					} else {
						this.src = web.host + 'static/img/details_close.png';
						oTable.fnOpen( nTr, fnFormatDetails(nTr), 'details' );
					}
				});
			}
//			init_table();
		});
	</script>
</body>
</html>