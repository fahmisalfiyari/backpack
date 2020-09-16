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
			<form method="post" action="<?=base_url();?>profile/actProfile" autocomplete="off" id="actProfile" name="actProfile" enctype="multipart/form-data">
			<!--<input type="hidden" name="<?=$csrf['id_user'];?>" value="<?=$csrf['hash'];?>" />-->
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
			
			<div data-v-60934d09="" class="profile-section">
			<div data-v-60934d09="" class="rowform-group">

			

			<div data-v-60934d09="" class="full-width">
				<div data-v-60934d09="" class="rowform-group">
					<div data-v-60934d09="" class="form-group">
						<label data-v-60934d09="" for="fullname">Full Name</label>
						<?php
							echo "<input type='hidden'  id='id_user' name='id_user' value='".$profile->id."'>";
						?>
						<?php
							echo "<input data-v-60934d09='' type='text' id='name' name='name' enabled='enabled' value='".$profile->fullname."' aria-describedby='nameHelp' data-vv-as='Full Name' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false' maxlength='20'>";
						?>
						<span data-v-60934d09="" id="nameHelp" class="help-block" style="display: none;"></span>
					</div>
				</div>
				
				
				<div data-v-60934d09="" class="rowform-group">
					<div data-v-60934d09="" class="form-group">
						<label data-v-60934d09="" for="email">Email</label>
						<?php
							echo "<input data-v-60934d09='' type='email' id='email' name='email' disabled='disabled' value=".$profile->email." aria-describedby='emailHelp' data-vv-as='Email' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false' maxlength='25'>";
						?>
						<span data-v-60934d09="" id="emailHelp" class="help-block" style="display: none;"></span>
					</div>
				</div>
				
				<div data-v-60934d09="" class="rowform-group">
					<div data-v-60934d09="" class="form-group">
						<label data-v-60934d09="" for="phone">Phone Number</label>
						<?php
							echo "<input data-v-60934d09='' type='phone' id='phone' name='phone' enabled='enabled'  value=".$profile->phone." aria-describedby='phoneHelp' data-vv-as='Phone' class='form-control' data-vv-id='26' aria-required='true' aria-invalid='false' maxlength='12' onkeypress='return hanyaAngka(event)'>";
						?>
						<span data-v-60934d09="" id="phoneHelp" class="help-block" style="display: none;"></span>
					</div>
				</div>
			
				<div data-v-60934d09="" class="full-width">
				<div data-v-60934d09="" class="">
					<!--<div data-v-60934d09="" class="full-width profile-picture-wrapper">-->
					<div data-v-60934d09="" class="profile-profile-outter" style="display" style='width: 50px height: 50px'>
						
						<?php if($profile->identity_card){
							//echo '$profile->identity_card';
							echo"<img src = files/".$profile->identity_card." width='100' height='100' id='ktp'><input type='file' class='form-control' name='userfile' id='userfile' style='display:hidden;' accept='image/*' onChange='validate(this.value)' accept='.jpg,.jpeg,.png'>";
							//echo "<img src = files/".$profile->identity_card." style='width: 50 height: 50' id='ktp' onmouseover='changein()' onmouseout='changeout(".$profile->identity_card.")'>";
						} else {
							echo"<img src = files/default_pic.png width='100' height='100' id='ktp'><input type='file' class='form-control' name='userfile' id='userfile' style='display:hidden;' accept='image/*' onChange='validate(this.value)' accept='.jpg,.jpeg,.png'>";
							//echo "<img src = files/default_pic.png style='width: 50 height: 50' id='ktp' onmouseover='changein()' onmouseout='changeout()'>";
						}
						?>

					</div>

		  
					<div data-v-60934d09="" class="change-profile-picture">
					  <div data-v-60934d09="" style="display: none;">
						<input data-v-60934d09="" type="file" id="fileInput" name="fileInput" accept="image/*" data-vv-as="Ganti Foto" data-vv-id="25" aria-required="false" aria-invalid="false">
					  </div>
						<a data-v-60934d09=""><i data-v-60934d09="" class="icon icon-photo"></i><br data-v-60934d09="">
						</a>
					</div>
				</div> 
				</div>
			
			
				<div data-v-60934d09="" class="one-third-width no-padding pull-right">
					<button data-v-60934d09="" class="btn btn-warning btn-save" type="submit">Save</button>
				</div>
				

		 		
			</div>
		
	
			</div>
			</div>
			</form>
		</div>
	</div>
</div>

<script>
$('#id_card').click(function(){ $('#uploadfile').trigger('click');});

function changein() {
  document.getElementById("ktp").src = "files/camera.jpg";
}

function changeout(file){
  document.getElementById("ktp").src = "files/" + file;
}

function validate(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];

    if (arrayExtensions.lastIndexOf(ext) == -1) {
        alert("Wrong extension type.");
        $("#image").val("");
    }
}

function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57)){
		alert("Number only");
		return false;
	} else {
		return true;
	}
}

</script>