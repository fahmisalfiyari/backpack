<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Reviews</h1>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</div>
<!-- /.container-fluid -->

<div data-v-5b6cdb01="" class="container">
	<div class="card mb-4 shadow-sm">
		<div class="card-body">
			<form method="post" action="<?=base_url();?>Review/actReview" autocomplete="off" id="actReview" name="actReview">
				<!--<input type="hidden" name="<?=$csrf['id_user'];?>" value="<?=$csrf['hash'];?>" />-->
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
				<div data-v-60934d09="" class="profile-section">
				<div data-v-60934d09="" class="rowform-group">
				
				<?php if($owncomment == null){
							echo "<h3 class='h3 mb-4 text-gray-800'>Rate this Service</h3>";
							echo "<div class='form-group'><input type='text' name='comment_name' id='comment_name' class='form-control' placeholder='Enter Name' /></div>";
							echo "<div class='form-group'><textarea name='comment_content' id='comment_content' class='form-control' rows='5' placeholder='Enter Comment'></textarea></div>";
							echo "<div class='form-group'><input type='hidden' name='comment_id' id='comment_id' value='0' /><input type='submit' name='submit' id='submit' class='btn btn-info' value='Submit' /></div>";
						} else {
							echo "<h3 class='h3 mb-4 text-gray-800'>Your Reviews</h3>";
							echo "<label data-v-60934d09='' for='comment_sender_name'>".$owncomment->comment_sender_name." on ".$owncomment->date."</label><br></br>";
							echo "<div class='form-group'><textarea name='comment_content' id='comment_content' class='form-control' rows='5' disabled='disabled'>".$owncomment->comment."</textarea></div>";
							echo "<div class='form-group'><input type='hidden' name='comment_id' id='comment_id' value='0' /><input type='submit' name='submit' id='submit' class='btn btn-info' value='Edit your comment' /></div>";
						
						}
				?>
					
					<br />
					<br />
					<span id="business_list"></span>
					<?php
					
					?>
					
					
					<span id="comment_message"></span>
					<br />
					<div id="display_comment">
					<?php
						echo "<h2 class='h3 mb-4 text-gray-800'>Ratings and reviews</h2>";
						if($allcomment != null){
							foreach ($allcomment as $comm){
								
								echo "<div class='panel panel-default'><div class='panel-heading'>By <b>".$comm['comment_sender_name']."</b> on <i>".$comm['date']."</i></div>";
								for($count=1; $count<=5; $count++){
									if($count <= $comm['rating']){
										$color = 'color:#ffcc00;';
									} else {
										$color = 'color:#ccc;';
									}
									echo "<div class='' class='rating' style='cursor:pointer; ".$color." font-size:16px;'>&#9733;</div>";
									//echo "<li title='".$count."' id='".$comm['comment_id']."-".$count."' data-index='".$count."'  data-business_id='".$comm['comment_id']."' data-rating='".$comm['rating']."' class='rating' style='cursor:pointer; ".$color." font-size:16px;'>&#9733;</li>";
								}
								echo "<div class='panel-body'>".$comm['comment']."</div>";
								//<div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
								
					
								
								echo "</div>";
							}
						}
					?>
					</div>
				</div>					
				</div>
		
			</form>
		</div>
	</div>		
</div>

<script>
$(document).ready(function(){
	
 load_business_data();
 
 function load_business_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#business_list').html(data);
   }
  });
 }
 
  $(document).on('mouseenter', '.rating', function(){
  var index = $(this).data("index");
  var business_id = $(this).data('business_id');
  remove_background(business_id);
  for(var count = 1; count<=index; count++)
  {
   $('#'+business_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
  
 function remove_background(business_id)
 {
  for(var count = 1; count <= 5; count++)
  {
   $('#'+business_id+'-'+count).css('color', '#ccc');
  }
 }
 
  $(document).on('mouseleave', '.rating', function(){
  var index = $(this).data("index");
  var business_id = $(this).data('business_id');
  var rating = $(this).data("rating");
  remove_background(business_id);
  //alert(rating);
  for(var count = 1; count<=rating; count++)
  {
   $('#'+business_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
  $(document).on('click', '.rating', function(){
  var index = $(this).data("index");
  var business_id = $(this).data('business_id');
  $.ajax({
   url:"insert_rating.php",
   method:"POST",
   data:{index:index, business_id:business_id},
   success:function(data)
   {
    if(data == 'done')
    {
     load_business_data();
     alert("You have rate "+index +" out of 5");
    }
    else
    {
     alert("There is some problem in System");
    }
   }
  });
  
 });
 
 
 
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"reviews.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   }
  })
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_name').focus();
 });
 
});




</script>