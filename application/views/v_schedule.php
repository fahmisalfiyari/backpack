<?php
	$csrf	= array(
		'name'	=> $this->security->get_csrf_token_name(),
		'hash'	=> $this->security->get_csrf_hash()
	);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	 <!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Schedule for <?= $route['from'].' - '.$route['to']?></h1>
	</div>

  	<!-- Table -->
	<div class="card mb-4 shadow-sm">
		<div class="card-body">
			<div class="col-12 table-responsive-sm">
				<table id="table_sc" class="table table-striped table-bordered " style="width: 100%">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th>Departure Date</th>
							<th>Seats Available</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script type="text/javascript">
	var pathArray = window.location.pathname.split('/');
	var idr = pathArray[4];

	//Main Datatable 
	$(function(){
		//datatable ajax
		var isFilter 	= false;
		table 			= $('#table_sc').DataTable({
			'paging'		: true,
			'lengthChange'	: false,
			'pageLength'	: 2,
			'searching'		: false,
			'ordering'		: false,
			'info'			: false,
			'autoWidth'		: false,
			'processing'	: true,
			'serverSide'	: true,
			'order'			: [],
			'ajax'			: {
				'url'		: '<?=base_url()?>explore/ajax_list_schedule',
				'type'		: 'POST',
				'data'		: 
					function (data){
						if(isFilter){
							data.start = 0;
						}
						data.<?=$csrf['name']?> = "<?=$csrf['hash']?>";
						data.token 		= "<?=$csrf['hash']?>";
						data.cari_status= $('#cari_status').val();
						data.cari_job	= $('#cari_job').val();
						data.id 		= idr;
						isFilter 		= false;
					}
			},
			'columnDefs'	: [{
				'targets'	: [0],
				'orderable'	: false,
			}]
		});

		$('#btn-filter').click(function() {
			isFilter = true;
			table.ajax.reload(null, true);
		});

		$(document).keypress(function(e) {
			var key = e.keyCode || e.which;
			if(key == 13){
				isFilter = true;
				table.ajax.reload(null,true);
			}
		});	
	});
</script>
