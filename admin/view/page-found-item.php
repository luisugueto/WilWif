<?php 

//include header template
require('layout/header.php'); 
$url_public = "http://wilwif.local:86";
if($user->is_logged_in() ){
	//$code = $_POST['code'];
	if (isset($_POST['submit'])) {
	 	$query_send = "UPDATE item SET status = 'Deleted' WHERE id = $code";
	 	$send = mysql_query($query_send);
	 	if($_POST['tipo']=='s')
	 	{
	 		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Send Item.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	 	}
	 	elseif($_POST['tipo']=='r')
	 	{
	 		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Receive Item.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	 	}
	}

	if(isset($_POST['send']))
	{

	}

}


?>
<?php 
if(isset($_GET['item_code']))
{
	$item = new item($_GET['item_code']);
/*
	echo $item->item_code;
	echo '<br>';
	echo $item->item_name;
	echo '<br>';
	echo $item->item_description;
	echo '<br>';
	echo $item->item_address;
	echo '<br>';
	echo $item->item_title;
	echo '<br>';
	echo $item->item_type;
	echo '<br>';
	echo $item->item_user;
	echo '<br>';
	echo $item->item_photos_url[0];
	echo '<br>';
	echo $item->item_category_slug;
*/
	
}
?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="background-image: url('/image/barra-items-534-78-01.png'); background-repeat: no-repeat; width: 540px; height: 82px; display: inline-block; margin-left: -425px; margin-top: 15px;">
		<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;margin-left: 83px;">ITEM FOUND</h1>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">

<div style="height: 150px; background-color: lightblue;">
	<div style="height: 100px;">
		<div style="float: left;">
			<div class="slider-container" style="width: 150px; height: 150px;">
			  <div class="slider-images-container">
			    <?php 
					for($i = 0; $i < count($item->item_photos_url); $i++)
					{
				?>
					<div <?php if($i==0){ echo 'style="display: inline-block;"';} ?> >
						<img width="150" height="150" src="<?php echo $url_public.$item->item_photos_url[$i]; ?>"/>
					</div>
				
				<?php 
					}
				?>
				
				 
			  </div>
			  <button class="slider-next">></button>
			  <button class="slider-prev">&lt;</button>	
			</div>
		
		</div>
		<div style="float: left;">
			<div style="height: 30px;"> <?php echo $item->item_title; ?> </div>
			<div style="height: 40px;"> <?php echo $item->item_description; ?> </div>
			<div>
				<div>
				  Found By <?php echo $item->item_user; ?>
				</div>
				<div>
				  Category : <?php echo $item->item_category_slug; ?>
				</div>
				<?php
if($user->is_logged_in() ){ 
		if($item->item_type == 'Found' && $item->item_status == 'Active'){
		?>
			<form action="/orderItem/" method="POST">
				<input type="hidden" name="code" id="code" value="<?php echo $item->item_id; ?>">
				<input type="hidden" name="tipo" id="tipo" value="s">
				<input onclick="return confirm('¿Send Item?')" class="btn btn-primary" type="submit" name="submit" id="submit" value="Send">
			</form>
		<?php
		}
		elseif ($item->item_type == 'Lost' && $item->item_status == 'Active') {
		?>
			<form action="/receiveItem/" method="POST">
				<input type="hidden" name="code" id="code" value="<?php echo $item->item_id; ?>">
				<input type="hidden" name="tipo" id="tipo" value="r">
				<input onclick="return confirm('¿Receive Item?')" class="btn btn-primary" type="submit" name="submit" id="submit" value="Request">
			</form>
		<?php
		}
	}
?>
			
	</div>
	
</div>
</div>
</div>
<script>
var currentIndex = 0,
  items = $('.slider-images-container div'),
  itemAmt = items.length;

function cycleItems() {
  var item = $('.slider-images-container div').eq(currentIndex);
  items.hide();
  item.css('display','inline-block');
}
/*
var autoSlide = setInterval(function() {
  currentIndex += 1;
  if (currentIndex > itemAmt - 1) {
    currentIndex = 0;
  }
  cycleItems();
}, 3000);
*/
$('.slider-next').click(function() {
  //clearInterval(autoSlide);
  currentIndex += 1;
  if (currentIndex > itemAmt - 1) {
    currentIndex = 0;
  }
  cycleItems();
});

$('.slider-prev').click(function() {
 // clearInterval(autoSlide);
  currentIndex -= 1;
  if (currentIndex < 0) {
    currentIndex = itemAmt - 1;
  }
  cycleItems();
});
</script>
<style>
.slider-images-container {
  max-width: 400px;
  background-color: black;
  margin: 0 auto;
  text-align: center;
  position: relative;
  width: 150px;
  height: 150px;
}
.slider-images-container div {
  background-color: white;
  width: 100%;
  display: inline-block;
  display: none;
}
.slider-images-container img {
  width: 100%;
  height: auto;
}

button {
  position: relative;
  z-index: 1;
  background-color: transparent;
  border-width: 0px;
  color: orange;
  font-size: 30px;
  bottom: 90px;
}

.slider-next {
  left: 80px;
}

.slider-prev {
  left: -80px;
}
</style>


<?php 
//include header template
require('layout/footer.php');
?>