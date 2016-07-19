<?php
if (isset($_POST['item_method']) && isset($_POST['item_code'])) {
	$item_method = $_POST['item_method'];

if($item_method == "deleted")
	{
			$item_code = $_POST['item_code'];
		$query = "UPDATE item SET status = 'Erased' WHERE code = '".$item_code."'";
		$sql = mysql_query($query);
	
	}
}
require('layout/header.php');
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
	<a id="edititem"><p>edit</p></a>
	</div>
	</div>
	</div>
<div class="row"  style="border-color:gray;color:blue;margin-bottom: 5px; margin-top: 10px;">
	<div class="col-xs-0 col-md-4" >
		
	</div>
	<div class="col-xs-12 col-md-4" >
		<p>My List</p>
	</div>
	<div class="col-xs-0 col-md-2" >
		
	</div>
	
	
</div>

		
			<?php
				$query = "SELECT code FROM item WHERE id_user = '".$_SESSION['id']."' AND status != 'Erased'";
				$sql = mysql_query($query);
				$sql_row = mysql_num_rows($sql);
				if($sql_row == 0)
				{
					echo "<tr>
					<td colspan='4'>No item to display.</td>
					</tr>";
				}
				while($sql_assoc = mysql_fetch_assoc($sql))
				{
					$item = new item($sql_assoc['code']);
			?>
				<div class="row row_item" id="<?php echo $item->item_code;?>"onclick="SelectRow('<?php echo $item->item_code;?>')">
				
				<div class="col-xs-2 col-md-4" >
						
						<?php 
						if($item->item_category_slug == 'Phone')
						{
							
							echo '<img class="img_category_phone" src="/image/mobile-1-59-x-97.png"  width="59" height="97" >';
							
						}else if($item->item_category_slug == 'Key')
						{
							
							echo '<img class="img_category_key" src="/image/key-1-97-x-97.png"  width="97" height="97" >';
							
						}else if($item->item_category_slug == 'Case')
						{
							
							echo '<img  class="img_category_suitecase" src="/image/maleta-1-98-x-83.png"  width="98" height="83" >';
							
						}else if($item->item_category_slug == 'Tablet')
						{
							
							echo '<img class="img_category_tablet" src="/image/tablet-1-73-x-96.png"  width="73" height="96" >';
							
						}else if($item->item_category_slug == 'Backpack')
						{
							
							echo '<img class="img_category_backpack" src="/image/bulto-1-95-x-97.png"  width="95" height="97" >';
							
						}else if($item->item_category_slug == 'Luggage')
						{
							
							echo '<img class="img_category_luggage" src="/image/maleta-rueda-1-55-x-97.png" width="55" height="97" >';
							
						}else if($item->item_category_slug == 'Laptop')
						{
							
							echo '<img class="img_category_laptop" src="/image/laptop-1-97-x-67.png"  width="97" height="67" >';
							
						}else if($item->item_category_slug == 'Camera')
						{
							
							echo '<img class="img_category_camera" src="/image/camara-1-98-x-70.png"  width="98" height="70" >';
							
						}else if($item->item_category_slug == 'Passport')
						{
							
							echo '<img class="img_category_pass" src="/image/pass-68-x-94.png"  width="68" height="94" >';
							
						}else if($item->item_category_slug == 'Driver License')
						{
							
							echo '<img class="img_category_identitycard" src="/image/ID-1-98-x-66.png"  width="98" height="66" >';
							
						}else if($item->item_category_slug == 'Credit / Debit Card')
						{
							
							echo '<img class="img_category_creditcard" src="/image/credit-1-card-98-x-66.png"  width="98" height="66" >';
							
						}else if($item->item_category_slug == 'Other')
						{
							
							echo '<img class="img_category_other" src="/image/crus-93-x-93.png"  width="93" height="93" >';
							
						}
						?>
				</div>
				<div class="col-xs-6 col-md-4 label_code">
					<p class="fontsize_5" style="margin-bottom: 0px;">WilWif Code: <?php echo $item->item_code;?></p>
				</div>
				
				<div class="col-xs-4 col-md-4" class="text-align:left">
					<?php 
						if($item->item_status =="Lost")
						{
							echo '<img class="img_lost_icon" src="/image/VIEW-&-EDIT-ITEMS-Lost-48-x-43.png" title="logo" width="50" height="39" >';
						}
					?>
				</div>
				</div>
					
					
					
					
			
					
			<?php	 
				}
			?>
	<div class="row div_input_principal"  style="color:blue; text-align: center; ">
	<div class="col-xs-12 col-md-12">
		<p class="fontsize_4 p_button" >
			<img  class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png">
		</P>
	</div>	
</div>
</div>
<script>

var preview=null;
function SelectRow(itemcode){
	if(preview)
	{
		$( "#"+preview ).removeClass( "selected_highlight" );
	}
	preview = itemcode;
	$( "#"+itemcode ).addClass( "selected_highlight" );
	$("#edititem").attr("href", "/account/found-item/?code="+itemcode);
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




.row{
		margin-right:0px;
	}
	
	.selected_highlight
	{
		background-color:orangered;
		color:white !important;
	}
	
	
	.row_item
	{	
		height:75px;
		color:orange;
		border-width: 1px 0px;
		border-style: solid;
		border-color: gray;
	}	
	
	.label_code{
		line-height:75px;
	}	
	

	/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
	.row_item
	{	
		height:100px;
	}
	
	.label_code{
		line-height:100px;
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