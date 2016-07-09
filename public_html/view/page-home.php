<?php 

//include header template
require('layout/header.php'); 
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
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	<div id="search_container"  style=" display: inline-block;">
	<div style=" display: table; clear: both; content: '';">
	<div style="height: 140px; float: left; width: 400px; color:white">
		<div style="font-size: 60px;">
			Categories
		</div>
		
		<div id="search_filter_result" style="width: 400px; font-size: 25px; line-height: 50px; margin-top: 20px;">
		
		</div>
	</div>
	<div style="width: 800px; display: inline-block; background-color: rgba(240, 240, 240, 0.5); border-radius: 20px;overflow: auto;padding-top: 20px; padding-bottom: 20px; float: left;">
		
		<div id="search_result_container" class="rows" style=" display: block;">
			
		</div>
		
	</div>
	</div>
	<div id="search_page_result"  style="height: 0px; clear: both; content: ''; display: table; float: right;">
	
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
<script>
$("#search_form").submit(function(e){
  $('#search_value').click();
    e.preventDefault();
  });
  
	$("#search_icon").click(function(){
	var search_value_ = $( "#search_value" ).val();
    search_items(search_value_,'','');
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
if(search_value_ == '')
{
	return;
}
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
						
					for(var i=0;i< data.rows.length; i++)
					{
						var item_title = data.rows[i].item_title;
						var item_type = data.rows[i].item_type;
						var item_category = data.rows[i].item_category_slug;
						var item_user = data.rows[i].item_user;
						var item_photo_url = data.rows[i].item_photos_url[0];
						var item_code = data.rows[i].item_code;
						div_content += '<div class="item-row">';
						div_content += '<div style=" display: inline-block;">';
						div_content += '<div style="clear: both; content: \'\'; display: table; background-color: transparent; width: 750px; background-image: url(\'/image/cuadro_generico1_786x144.png\'); height: 157px; border-radius: 20px; background-size: 110% 110%; color: white; padding: 10px;">';
						div_content += '<div style="float: left;">';
						if(item_photo_url)
						{
							div_content += '<img src="'+item_photo_url+'" width="125" height="132" title="item photo">';	
						}else{
							div_content += '<img src="/image/No_image_available_125x132.png" width="125" height="132" title="item photo">';	
						}
						div_content += '</div>';
						div_content += '<div style="float: left; width: 500px; height: 137px; padding-left: 10px; padding-right: 10px;">';
						div_content += '<div style="height: 70px; font-size: 40px;">'+item_title+' </div>';
						div_content += '<div style="height: 60px; background-image: url(\'/image/barra-generica1-479-66.png\'); background-size: 100% auto; padding: 10px 25px 10px 10px; text-align: left; font-size: 20px; line-height: 20px;">';
						div_content += '<div>';
						div_content += '<label style="display: inline-block; width: 220px; overflow: hidden;">Type: '+item_type+'</label>';
						div_content += '<label style="display: inline-block; width: 220px; overflow: hidden;">Category: '+item_category+'</label>';
						div_content += '</div>';
						div_content += '<div>';
						div_content += '<label style="display: inline-block; width: 500px; overflow: hidden;">by: '+item_user+'</label>';
						div_content += '</div>';
						div_content += '</div>';
						div_content += '</div>';
						div_content += '<div style="float: left; height: 137px; width: 100px; padding-top: 60px;">';
						div_content += '<a href="/item/?code='+item_code+'">';
						div_content += '<img width="50" height="50" style="cursor: pointer;" src="/image/boton-masinfo-48-48.png">';
						div_content += '</a>';
						div_content += '<a href="/item/?code='+item_code+'">';
						div_content += '<p style="margin-top: 0px;">More Info!</p>';
						div_content += '</a>';
						div_content += '</div>';
						div_content += '</div>';
						div_content += '</div>';
						div_content += '</div>';
					}
					for(var i=0;i< data.category_list.length; i++)
					{
						div_category_content += '<li style="cursor: pointer;" onclick=search_items("'+data.search_value+'","'+data.category_list[i]+'","");>'+data.category_list[i]+'</li>';
					}
					div_category_content += '<li style="cursor: pointer;" onclick=search_items("'+data.search_value+'","","");>Remove</li>';
					div_pages_content = "";
					for(var i=1;i<=(data.pages);i++)
					{
						div_pages_content += '<li  style=" float: left; margin-right: 20px;cursor:pointer; color:white;" onclick=search_items("'+data.search_value+'","'+data.filter_value+'",'+i+');> '+i+' </li>';
					}
					
				  }
				   
				   $( "#search_result_container" ).html(div_content);
				   $( "#search_filter_result" ).html(div_category_content);
				   $( "#search_page_result" ).html(div_pages_content);
				   
            }
    });
}

<?php 
if(isset($_GET['s']))
{
?>
var search_value = '<?php echo $_GET['s']; ?>';
var filter_value = '<?php if(isset($_GET['filter'])){ echo $_GET['filter'];}else{echo '';} ?>';
 $(document).ready(function()
 {
	search_items(search_value,filter_value,'');
 });
 <?php 
}
?>
</script>
<?php
//include header template
require('layout/footer.php');
?>