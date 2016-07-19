
	<script src="/js/zuaruchat.js"></script>
	<link rel="stylesheet" type="text/css" href="/js/zuaruchat.css">


	
 <?php 
if($user->is_logged_in() ){
 ?>

 <footer style="background-image: url('/image/botonera-sola-1024-x-66.png'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:66px;">
	<div class="row"  style="height: 66px;">
		<a href="/account/" title="home">
		<?php 
		if($pagelocation =="home")
		{
		?>
			<div class="col-xs-2 col-md-2 home_footer_icon_on" >
		
		<?php
		}else{
		?>
			<div class="col-xs-2 col-md-2 home_footer_icon_off" >
		
		<?php
		}
		?>
		</div>
		<a/>
		<a href="/account/notifications/" title="Notification">
		<?php
			$query = "SELECT * FROM notification WHERE id_user = '".$_SESSION['id']."' AND status != 'Erased' AND status != 'Read'";
			$sql = mysql_query($query);
			$sql_row = mysql_num_rows($sql);
			if($sql_row > 0)
			{
			?>
				<div class="col-xs-2 col-md-2 notification_footer_icon_on" >
				
			<?php
				echo $sql_row;
			}else{
			?>
			
			<?php 
			if($pagelocation =="notification")
			{
			?>
				<div class="col-xs-2 col-md-2 notification_footer_icon_on" >
			
			<?php
			}else{
			?>
				<div class="col-xs-2 col-md-2 notification_footer_icon_off" >
			
			<?php
			}
			?>
			<?php
			}
			?>
			
			</div>
		<a/>
		<div class="col-xs-4 col-md-4">
		
		</div>
		
		<a href="/account/profile/" title="Profile">
		<?php 
			if($pagelocation =="profile")
			{
			?>
				<div class="col-xs-2 col-md-2 profile_footer_icon_on" >
			
			<?php
			}else{
			?>
				<div class="col-xs-2 col-md-2 profile_footer_icon_off" >
			
			<?php
			}
			?>
			
		
		</div>
		<a/>
		<a href="/share/" title="Share">
		
		<?php 
			if($pagelocation =="share")
			{
			?>
				<div class="col-xs-2 col-md-2 share_footer_icon_on" >
			
			<?php
			}else{
			?>
				<div class="col-xs-2 col-md-2 share_footer_icon_off" >
			
			<?php
			}
			?>
			
		
		</div>
		<a/>
	</div>
 </footer>
 <?php 
 }else{
  ?>
	<footer style="background-image: url('/image/botonera-sola-1024-x-66.png'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:66px;">
	<div class="row"  style="height: 66px;">
		
		<div class="col-xs-2 col-md-2" >
		
		</div>
		
		
		<div class="col-xs-2 col-md-2" >
		
		
		
		
		<div class="col-xs-4 col-md-4" >
		
		</div>
		
		
		<div class="col-xs-2 col-md-2" >
		
		</div>
		
		
		<div class="col-xs-2 col-md-2" >
		
		</div>
		
	</div>
 </footer>
  <?php
 }
?>
</div>

</body>
</html>