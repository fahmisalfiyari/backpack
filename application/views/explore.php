<!-- Begin Page Content -->
<div class="container-fluid">


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Available Routes</h1>
  </div>

  <div class="row">
  	<?php foreach ($route as $rute) { ?>
  		<div class="col-xl-3 col-md-6 mb-4">
  			<a href="<?= base_url() ?>explore/schedule/<?= encrypt_id($rute['id']) ?>" class="text-muted" style="text-decoration: none;">
	          <div class="card border-left-primary shadow h-100 py-2">
	            <div class="card-body">
	              <div class="row no-gutters align-items-center">
	                <div class="col mr-2">
	                  <div class="h4 mb-2 font-weight-bold text-gray-800"><?= $rute['from'].' - '.$rute['to'];?></div>
	                  <div class="text font-weight-bold text-primary"><?= rupiah($rute['price']);?></div>
	                  <!-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Schedule :</div> -->
	                </div>
	                <div class="col-auto">
	                	<? if($rute['type'] ==1){ ?>
	                  		<i class="fas fa-car fa-2x text-gray-300"></i>
	                  	<? }else if($rute['type'] == 2){ ?>
	                  		<i class="fas fa-plane fa-2x text-gray-300"></i>
	                  	<? } ?>
	                </div>
	              </div>
	            </div>
	          </div>
  			</a>
        </div>
	<?php } ?>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->