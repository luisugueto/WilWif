<?php 

//include header template
require('layout/header.php'); 
?>
<div id="content">

<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<form id="search_form" class="form_search" method="get" action="" >
			<p >Search</p>
			<input id="search_value" type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value">
		</form>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
		<?php require('layout/menu.php');  ?>
	</div>
</div>

<div id="div_mobile_category_menu">
				Categories
</div>

<div id="content_containter" >

	<div class="search_container">
		<div class="grid_result_container" >
			
			<div id="filter_container" class="filter_container filter_close">
				<div class="search_filter_header">
					Categories
				</div>
		
				<div class="search_filter_result" >
					 <?php if(!isset($_GET['s']))
					{	
					?>
						<ul>
							<li><span>-Passport</span><li>
						</ul>
					 <?php 
					}
					?>
				</div>
			</div>
			<div class="result_container">
		
				<div class="result_row" class="rows">
					<div class="item-row">
						<div class="row_item_frame">
							<div class="row_item_container">
								<div class="row_item_img_container">
									<img width="125" height="132" title="item photo" src="/images/2016/07/2016-0707-O8OH-GrK2-Pasaporte Argentina.jpg">
								</div>
								<div class="row_item_information_container" >
									<div class="row_item_title_container" >pasaporte omar </div>
									<div class="row_item_detail_container">
										<div>
											<label class="row_item_type_label" >Type: Found</label>
											<label class="row_item_category_label" >Category: Passport</label>
										</div>
										<div>
											<label class="row_item_type_holder" >by: omar</label>
										</div>
									</div>
								</div>
								<div class="item_action_container" >
									<a href="/item/?code=2016-0707-omTb-3554">
										<img width="50" height="50" src="/image/boton-masinfo-48-48.png">
									</a>
									<a href="/item/?code=2016-0707-omTb-3554">
										<p style="margin-top: 0px;">More Info!</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
		
			</div>
		</div>
		<div class="pages_container">
			<div class="pages_container_index">
				<form action="" method="post">
					<input type="hidden" name="page" value="2">
					<input type="hidden" name="s" value="">
					<input type="submit" class="page_index" value ="2">
				</form>
			</div>
		</div>
		
	</div>	
<?php 
 if(isset($_GET['s']))
 {
	$sql = 'SELECT code FROM item';
	$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
	?>
	<div>
	<?php
	while($row = mysql_fetch_assoc($query))
	{
		$item = new item($row["code"]);
		?>
			
		<?php
	}
	?>
	</div>
	<?php
 }
?>

</div>
</div>
<style>

#div_mobile_category_menu{
	display:none;
	width:100%;
	height:30px;
	color:white;
}
.search_container{
	display: block;
	width: 1178px;
}

.grid_result_container{
	display: table; 
	clear: both;
	content: '';
	width: 1278px;
}

.filter_container{
	height: 140px;
	float: left;
	color:white;
	width: 364px;
	padding-right: 89px;
	text-align: left;
}

.search_filter_header{
	font-size: 60px;
}

.search_filter_result{
	font-size: 25px;
	line-height: 50px;
	margin-top: 20px;
}

.result_container{
	width: 914px;
	display: inline-block;
	background-image: url("/image/cuadro-blanco1-914-488.png");
	min-height: 488px;
	padding-top: 20px;
	padding-bottom: 20px;
	float: left;
}

.result_row{
	display: block;
}

.item-row{
	width: 784px;
	display: inline-block;
	margin-bottom: 20px;
}

.row_item_frame{
	display: inline-block;
}

.row_item_container{
	clear: both;
	content: "";
	display: table;
	background-color: transparent;
	width: 750px;
	height: 157px;
	background-size: 110% 110%;
	color: white;
	padding: 10px;
	background-image: url("/image/cuadro-generico1-786-144.png");
}

.row_item_img_container{
	float: left;
	height: 137px;
	padding-left: 10px;
	padding-right: 10px;
}

.row_item_information_container
{
	float: left;
	width: 500px;
	height: 137px;
	padding-left: 10px;
	padding-right: 10px;
}

.row_item_title_container{
	font-size: 30px;
    height: 70px;
    line-height: 70px;
    text-align: left;
}

.row_item_detail_container{
	height: 60px;
	background-image: url('/image/barra-generica1-479-66.png');
	background-size: 100% auto;
	padding: 10px 25px 10px 10px;
	text-align: left;
	font-size: 20px;
	line-height: 20px;
}

.row_item_type_label{
	display: inline-block;
	width: 220px;
	overflow: hidden;
	height: 22px;
}

