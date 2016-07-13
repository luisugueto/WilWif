<?php
require('layout/header.php');


if($user->is_logged_in() )
{
	$query = mysql_query("SELECT * FROM notifications WHERE id_user = '".$_SESSION['id']."'") or die("Error");
	$assoc = mysql_fetch_assoc($query);
}

?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
	<div class="rows" style=" display: block;">
			<?php
				$query = "SELECT * FROM notifications WHERE id_user = '".$_SESSION['id']."'";
				$sql = mysql_query($query);
				$sql_row = mysql_num_rows($sql);
				if($sql_row == 0)
				{
					echo "<tr>
					<td colspan='2'>No have.</td>
					</tr>";
				}
				while($sql_assoc = mysql_fetch_assoc($sql))
				{
			?>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Message</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="label" name="item_message" id="item_message" class="form-control input-lg" value="<?php echo $sql_assoc['message']; ?>">
								</div>
							</div>
				</div>	
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Create</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="label" name="item_message" id="item_message" class="form-control input-lg" value="<?php echo $sql_assoc['create_date']; ?>">
								</div>
							</div>
				</div>	
			<?php	 
				}
			?>
</div>
<?php
//include header template
require('layout/footer.php');
?>