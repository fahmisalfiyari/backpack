<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
  	<?php if(isset($result) && $result){ 
  			if($result == 1){
  	?>
	    <h1 class="h3 mb-0 text-gray-800">Search Result for - <?= $q ?></h1>
	<?php 	}else if($result == 98){?>
	    <h1 class="h3 mb-0 text-gray-800">We can't find what you're looking :((</h1>
	<?php 	} ?>
  		
  	<?php }else{?>
	    <h1 class="h3 mb-0 text-gray-800">My Bookings</h1>
	<?php }?>
  </div>

  <?php if(isset($booking) && $booking!=null){ ?>
	  <div class="row">
	  	<?php foreach ($booking as $book) { ?>
	  		<div class="col-xl-12 col-md-12 mb-3">
	  			<!-- <a href="<?= base_url() ?>explore/schedule/<?= encrypt_id($rute['id']) ?>" class="text-muted" style="text-decoration: none;"> -->
		          <div class="card border-left-info shadow h-100 py-2">
		            <div class="card-body">
		              <div class="row no-gutters align-items-center">

		                <div class="col mr-2">
		                  <div class="text font-weight-bold text-info">DEPARTURE</div>
		                  <div class="h5 font-weight-bold text-gray-600"><?= $book['departure']?></div>
		                </div>

		                <div class="col mr-2">
		                  <div class="text font-weight-bold text-info">TIME</div>
		                  <div class="h5 font-weight-bold text-gray-600"><?= $book['time']?></div>
		                </div>

		                <div class="col mr-2">
		                  <div class="text font-weight-bold text-info">BOOKING CODE</div>
		                  <div class="h5 font-weight-bold text-gray-600"><?= $book['code']?></div>
		                </div>

		                <div class="col mr-2">
		                  <div class="text font-weight-bold text-info">PRICE</div>
		                  <div class="h5 font-weight-bold text-gray-600"><?= $book['price']?></div>
		                </div>

		                 <div class="col mr-2">
		                  <div class="text font-weight-bold text-info">STATUS</div>
		                  <div class="h5 font-weight-bold text-gray-600"><?= $book['status']?></div>
		                </div>

		                <div class="col-auto">
		                	<? if($book['type'] ==1){ ?>
		                  		<i class="fas fa-train fa-2x text-gray-300"></i>
		                  	<? }else if($book['type'] == 2){ ?>
		                  		<i class="fas fa-plane fa-2x text-gray-300"></i>
		                  	<? } ?>
		                </div>

		              </div>
		            </div>
		          </div>
	  			<!-- </a> -->
	        </div>
		<?php } ?>
	  </div>
  <?php }else{ ?>
  	<?php if(isset($result) && $result){

  	}else{ ?>
	  	<div class="row">
	  		<h4>Currently, You are not booking any schedule ....</h4>
	  	</div>
	<?php } ?>
  <?php } ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->