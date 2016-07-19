<?php
require('layout/header.php');

if (isset($_POST['notification_method']) && isset($_POST['notification_id'])) {
	

			$notification_id = $_POST['notification_id'];
		$query = "UPDATE notification SET status = 'Read' WHERE id = ".$notification_id."";
		$sql = mysql_query($query);
}
?>

<div id="content" style="min-height:375px;">
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">
	
<div class="row">	
	<div class="col-xs-3 col-md-2" >
		<a href='/account/'>
			<p>back</p>
		</a>
	</div>
	
	<div class="col-xs-6 col-md-8" >
		<p></p>
	</div>
					
	<div class="col-xs-3 col-md-2" >
	
	</div>
	</div>
	</div>
<div class="row"  style="border-color:gray;margin-bottom: 5px; margin-top: 10px;  border-width: 0px 0px 1px; border-style: solid;">
	<div class="col-xs-0 col-md-4" >
		
	</div>
	<div class="col-xs-12 col-md-4" >
		<p style="color:blue">Notifications</p>
	</div>
	<div class="col-xs-0 col-md-2" >
		
	</div>
	
	
</div>
<div class="row"  style="text-align:left;color:blue; border-color:gray;   border-width: 0px 0px 1px; border-style: solid;">
	<div class="col-xs-12 col-md-4" >
		<p style="color:blue; padding-left:10px;">INBOX</p>
	</div>
	<div class="col-xs-12 col-md-4" >
		
	</div>
	<div class="col-xs-0 col-md-2" >
		
	</div>
	
	
</div>
<div id="content">


			<?php
				$query = "SELECT * FROM notification WHERE id_user = '".$_SESSION['id']."' AND status != 'Erased' AND status != 'Read'";
				$sql = mysql_query($query);
				$sql_row = mysql_num_rows($sql);
				if($sql_row == 0)
				{
				?>
					<tr>
					<td colspan='4'>No Data to display.</td>
					</tr>
				<?php
				}
				
				while($sql_assoc = mysql_fetch_assoc($sql))
				{
			?>
				
				<div class="row row_notification" id="message<?php echo $sql_assoc['id'];?>" onclick="MessageRead(<?php echo $sql_assoc['id'];?>)">
					
					<div class="col-xs-12 col-md-12" >
						<div class="notification">
						<?php echo $sql_assoc['message'] ?>
						</div>
					</div>
					
				</div>
					<?php	 
				}
			?>
			</div>
			<div class="row div_input_principal"  style="color:blue; text-align: center; ">
	<div class="col-xs-12 col-md-12">
		<p class="fontsize_4 p_button" >
			<img  class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png">
		</P>
	</div>	
</div>
		
<script>	
function MessageRead(messageid)
{
	var ajaxData =  "notification_id="+messageid;
    $.ajax({
         type: "POST",
         url: "/execution/read_notification/",
         data: ajaxData,
		 dataType: 'json',
         success: function(data){
			if(data.success)
			{
				$( "#message"+data.notification_id ).addClass( "selected_highlight" );
				setTimeout(function() {
				  $( "#message"+data.notification_id ).remove();
				}, 2000);
			}
			
		 }
    });
}
</script>	
<style>

.botonera_button_principal{
 margin-bottom:-50px;

background-color: transparent;
background-size:100% 100%;
border-width: 0px;
width:83px;
height:129px;
margin-top:50px;

}

.selected_highlight
	{
		background-image: url("/image/casilla-mensaje-saliente-473-x-91.png") !important;
		color:orange !important;
	}
	
.row_notification
	{	
		background-color: white;
		background-image: url("/image/casilla-mensaje-entrante-474-x-91.png");
		background-size: 100% 100%;
		border-width: 1px;
		color: white;
		margin-left: 10px;
		margin-right: 10px;
		margin-top: 5px;
		padding-left: 20px;
		padding-right: 20px;
		text-align: left;
		margin:auto;
		width: 316px;
		height: 60px;
	}	
/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
	.row_notification
	{
		width: 474px;	
		height: 91px;		
	}

	.botonera_button_principal{
	width:111px;
	height:176px;
	margin-top:0px;
 }
 

}

</style>	
	
<?php
//include header template
require('layout/footer.php');
?>