<?php 

//include header template
require('layout/header.php'); 
?>
<div id="search_result_container">
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
<script>
$("#search_form").submit(function(e){
  $('#search_value').click();
    e.preventDefault();
  });
  
	$("#search_icon").click(function(){
	var search_value_ = $( "#search_value" ).val();
    search_items(search_value_);
}); 

$(document).keypress(function(e) {
    if(e.which == 13) {
		 var search_value_ = $( "#search_value" ).val();
    search_items(search_value_);
    }
});
function search_items(search_value_)
{
var div_content = '';
    $.ajax({
         type: "POST",
         url: "/execution/search_items/",
         data: "s=" + search_value_,
		 dataType: 'json',
         success: function(data){
				
                   if(data.success)
				   {
						
					for(var i=0;i< data.rows.length; i++)
					{
						div_content += '<div class="search_item_container" style="height: 200px; background-image: url(/image/cuadro_inicia_732x152.png); background-size: 102% 100%;">';
						div_content += '<div class="search_item_photo_container" style="float: left; width: 200px; background-image: url(../image/recuadro_imagen_125x132.png); background-repeat: no-repeat; height: 200px; padding: 29px 0px 0px; background-size: 100% 100%;">';
						div_content += '<img src=/image/No_image_available_125x132.png width="125" height="132" title="item photo">';		
						div_content += '</div>';
						div_content += '<div class="search_item_information_container"  style="float: left; width: 80%;">';
						div_content += '<div>';
						div_content += '<h3>item title</h3>';
						div_content += '</div>';
						div_content += '<div  style="height: 60px;">';
						div_content += '</div>';
						div_content += '<div style="height: 71px;">';
						div_content += '<div style="height: 70px; float: left; background-image: url(/image/barra_titulo_345x43.png); background-size: 100% 100%; width: 232px; font-size: 20px; padding-top: 18px;margin-left: -35px;">';
						div_content += '<h3	style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 14px;"> item type</h3>';
						div_content += '<h3 style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 14px;">item user</h3>';
						div_content += '</div>';
						div_content += '<div  style="height: 26px; float: right; padding-top: 20px; border-right-width: 0px; margin-right: 30px;">';
						div_content += '<form action="/item/" method="post">';
						div_content += '<input type="hidden"  name="item_code" value="item code">';
						div_content += '<input type="submit" value="More Info" style="height: 33px; background-image: url(/image/boton_moreinfo_on_134x36.png); background-size: 100% 100%; width: 100px; border-width: 0px; background-color: transparent;">';
						div_content += '</form>';	
						div_content += '</div>';
						div_content += '</div>';
						div_content += '</div>';
						div_content += '</div>';
					}
				   }
				   
				   $( "#search_result_container" ).html(div_content);
            }
    });
}

<?php 
if(isset($_GET['s']))
{
?>
 $(document).ready(function()
 {
	var search_value = '<?php echo $_GET['s']; ?>';
    search_items(search_value);
 });
 <?php 
}
?>
</script>
<?php
//include header template
require('layout/footer.php');
?>