<!-- Begin Page Content -->
<div class="container-fluid">


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Available Promo</h1>
  </div>

  <div class="row">
  	<?php foreach ($promo as $diskon) { ?>
  		<?php if($diskon['value'] || $diskon['percentage']){ ?>
	  		<div class="col-xl-3 col-md-6 mb-4">
	  			<!-- <a href="<?= base_url() ?>explore/schedule/<?= encrypt_id($rute['id']) ?>" class="text-muted" style="text-decoration: none;"> -->
		          <div class="card border-left-success shadow h-100 py-2">
		            <div class="card-body">
		              <div class="row no-gutters align-items-center">
		                <div class="col mr-2">
		                  <div class="h4 mb-2 font-weight-bold text-gray-800"><?= $diskon['name'];?></div>
		                  <?php if($diskon['value'] && $diskon['percentage']==null){ ?>
			                  <div class="text font-weight-bold text-primary"><?= 'Discount : '.rupiah($diskon['value']);?></div>
			              <?php }else if($diskon['percentage'] && $diskon['value']==null){?>
			              		<div class="text font-weight-bold text-primary"><?= 'Discount : '.$diskon['percentage'].'%';?></div>
			              <?php } ?>
		                </div>
		                <div class="col-auto">
		                  	<i class="fas fa-tag fa-2x text-gray-300"></i>
		                </div>
		              </div>
		            </div>
		          </div>
	  			<!-- </a> -->
	        </div>
	    <?php } ?>
	<?php } ?>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content