.row_item_category_label{
	display: inline-block;
	width: 220px;
	overflow: hidden;
	height: 22px;
}

.row_item_type_holder{
	display: inline-block;
	width: 500px;
	overflow: hidden;
	height: 22px;
}

.item_action_container{
	float: left;
	height: 137px;
	width: 80px;
}

.item_action_container img{
		cursor: pointer; 
		margin-top: 60px;
	}

.pages_container{
	width: 1278px;
	text-align: right;
}

.pages_container_index{
	display: inline-flex;
}

.page_index{
	 background-color: transparent;
    color: orange;
    cursor: pointer;
    float: left;
    font-size: 25px;
    margin-right: 20px;
	border-width: 0px;
}	

.current_page{
	color:white;
}

@media all and (max-width: 1024px)
{
	.search_container{
		width: 694px;
	}
	
	.grid_result_container{
		width: 694px;
	}
	
	.filter_container{
		padding-right: 48px;
		width: 150px;
	}
	
	.search_filter_header{
		width: 102px;
		font-size: 30px;
	}
	
	.search_filter_result{
		font-size: 20px;
	}
	
	.result_container{
		width: 500px;
	}
	
	.item-row{
		width: 423px;
	}
	
	.row_item_frame{
		width: 423px;
	}
	
	.row_item_container{
		width: 423px;
		height: 100px;
	}
	
	.row_item_img_container{
		height: 100px;
	}
	
	.row_item_img_container img{
		width: 100px;
		height: 100px;
	}
	.row_item_information_container{
		width: 243px;
		height: 100px;
	}
	
	.row_item_title_container{
		height: 40px; 
		line-height: 40px;
	}
	
	.row_item_detail_container{
		padding: 2px 15px 2px 2px;
	}
	
	.row_item_type_label{
		font-size: 15px;
		height: 18px;
		width: 80px;
	}
	
	.row_item_category_label{
		height: 18px;
		font-size: 15px;
		width: 126px;
	}
	
	.row_item_type_holder{
		height: 18px;
		font-size: 15px;
		width: 206px;
	}
	
	.item_action_container{
		width: 40px;
		padding-top: 0px;
		height: 100px;
	}

	.item_action_container img{
		cursor: pointer; 
		width: 40px;
		height: 40px; 
		margin-top: 20px;
	}
	
	.pages_container{
		width: 650px;
	}
	
	.page_index{
		 font-size: 20px;
	}
}

@media all and (max-width: 420px)
{
	.search_filter_header{
		display:none;
	}
	
	#content_containter{
		margin-top: 0px !important;
	}
	#div_mobile_category_menu{
		display:block;
	}
	.search_container{
		width: 280px;
		display: inline-block;
	}

	.grid_result_container{
		float:none;
		width: 280px;
		display: inline-block;
	}
	
	.filter_container{
		width: 100px; 
		padding-right: 10px;
		float:none;
	}
	
	.search_filter_header{
		width: 90px;
		font-size: 20px;
	}
	
	.search_filter_result{
		width: 90px; font-size: 12px;
		line-height:20px;
	}
	
	.result_container{
		width: 280px;
	}
	
	.result_row{
		width: 270px;
	}
	
	.item-row{
		width: 260px;
	}
	
	.row_item_frame{
		width: 260px;
	}
	
	.row_item_container{
		width: 260px;
		padding: 5px;
	}
	
	.row_item_img_container{
		height: 75px;
		float: none;
		width: 260px;
	}
	
	.row_item_img_container img{
		height: 75px;
		width: 75px;
	}
	.row_item_information_container{
		font-size: 20px;
		text-align: center;
		float:none;
		padding-left: 0px;
		padding-right: 0px; 
		width: 260px;
	}
	
	.row_item_title_container{
		width: 260px;
		font-size: 15px;
		text-align: center;
		overflow: hidden;
	}
	
	.row_item_type_label{
		font-size: 12px;
		line-height: 13px;
		height: 16px;
	}
	
	.row_item_category_label{
		line-height: 13px;
		font-size: 12px;
		height: 16px;
	}
	
	.row_item_type_holder{
		font-size: 13px;
		line-height: 13px;
		height: 16px;
	}
	
	.item_action_container{
		width: 260px;
		float: none;
		height: 55px;
	}
	.item_action_container img{
		width: 30px;
		height: 30px;
		margin-top:5px;
	}

	.pages_container{
		width: 280px;
	}
	
	.page_index{
		width: 25px;
		font-size: 18px;
		margin-right: 10px;
	}
	
	.filter_container{
		overflow:hidden;	}
	
	.filter_open{
		-moz-transition: height 1s ;
		-webkit-transition: height 1;
		-o-transition: height 1s ;
		transition: height 1s ;
		height: auto;
	}
	
	.filter_close{
		-moz-transition: height 1s;
		-webkit-transition: height 1s ;
		-o-transition: height 1s ;
		transition: height 1s ;
		height: 0;
	}
	


}
</style>
<script>


	$("#div_mobile_category_menu").click(function() {
		if($("#filter_container").hasClass( "filter_open" ))
		{
			$("#filter_container").removeClass( "filter_open" );
			$("#filter_container").addClass( "filter_close" );
		}else{
			$("#filter_container").removeClass( "filter_close" );
			$("#filter_container").addClass( "filter_open" );
		}
	});
	


