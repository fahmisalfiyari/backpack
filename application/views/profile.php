<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">My Profile</h1>


</div>
<!-- /.container-fluid -->

<!--<div class="container-fluid">
		<div class="h4 mb-2 font-weight-bold text-gray-800"><?= $profile->fullname;?></div>
		<div class="h4 mb-2 font-weight-bold text-gray-800"><?= $profile->phone;?></div>
		<div class="h4 mb-2 font-weight-bold text-gray-800"><?= $profile->identity_card;?></div>

		<div class="center pb-4 pt-4">
			<?php if($profile->identity_card){
				echo "<img src = files/".$profile->identity_card." style='width: 180px'>";
			} else {
				echo "<img src = files/default_pic.png style='width: 180px'>";
			}
			?>
        </div>

</div>
-->

<div data-v-5b6cdb01="" class="container">
<div class="card mb-4 shadow-sm">
<div class="card-body">


  <div data-v-60934d09="" class="profile-section">
  <!--<div data-v-60934d09="" class="row form-group">-->
  <div data-v-60934d09="" class="rowform-group">

<div data-v-60934d09="" class="full-width">
  <div data-v-60934d09="" class="">
  <!--<div data-v-60934d09="" class="full-width profile-picture-wrapper">-->
  <div data-v-60934d09="" class="profile-profile-outter" style="display">
  
	<?php if($profile->identity_card){
		echo "<img src = files/".$profile->identity_card." style='width: 100px height: 50px' id='ktp' onmouseover='changein()' onmouseout='changeout(".$profile->identity_card.")'>";
	} else {
		echo "<img src = files/default_pic.png style='width: 100px height: 50px' id='ktp' onmouseover='changein()' onmouseout='changeout()'>";
	}
	?>
 
  <!--<img data-v-60934d09="" width="75%" class="profile-picture" src="/img/profile/default.jpg" lazy="error">-->
  </div>
  
  <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Identitas (KTP/SIM/PASSPORT)</label>
                    <input type="file" class="form-control" id="image" accept="image/*" onChange="validate(this.value)" name="userfile" style="padding: 3px;" accept=".jpg,.jpeg">
                </div>

  
  <div data-v-60934d09="" class="change-profile-picture">
	  <div data-v-60934d09="" style="display: none;">
		<input data-v-60934d09="" type="file" id="fileInput" name="fileInput" accept="image/*" data-vv-as="Ganti Foto" data-vv-id="25" aria-required="false" aria-invalid="false">
	  </div>
		<a data-v-60934d09=""><i data-v-60934d09="" class="icon icon-photo"></i><br data-v-60934d09="">
				  Ganti Foto
		</a>
	</div>
	</div> 
	

	</div>
	<!--</div> -->
	
	
	
	<!--<div data-v-60934d09="" class="row">-->
		<div data-v-60934d09="" class="half-width">
		<div data-v-60934d09="" class="rowform-group">
		<div data-v-60934d09="" class="form-group">
		<label data-v-60934d09="" for="fullname">Full Name</label>
		<?php
			echo "<input data-v-60934d09='' type='text' id='name' name='name' enabled='enabled' value=".$profile->fullname." aria-describedby='nameHelp' data-vv-as='Full Name' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false'>";
		?>
		<span data-v-60934d09="" id="nameHelp" class="help-block" style="display: none;">
		</span>
		</div>
		</div>
		
		
		<div data-v-60934d09="" class="rowform-group">
		<div data-v-60934d09="" class="form-group">
		<label data-v-60934d09="" for="email">Email</label>
		<?php
			echo "<input data-v-60934d09='' type='email' id='email' name='email' enabled='enabled' value=".$profile->email." aria-describedby='emailHelp' data-vv-as='Email' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false'>";
		?>
		<span data-v-60934d09="" id="emailHelp" class="help-block" style="display: none;">
		</span>
		</div>
		</div>
		
		<div data-v-60934d09="" class="rowform-group">
		<div data-v-60934d09="" class="form-group">
		<label data-v-60934d09="" for="phone">Phone Number</label>
		<?php
			echo "<input data-v-60934d09='' type='phone' id='phone' name='phone' enabled='enabled'  value=".$profile->phone." aria-describedby='phoneHelp' data-vv-as='Phone' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false'>";
		?>
		<span data-v-60934d09="" id="phoneHelp" class="help-block" style="display: none;">
		</span>
		</div>
		</div>
	
	
		<div data-v-60934d09="" class="one-third-width no-padding pull-right">
		<button data-v-60934d09="" disabled="disabled" class="btn btn-warning btn-save">Save</button>
		</div>
	 
	 
		
		</div>
		
<!--	</div> -->
	
	
	<!--<div data-v-60934d09="" class="row">
		<div data-v-60934d09="" class="half-width">
		<div data-v-60934d09="" class="form-group">
		<label data-v-60934d09="" for="email">Email</label>
		<?php
			echo "<input data-v-60934d09='' type='email' id='email' name='email' disabled='disabled' value=".$profile->email." aria-describedby='emailHelp' data-vv-as='Email' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false'>";
		?>
		
		<span data-v-60934d09="" id="emailHelp" class="help-block" style="display: none;">
		</span>
		</div>
		</div>	
	/div> -->
	
	
	<!--<div data-v-60934d09="" class="row">
		<div data-v-60934d09="" class="full-width">
		<div data-v-60934d09="" class="form-group">
		<label data-v-60934d09="" for="phone">Phone Number</label>
		<?php
			echo "<input data-v-60934d09='' type='phone' id='phone' name='phone' disabled='disabled' value=".$profile->phone." aria-describedby='phoneHelp' data-vv-as='Phone' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false'>";
		?>
		
		<span data-v-60934d09="" id="phoneHelp" class="help-block" style="display: none;">
		</span>
		</div>
		</div>	
	</div> 
	
	 <div data-v-60934d09="" class="one-third-width no-padding pull-right">
	 <button data-v-60934d09="" disabled="disabled" class="btn btn-warning btn-save">Save</button>
	 </div>
	 -->
  
</div>
</div>
</div>
</div>

<script>
function changein() {
  document.getElementById("ktp").src = "files/camera.jpg";
}
function changeout(){
  document.getElementById("ktp").src = "files/default_pic.png";
}

</script>