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
	
	
<div id="search_container">
	<div id="search_filter_result">
	</div>
	<div id="search_result_container">
	
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
    search_items(search_value_,'');
}); 

$(document).keypress(function(e) {
    if(e.which == 13) {
		 var search_value_ = $( "#search_value" ).val();
    search_items(search_value_,'');
    }
});
function search_items(search_value_,filter_value_)
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
						var item_category = data.rows[i].item_category_slug;
						var item_user = data.rows[i].item_user;
						var item_photo_url = data.rows[i].item_photos_url[0];
						var item_code = data.rows[i].item_code;
						div_content += '<div class="search_item_container" style="height: 200px; background-image: url(/image/cuadro_inicia_732x152.png); background-size: 102% 100%;">';
						div_content += '<div class="search_item_photo_container" style="float: left; width: 200px; background-image: url(../image/recuadro_imagen_125x132.png); background-repeat: no-repeat; height: 200px; padding: 29px 0px 0px; background-size: 100% 100%;">';
						
						if(item_photo_url)
						{
							div_content += '<img src="'+item_photo_url+'" width="125" height="132" title="item photo">';	
						}else{
							div_content += '<img src="/image/No_image_available_125x132.png" width="125" height="132" title="item photo">';	
						}
						
						
						div_content += '</div>';
						div_content += '<div class="search_item_information_container"  style="float: left; width: 80%;">';
						div_content += '<div>';
						div_content += '<h3>'+item_title+'</h3>';
						div_content += '</div>';
						div_content += '<div  style="height: 60px;">';
						div_content += '</div>';
						div_content += '<div style="height: 71px;">';
						div_content += '<div style="height: 70px; float: left; background-image: url(/image/barra_titulo_345x43.png); background-size: 100% 100%; width: 232px; font-size: 20px; padding-top: 18px;margin-left: -35px;">';
						div_content += '<h3	style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 14px;">'+item_category+'</h3>';
						div_content += '<h3 style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 14px;">'+item_user+'</h3>';
						div_content += '</div>';
						div_content += '<div  style="height: 26px; float: right; padding-top: 20px; border-right-width: 0px; margin-right: 30px;">';
						div_content += '<form action="/item/" method="get">';
						div_content += '<input type="hidden"  name="code" value="'+item_code+'">';
						div_content += '<input type="submit" value="More Info" style="height: 33px; background-image: url(/image/boton_moreinfo_on_134x36.png); background-size: 100% 100%; width: 100px; border-width: 0px; background-color: transparent;">';
						div_content += '</form>';	
						div_content += '</div>';
						div_content += '</div>';
						div_content += '</div>';
						div_content += '</div>';
					}
					for(var i=0;i< data.category_list.length; i++)
					{
						div_category_content += '<li onclick=search_items(search_value,"'+data.category_list[i]+'");>'+data.category_list[i]+'</li>';
					}
					div_category_content += '<li onclick=search_items(search_value,"");>Remove</li>';
				   }
				   
				   $( "#search_result_container" ).html(div_content);
				   $( "#search_filter_result" ).html(div_category_content);
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
	
    search_items(search_value,filter_value);
 });
 <?php 
}
?>
</script>
<?php
//include header template
require('layout/footer.php');
?>