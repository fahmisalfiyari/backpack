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

<!-- Modal Confirm-->
  <div class="modal fade" id="modal2" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Book Confirmation</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        	<table class="table table-borderless">
        		<tr>
        			<td>From</td>
        			<td width="5%">:</td>
        			<td><b id="book_from">Bandung</b></td>
        		</tr>
        		<tr>
        			<td>To</td>
        			<td width="5%">:</td>
        			<td><b id="book_to">Jakarta</b></td>
        		</tr>
        		<tr>
        			<td>Departure</td>
        			<td width="5%">:</td>
        			<td><b id="book_departure"></b></td>
        		</tr>
        		<tr>
        			<td>Promo</td>
        			<td width="5%">:</td>
        			<td id="book_promo">
        				<div class="d-flex justify-content-between">
		    				<span>Promo Ticket Available!</span>
		    				    <button class="btn btn-sm btn-success" onclick="showAvailablePromo()">Promo</button>
        				</div>
        			</td>
        		</tr>
        		<tr>
        			<td>Total Price</td>
        			<td width="5%">:</td>
        			<td><b id="book_price">500000</b></td>
        		</tr>
        		<input type="hidden" name="promo_id" id="promo_id">
        		<input type="hidden" name="sc_id" id="sc_id">
        		<input type="hidden" name="price" id="price">
        		<input type="hidden" name="price_disc" id="price_disc">
        	</table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="javascript:void(0);" onclick="doBook()">Book</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_promo" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">List Available Promo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="body_promo" style="overflow-y: auto;">
        	<a href="javascript:void(0);" class="text-muted" style="text-decoration: none;" onclick="selectPromo(1);">
	        	<div class="col-xs-3 col-md-12 mb-4 cursoron">
		          <div class="card border-left-success shadow h-100 py-2">
		            <div class="card-body">
		              <div class="row no-gutters align-items-center">
		                <div class="col mr-2">
		                  <div class="h5 mb-2 font-weight-bold text-gray-800">Promo 1</div>
		                  <div class="text font-weight-bold text-primary"><?= 'Discount : '.rupiah(500000);?></div>
		                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Click to use this promo</div>
		                </div>
		                <div class="col-auto">
	                  		<i class="fas fa-tag fa-2x text-gray-300"></i>
		                </div>
		              </div>
		            </div>
		          </div>
		        </div>
		    </a>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal" onclick="">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_feedback" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Booking Status</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="body_promo" style="overflow-y: auto;">
        	<span id="txt_feedback"></span>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal" onclick="">Close</button>
        </div>
      </div>
    </div>
  </div>

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
			'pageLength'	: 10,
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
						data.id 		= idr;
						isFilter 		= false;
					}
			},
			'columnDefs'	: [{
				'targets'	: [0],
				'orderable'	: false,
			}]
		});
	});

	function confirm(ids){
		$('#promo_id').val('');
		$('#book_price').html('');
		$('#book_departure').html('');
		$('#book_promo').html('');
		$('#book_from').html('');
		$('#book_to').html('');

		loadSchedule(ids);
	}

	function loadSchedule(ids){
		$.ajax({
			url 		: '<?=base_url()?>explore/loadSchedule',
			dataType	: 'json',
			method 		: 'POST',
			data 		: {
				func 	: 'getNewLocations', '<?=$this->security->get_csrf_token_name()?>':'<?=$this->security->get_csrf_hash()?>',
				'ids' 	: ids,
			},
			success		: function(data){
				if(data.status == 'success'){
					$('#book_from').html(data.route.from);
					$('#book_to').html(data.route.to);
					$('#book_price').html(data.price_parsing);
					$('#price').val(data.route.price);
					$('#sc_id').val(ids);
					$('#book_departure').html(data.time_format);
					$('#price').val(data.price);

					if(data.promo == 'exist'){
						$('#book_promo').html('<div class="d-flex justify-content-between"><span>Promo Ticket Available!</span><button class="btn btn-sm btn-success" onclick="showAvailablePromo()">Promo</button></div>');
					}else{
						$('#book_promo').html('Currently, there is no promo Available');
					}

					$('#modal2').modal('show');
				}else{
					alert('Failed to open book window process');
				}
			}
		});
	}

	function showAvailablePromo(){
		$('#body_promo').html('');
		$.ajax({
			url 		: '<?=base_url()?>explore/loadPromo',
			dataType	: 'json',
			method 		: 'POST',
			data 		: {
				func 	: 'getNewLocations', '<?=$this->security->get_csrf_token_name()?>':'<?=$this->security->get_csrf_hash()?>',
			},
			success		: function(data){
				if(data.status == 'success'){
					$('#body_promo').html(data.html);
					$('#modal2').modal('show');
				}else{
					alert('Failed to open book window process');
				}
			}
		});
		$('#modal2').modal('hide');
		$('#modal_promo').modal('show');
	}

	function selectPromo(idPromo, discVal, discType){
		$('#promo_id').val(idPromo);

		var discatf;
		var discnow = $('#price').val();

		if(discType == 1){
			discatf = discnow - discVal;
		}else if(discType == 2){
			discatf = discnow - ((discVal/100)*discnow);
		}

		$('#price_disc').val(discatf);
		$('#book_promo').html('<div class="d-flex justify-content-between"><span>Promo Applied!</span><button class="btn btn-sm btn-success" onclick="showAvailablePromo()">Change Promo</button></div>');

		discnow = formatRupiah(discnow, 'Rp. ');
		discatf = formatRupiah(discatf, 'Rp. ');

		$('#book_price').html('<strike>'+discnow+'</strike>&nbsp;&nbsp;'+discatf);


		$('#modal2').modal('show');
		$('#modal_promo').modal('hide');
	}

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix){
		var	reverse = angka.toString().split('').reverse().join(''),
		ribuan 	= reverse.match(/\d{1,3}/g);
		rupiah	= ribuan.join('.').split('').reverse().join('');
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah +',00': '');
	}

	function doBook(){
		$.ajax({
			url 		: '<?=base_url()?>explore/actBook',
			dataType	: 'json',
			method 		: 'POST',
			data 		: {
				func 	: 'getNewLocations', '<?=$this->security->get_csrf_token_name()?>':'<?=$this->security->get_csrf_hash()?>',
				'sc_id' : $('#sc_id').val(),
				'promo_id' : $('#promo_id').val(),
			},
			success		: function(data){
				if(data.status == 'success'){
					$('#txt_feedback').html('Booking Succes! Enjoy your Travel :)');
				}else{
					$('#txt_feedback').html('Booking Failed :( , Please Try Again Later');
				}

				$('#modal2').modal('hide');
				$('#modal_feedback').modal('show');
				table.ajax.reload(null,false);
			}
		});
	}
</script>
