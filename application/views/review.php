<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Reviews and Ratings</h1>

<style>
ul {
    margin: 0px;
    padding: 10px 0px 0px 0px;
}

li.star {
    list-style: none;
    display: inline-block;
    margin-right: 5px;
    cursor: pointer;
    color: #9E9E9E;
	font-size: 40px;
}

li.star.selected {
    color: #ffcc00;
}
</style>
	
</div>

<div data-v-5b6cdb01="" class="container">

	
	<div class="card mb-4 shadow-sm">
		<div class="card-body">
			<form method="post" action="<?=base_url();?>Review/actReview" autocomplete="off" id="actReview" name="actReview">
				<!--<input type="hidden" name="<?=$csrf['id_user'];?>" value="<?=$csrf['hash'];?>" />-->
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
				<div data-v-60934d09="" class="profile-section">
				<div data-v-60934d09="" class="rowform-group">
				
				
				
				<?php 
				
					if($login != '0'){ //login
						if($owncomment == null){
							echo "<h3 class='h3 mb-4 text-gray-800'>Rate this Service</h3>";
							echo "<div class='panel-body'><ul class='list-inline'>";
							//echo "<div class='panel-body'><ul class='list-inline' onMouseLeave='mouseOutRating(".$rating.")'>";
								for($count=1; $count<=5; $count++){
									echo "<li id='liststar_".$count."' value=".$count." class='star' onMouseOver='mouseOverRating(".$count.")' 'font-size:40px;'>&#9733;</li>";
								}
							echo "</ul></div>";
							echo "<input type='hidden' id='user_rating' name='user_rating'  value='' />";
							echo "<div class='form-group'><textarea name='comment_content' id='comment_content' class='form-control' rows='5' placeholder='Enter Comment'></textarea></div>";
							echo "<div class='form-group'><input type='hidden' name='comment_id' id='comment_id' value='0' /><input type='submit' name='submit' id='submit' class='btn btn-info' value='Submit' /></div>";
						} else {
							echo "<h3 class='h3 mb-4 text-gray-800'>Your Reviews</h3>";
							echo "<div class='panel panel-default'><div class='panel-heading'>".$owncomment->fullname." on ".$owncomment->date."</div>";
							echo "<div class='panel-body'><ul class='list-inline'>";
								for($count=1; $count<=5; $count++){
									if($count <= $owncomment->rating){
										$color = 'color:#ffcc00;';
									} else {
										$color = 'color:#ccc;';
									}
									
									echo "<li id='liststar' class='list-inline-item' style='cursor:pointer; ".$color." font-size:16px;'>&#9733;</li>";
								}
							echo "</ul></div>";
							echo "<div class='panel-body'>".$owncomment->comment."</div></div>";
						}
					}
				?>
				
					<br />
					<br />
					
					
					
					<span id="comment_message"></span>
					<br />
					<div id="display_comment">
					<?php
						if($login != '0'){ //login
							echo "<h2 class='h3 mb-4 text-gray-800'>Reviews and Ratings</h2>";
						}
						if($allcomment == null){
							echo "<div class='panel-body'><i><b>No review available</b></i></div>";
						} else {
							foreach ($allcomment as $comm){
								
								echo "<div class='panel panel-default'><div class='panel-heading'>By <b>".$comm['fullname']."</b> on ".$comm['date']."</div>";
								echo "<div class='panel-body'><ul class='list-inline'>";
								for($count=1; $count<=5; $count++){
									if($count <= $comm['rating']){
										$color = 'color:#ffcc00;';
									} else {
										$color = 'color:#ccc;';
									}
									
									echo "<li class='list-inline-item' style='cursor:pointer; ".$color." font-size:16px;'>&#9733;</li>";
								}
								echo "</ul></div>";
								echo "<div class='panel-body'>".$comm['comment']."</div>";
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


<script type="text/javascript"> 

function mouseOverRating(rating) {

        resetRatingStars(rating)

        for (var i = 1; i <= rating; i++)
        {
            var ratingId = "liststar_" + i;
            document.getElementById(ratingId).style.color = "#ffcc00";

        }
		
		document.getElementById("user_rating").value = rating;
		
}

function resetRatingStars(rating)
    {
        for (var i = 1; i <= 5; i++)
        {
            var ratingId = "liststar_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }
	
</script>
