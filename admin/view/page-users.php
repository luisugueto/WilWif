<?php 

if(isset($_POST['employee_method']) &&  isset($_POST['username']))
{
	if($_POST['employee_method'] == "blocked")
	{
		BlockUser($_POST['username']);
	}else if($_POST['employee_method'] == "unblocked"){
		UnblockUser($_POST['username']);
	}
}

//include header template

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" and (username like '%".$searchValue."%' or email like '%".$searchValue."%' or name like '%".$searchValue."%' )";
$query = "SELECT * FROM user WHERE status !='Erased' and rol_id in (select id from rol where code ='001')".$searchValue;
 
$sql = mysql_query($query);
$sql_assoc = mysql_fetch_assoc($sql);
$total = mysql_num_rows($sql);
$total = ($total < 1)?1: $total;
$nrows = 10;
$totalpages = ceil($total/$nrows);
$page = isset($_POST['page'])? $_POST['page']:1;
######### PAGINACION ###############


$query .= " LIMIT ".((($page*$nrows)-($nrows-1))-1).", ".$nrows;
$sql = mysql_query($query);
$records = mysql_num_rows($sql);



############################################



require('layout/header.php'); 
?>
<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png'); height:100px">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-3 col-md-3">	
		<a href='/'>
			<p class="fontsize_3" style="margin-bottom: 0px;"><img src="/image/flecha2-27-46.png">back</p>
		</a>
		</div>
		
		<div class="col-xs-6 col-md-6">	
			<a href="/">
				<img style="margin-top: 2%; margin-bottom: 3%;" src="/image/Logotipo-110-x-32.png" title="logo" width="110" height="32" >
			</a>
		</div>
		<div class="col-xs-3 col-md-3">
		
		</div>
	</div>
</header>
<div id="content">
<div class="row">
					<div class="col-xs-12 col-md-12 fontsize_4">
						<form method="get" action="" >
							<input type="text" placeholder="Search" style="height: 31px; background-image: url('/image/lupa_31x31.png'); background-repeat: no-repeat; background-size: 25px 25px; background-position: right center; text-align: center;" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" >
						</form>
					</div>
				</div>
					<?php

						while($row = mysql_fetch_assoc($sql))
						{
							
						
						
						?>
						
						
								<div class="row" >
								
								<div class="col-xs-12 col-md-12 ">
								<a href="/users/user/?username=<?php echo $row['username']?>">
								<div class="row_user" style="background-color:white">
								<p ><label class="result_user_label"><span style="color:gray">Username:</span><span style="color:orange"><?php echo $row['username'];?></span></label><label class="result_user_label"><span style="color:gray">Email:</span><span style="color:orange"><?php echo $row['email'];?></span></label></p>
								<p><label class="result_user_label"><span style="color:gray">Name:</span><span style="color:orange"><?php echo $row['name'];?>  <?php echo $row['lastname'];?></span></label><label class="result_user_label"><span style="color:gray">Status:</span><span style="color:orange"><?php echo $row['status'];?></span></label></p>
								</div>
								</a>
								</div>
								
								</div>
								
							
						<?php
					}
					?>
				<div class="row" style="height:50px">
					<div class="col-xs-12 col-md-12 fontsize_2">
					
					<div class="maxpr">	
					<?php 
					if($totalpages > 1)
						{
						
						$maxi = ($page+2 <= $totalpages )? $page+2: (($page+1 <= $totalpages )? $page+1: $totalpages);
						$mini = ($page-2 >= 1 )? $page-2: (($page-1 >= 1 )? $page-1: 1);
						for($i = $mini ; $i<= $maxi;$i++)
						{
							if($i ==$page-2 && $i != 1)
							{
								?>
									<form action="" method="post">
										<input type="hidden" name="page" value=1>
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input submit class="page_index" value ="1.">
									</form>
								<?php
							}
							if($i == $page)
							{
								?>
									<input type="submit" class="page_index current_page" value ="<?php echo $i;?>">
								<?php
							}else{
								?>
									<form action="" method="post">
										<input type="hidden" name="page" value="<?php echo $i;?>">
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input type="submit" class="page_index" value ="<?php echo $i;?>">
									</form>
								<?php
							
							}
			
							if($i == $page+2 && $i != $totalpages)
							{
								?>
									<form action="" method="post">
										<input type="hidden" name="page" value="<?php echo $totalpages;?>">
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input type="submit" class="page_index" value =".<?php echo $totalpages;?>">
									</form>
								<?php
							}
						}
						}
					?>
					</div>
					
					</div>
				</div>
		
	
</div>		
<style>
<style>

.result_user_label{

width:50%;
}
.row_user{
	background-color: white;
	border-width: 1px;
	color: orange;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 5px;
	padding-left: 20px;
	padding-right: 20px;
	text-align: left;
	width: 320px;
	margin:auto;
	border-radius:10px;

}

.row_user span{

}
.maxpr{
	margin:auto;
	width: 316px;
	text-align:right
	display:tablet;
}
/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
	.row_item
	{
		width: 600px;	
	}

.maxpr{
	
	width: 474px;
}
 

}
</style>	
		
</style>
<?php 
//include header template
require('layout/footer.php');
?>