$("#search_form").submit(function(e){
  $('#search_value').click();
    e.preventDefault();
  });
  
	$("#search_icon").click(function(){
	var search_value_ = $( "#search_value" ).val();
    search_items(search_value_,'','');
	return false;
}); 

$(document).keypress(function(e) {
    if(e.which == 13) {
		 var search_value_ = $( "#search_value" ).val();
    search_items(search_value_,'','');
    }
});
function search_items(search_value_,filter_value_,page_)
{
var div_content = '';
var div_category_content = '';

if(filter_value_ != '')
{
 filter_value_ = "&filter="+filter_value_
}

if(page_ != '')
{
	 filter_value_ = "&page="+page_+filter_value_
}
var ajaxData =  "s="+search_value_+filter_value_;
    $.ajax({
         type: "POST",
         url: "/execution/search_items/",
         data: ajaxData,
		 dataType: 'json',
         success: function(data){
				
                   if(data.success)
				   {
					$( ".result_row" ).html("");
					for(var i=0;i< data.rows.length; i++)
					{
						
						var item_title = data.rows[i].item_title;
						var item_type = data.rows[i].item_type;
						var item_category = data.rows[i].item_category_slug;
						var item_user = data.rows[i].item_user;
						var item_photo_url;
						if(data.rows[i].item_photos_url)
						{
							item_photo_url = data.rows[i].item_photos_url[0];
						}else{
							item_photo_url = '/image/No_image_available_125x132.png'; 
						}
						var item_code = data.rows[i].item_code;
						var item_row = $("<div></div>");
						item_row.addClass( "item-row");
						
						var row_item_frame = $("<div></div>");
						row_item_frame.addClass( "row_item_frame");
						
						var row_item_container = $("<div></div>")
						row_item_container.addClass( "row_item_container");
						
						var row_item_img_container = $("<div></div>")
						row_item_img_container.addClass( "row_item_img_container");
						
						var row_item_img = $("<img src='"+item_photo_url+"' width='125' height='132' title='item photo'>");
						
						row_item_img_container.append(row_item_img);
						row_item_container.append(row_item_img_container);
						
						var row_item_information_container = $("<div></div>")
						row_item_information_container.addClass( "row_item_information_container");
						// start row_item_title_container
						var row_item_title_container = $("<div></div>")
						row_item_title_container.addClass( "row_item_title_container");
						row_item_title_container.html(item_title);
						row_item_information_container.append(row_item_title_container);
						// end row_item_title_container
						//start row_item_detail_container
						var row_item_detail_container = $("<div></div>")
						row_item_detail_container.addClass( "row_item_detail_container");
						row_item_information_container.append(row_item_detail_container);
						
						//start div 1
						var row_item_div_1 = $("<div></div>")
						row_item_detail_container.append(row_item_div_1);
						
						var row_item_type_label = $("<label></label>")
						row_item_type_label.addClass( "row_item_type_label");
						row_item_type_label.html('Type: '+item_type);
						row_item_div_1.append(row_item_type_label);
						
						var row_item_category_label = $("<label></label>")
						row_item_category_label.addClass( "row_item_category_label");
						row_item_category_label.html('Category: '+item_category);
						row_item_div_1.append(row_item_category_label);
						//end div 1
						//star div 2
						var row_item_div_2 = $("<div></div>")
						row_item_detail_container.append(row_item_div_2);
						
						var row_item_type_holder = $("<label></label>")
						row_item_type_holder.addClass( "row_item_type_holder");
						row_item_type_holder.html('by: '+item_user);
						row_item_div_2.append(row_item_type_holder);
						
						//end div 2
						// end row_item_detail_container
						
						
						//start  item_action_container
						var item_action_container = $("<div></div>")
						item_action_container.addClass( "item_action_container");
						
						// start link img more info
						var item_more_info_link = $("<a href='/item/?code="+item_code+"'>");
						item_action_container.append(item_more_info_link);
						
						var img_more_info_link = $('<img width="50" height="50" style="cursor: pointer;" src="/image/boton-masinfo-48-48.png">');
						item_more_info_link.append(img_more_info_link);
						
						// end link more info more info
						// start link label more info
						var item_more_info_link_label = $('<a href="/item/?code='+item_code+'">');
						item_action_container.append(item_more_info_link_label);
						
						var label_more_info_link = $('<p style="margin-top: 0px;">More Info</p>');
						item_more_info_link_label.append(label_more_info_link);
						
						// end link label more info
						//end  item_action_container
						row_item_container.append(row_item_information_container);
						row_item_container.append(item_action_container);
						row_item_frame.append(row_item_container);
						item_row.append(row_item_frame);
						$( ".result_row" ).append(item_row);
						
					}
					 $( ".search_filter_result" ).html("");
					 var filterList = $('<ul></ul>');
					 $( ".search_filter_result" ).append(filterList);
					
					for(var i=0;i< data.category_list.length; i++)
					{
						 var itemList = $('<li></li>');
						 itemList.html('-'+data.category_list[i]);
						 addclickEventPaginatio(itemList,data.search_value,data.category_list[i],1);
						filterList.append(itemList);
						//div_category_content += '<li style="cursor: pointer;" onclick=search_items("'+data.search_value+'","'+data.category_list[i]+'","");>-'+data.category_list[i]+'</li>';
					}
					if(data.filter_value !="")
					{
						 var itemList = $('<li></li>');
						 itemList.html('Less');
						 addclickEventPaginatio(itemList,data.search_value,'',1);
						filterList.append(itemList);
					}
					
							
					maxi = (data.page+2 <= data.pages )? data.page+2: ((data.page+1 <= data.pages )? data.page+1: data.pages);
					mini = (data.page-2 >= 1 )? data.page-2: ((data.page-1 >= 1 )? data.page-1: 1);
					 $( ".pages_container_index" ).html("");
					for(var i=mini;i<=maxi;i++)
					{
						if(i ==data.page-2 && i != 1)
						{
							var pageIndexForm = $("<form></form>");
							var pageIndex = $("<input name='filter' type='submit'/>");
							pageIndex.addClass( "page_index");
							pageIndex.val("1..");
							addclickEventPaginatio(pageIndex,data.search_value,data.filter_value,1);
							pageIndexForm.append(pageIndex);
							$( ".pages_container_index" ).append(pageIndexForm);
							
							}
					
						if(i == data.page)
						{
							var pageIndexForm = $("<form></form>");
							var pageIndex = $("<input name='filter' type='submit'/>");
							pageIndex.addClass( "page_index");
							pageIndex.addClass( "current_page");
							pageIndex.val(i);
							addclickEventPaginatio(pageIndex,data.search_value,data.filter_value,i);
							pageIndexForm.append(pageIndex);
							$( ".pages_container_index" ).append(pageIndexForm);
							
							}else{
							var pageIndexForm = $("<form></form>");
							var pageIndex = $("<input name='filter' type='submit'/>");
							pageIndex.addClass( "page_index");
							pageIndex.val(i);
							addclickEventPaginatio(pageIndex,data.search_value,data.filter_value,i);
							
							pageIndexForm.append(pageIndex);
							$( ".pages_container_index" ).append(pageIndexForm);
							
							}
						if(i == data.page+2 && i !=data.pages)
						{
							var pageIndexForm = $("<form></form>");
							var pageIndex = $("<input name='filter' type='submit'/>");
							pageIndex.addClass( "page_index");
							pageIndex.val(".."+data.pages);
							addclickEventPaginatio(pageIndex,data.search_value,data.filter_value,data.pages);
							pageIndexForm.append(pageIndex);
							$( ".pages_container_index" ).append(pageIndexForm);
						}
					}
				}
			}
    });
}

function addclickEventPaginatio(input,search_value,filter_value,i)
{
	input.click(function()
	{	
		search_items(search_value,filter_value,i);
		return false;
	});
}
var search_value = '<?php if(isset($_GET['s'])){ echo $_GET['s'];} ?>';
var filter_value = '<?php if(isset($_GET['filter'])){ echo $_GET['filter'];} ?>';
 $(document).ready(function()
 {
	search_items(search_value,filter_value,'');
 });
</script>
<?php
//include header template
require('layout/footer.php');
?>