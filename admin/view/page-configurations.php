<?php 
//include header template

// $searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
// if($searchValue =='')
// $searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

// $searchValue = ($searchValue == '' )? '':"WHERE code like '%".$searchValue."%' or message like '%".$searchValue."%' or status like '%".$searchValue."%' ";
// $query = "SELECT * FROM `order` ".$searchValue;

// $sql = mysql_query($query);
// $sql_assoc = mysql_fetch_assoc($sql);
// $total = mysql_num_rows($sql);
// $total = ($total < 1)?1: $total;
// $nrows = 10;
// $totalpages = ceil($total/$nrows);
// $page = isset($_POST['page'])? $_POST['page']:1;
// ######### PAGINACION ###############


// $query .= " LIMIT ".((($page*$nrows)-($nrows-1))-1).", ".$nrows;
// $sql = mysql_query($query);
// $records = mysql_num_rows($sql);



############################################

require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">CONFIGURATIONS</h2>
		</div>
		<form class="form_search" method="get" action="" >
			<p >Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value">
		</form>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
	
	</div>
</div>
<div id="content_containter">
	<div class="content_result_div">
		<div class="content_grid_result">
			<div>
				<div class="header_container">
				<div class="header_container_result">
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						CODE
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						ITEM
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						STATUS
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						MESSAGE
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						OPTIONS
					</div>
				</div>
				</div>
				<div class="result_container">
						<div class="row_container_result">
							<div class="row_column_result header_column_1_5 column_cel_1_3">
								x
							</div>
							<div class="row_column_result header_column_1_5 column_cel_1_3">
								x
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								x
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								x
							</div>
							<div class="row_column_result header_column_1_5  column_cel_1_3">
								x
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
<?php 
//include header template
require('layout/footer.php');
?>
