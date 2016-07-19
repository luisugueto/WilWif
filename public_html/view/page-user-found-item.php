<?php 
require('layout/header.php'); 

$method="";
if(!$user->is_logged_in() ){
	header('Location: /');
}
if (isset($_POST['submit_create'])) 
{
	if(isset($_POST['item_title']) && !empty($_POST['item_title']))
	{
		$item_title =   $_POST['item_title'];
	}else
	{
		
		$error = 'Title Required';
	}

	if(isset($_POST['item_description']) && !empty($_POST['item_description']))
	{
		$item_description =   $_POST['item_description'];
	}else
	{
		
		$error = 'Description Required';
	}

	if(isset($_POST['item_country']) && !empty($_POST['item_country']))
	{
		$item_country =   $_POST['item_country'];
	}else
	{
		
		$error = 'contry Required';
	}

	if(isset($_POST['item_city']) && !empty($_POST['item_city']))
	{
		$item_city =   $_POST['item_city'];
	}else
	{
		
		$error = 'City Field Required';
	}

	

	if(isset($_POST['item_category']) && !empty($_POST['item_category']))
	{
		$item_category =   $_POST['item_category'];
	}else
	{
		
		$error = 'Category Field Required';
	}

	

	$item_type =  (isset($_POST['foundlost'])) ?  $_POST['foundlost']: '';
	$item_address = (isset($_POST['item_address'])) ?  $_POST['item_address']: '';
	$item_name = (isset($_POST['item_name'])) ?  $_POST['item_name']: '';
	
	$item_category_slug = (isset($_POST['item_category_slug'])) ?  $_POST['item_category_slug']: '';
	$item_color = (isset($_POST['item_color'])) ?  $_POST['item_color']: '';
	$item_brand = (isset($_POST['item_brand'])) ?  $_POST['item_brand']: '';
	$item_number = (isset($_POST['item_number'])) ?  $_POST['item_number']: '';
	$item_model = (isset($_POST['item_model'])) ?  $_POST['item_model']: '';
	/*Terminar de verificar todos los datos*/
	/*Cargamos el id del usuario y las imagenes y generamos el cod del item*/
	$imgs_path = array();
	for($i = 0 ; $i< 5 ;$i++)
	{
		if(isset($_POST['url_img'][$i]))
		{	
			array_push($imgs_path, $_POST['url_img'][$i]);	
		}
	}
	if(!isset($error))
	{
		$item = CreateItem($item_name, $item_title, $item_description, $item_country,$item_city, $item_address, $item_category, $item_type , $imgs_path,$item_brand,$item_color,$item_number,$item_model);
		if (is_a($item, 'errorCodes')) {
			$errors = $item->GetErrors();
			echo "<p>type Error</p>";
			foreach($errors as $error)
			{
				echo "<p>type Error".$error."</p>";
			}
			
		}else{
		$method="modify";
		$item_code = $item->item_code;
		$item_name = $item->item_name;
		$item_description = $item->item_description;
		$item_title = $item->item_title;
		$item_address = $item->item_address;
		$item_type = $item->item_type;
		$item_category = $item->item_category_id;
		$imgs_path =  $item->item_photos_url;
		$item_country = $item->item_country;
		$item_city = $item->item_city;
		$item_category_slug = $item->item_category_slug;
		}
	}
}else if(isset($_POST['submit_modify'])){
	$method = 'modify';
	
	if(isset($_POST['item_code']) && !empty($_POST['item_code']))
	{
		$item_code =   	$_POST['item_code'];
	}else
	{
		$error = 'Field Code Required';
	}
	
	

	if(isset($_POST['item_title']) && !empty($_POST['item_title']))
	{
		$item_title =   $_POST['item_title'];
	}else
	{
		
		$error ='Field Title Required';
	}

	if(isset($_POST['item_description']) && !empty($_POST['item_description']))
	{
		$item_description =   $_POST['item_description'];
	}else
	{
		
	}

	if(isset($_POST['item_country']) && !empty($_POST['item_country']))
	{
		$item_country =   $_POST['item_country'];
	}else
	{
		$error ='Field Country Required';
	}

	if(isset($_POST['item_city']) && !empty($_POST['item_city']))
	{
		$item_city =   $_POST['item_city'];
	}else
	{
		
		$error = 'Field City Required';
	}

	
	if(isset($_POST['item_category']) && !empty($_POST['item_category']))
	{
		$item_category =   $_POST['item_category'];
	}else
	{
		$error = 'Field Category Required';
	}

	
	/*Terminar de verificar todos los datos*/
	/*Cargamos el id del usuario y las imagenes y generamos el cod del item*/
	
	$imgs_path = array();
	for($i = 0 ; $i< 5 ;$i++)
	{
		if(isset($_POST['url_img'][$i]))
		{	
			array_push($imgs_path, $_POST['url_img'][$i]);	
		}
	}
	
	$item_address = (isset($_POST['item_address'])) ?  $_POST['item_address']: '';
	$item_name = (isset($_POST['item_name'])) ?  $_POST['item_name']: '';
	
	$item_type =  (isset($_POST['foundlost'])) ?  $_POST['foundlost']: '';
	$item_color = (isset($_POST['item_color'])) ?  $_POST['item_color']: '';
	$item_brand = (isset($_POST['item_brand'])) ?  $_POST['item_brand']: '';
	$item_number = (isset($_POST['item_number'])) ?  $_POST['item_number']: '';
	$item_model = (isset($_POST['item_model'])) ?  $_POST['item_model']: '';
	if(!isset($error))
	{		
		$item = ModifyItem($item_code,$item_name, $item_title, $item_description, $item_country,
		$item_city, $item_address, $item_category, $item_type , $imgs_path,$item_brand,$item_color,$item_number,$item_model);
		if (is_a($item, 'errorCodes')) {
			$errors = $item->GetErrors();
			echo "<p>type Error</p>";
			foreach($errors as $error)
			{
				echo "<p>type Error".$error."</p>";
			}
			
		}else{
		$item_code = $item->item_code;
		$item_name = $item->item_name;
		$item_description = $item->item_description;
		$item_title = $item->item_title;
		$item_address = $item->item_address;
		$item_type = $item->item_type;
		$item_category = $item->item_category_id;
		$imgs_path =  $item->item_photos_url;
		$item_country = $item->item_country;
		$item_city = $item->item_city;
		$item_category_slug = $item->item_category_slug;
		}
	}else
	{
		echo "<p>Error".$error."</p>";
	}

}else if(isset($_POST['submit_lost'])){

	
	if(isset($_POST['item_code']) && !empty($_POST['item_code']))
	{
		
			$item_code =   	$_POST['item_code'];
	}else
	{
		$error = 'Field Required';
	}
	
	if(!isset($error))
	{
		echo 'Pase';
		if (LostItem($item_code)) {
			header('Location: /account/found-items/');
		}
	}
}else if(isset($_GET['code'])){

$item = new item($_GET['code']);
if(!$item->item_id)
{
	header('Location: /account/found-items/');
}
$method = 'modify';
$item_code = $item->item_code;
$item_name = $item->item_name;
$item_description = $item->item_description;
$item_title = $item->item_title;
$item_address = $item->item_address;
$item_type = $item->item_type;
$item_category = $item->item_category_id;
$imgs_path =  $item->item_photos_url;
$item_country = $item->item_country;
$item_city = $item->item_city;
$item_category_slug = $item->item_category_slug;
$item_color =  $item->item_color;
$item_brand = $item->item_brand;
$item_number = $item->item_number;
$item_model = $item->item_model;
}else if(isset($_GET['item_category'])){
	$item_category_slug = $_GET['item_category'];
	$query = 'select id from item_category where slug="'.$item_category_slug.'"';
	$sql = mysql_query($query);
	if($row = mysql_fetch_assoc($sql))
	{
		$item_category = $row['id'];
	}else{
		header('Location: /account/found-items/');
	}
	
	
}else{
	header('Location: /account/found-items/');
}

?>
<script src="/js/uploader.js"></script>
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">
	<div class="row">	
	<div class="col-xs-3 col-md-2" >
	<?php 
					if(isset($_GET['item_category']))
					{
						echo "<a href='/account/found-category/'>";
					}else{
						echo "<a href='/account/found-items/'>";
					}
					?>
	<p>back</p></a>
	</div>
	
	<div class="col-xs-6 col-md-8" >
		<p></p>
	</div>
					
	<div class="col-xs-3 col-md-2" >
	
	</div>
	</div>
</div>
<div class="row"  style="border-color:gray; color:blue;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;">
	<div class="col-xs-4 col-md-4" >
		
	</div>
	<div class="col-xs-4 col-md-4" >
		<p>Keep it Safe</p>
	</div>
	
</div>
<div class="container">	

	<?php
	if(isset($error))
	{
		echo '<p>'.$error.'</p>';
	}

	?>
	
	
	<form role="form" method="post" action="" autocomplete="off">
				<div class="row">
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
					<!--
						<div class="images_holder">
			
						</div>		
					-->
					
					<?php 
						if($item_category_slug == 'Phone')
						{
							
							echo '<img class="img_category_phone" src="/image/mobile-1-59-x-97.png"  width="59" height="97" >';
							
						}else if($item_category_slug == 'Key')
						{
							
							echo '<img class="img_category_key" src="/image/key-1-97-x-97.png"  width="97" height="97" >';
							
						}else if($item_category_slug == 'Case')
						{
							
							echo '<img  class="img_category_suitecase" src="/image/maleta-1-98-x-83.png"  width="98" height="83" >';
							
						}else if($item_category_slug == 'Tablet')
						{
							
							echo '<img class="img_category_tablet" src="/image/tablet-1-73-x-96.png"  width="73" height="96" >';
							
						}else if($item_category_slug == 'Backpack')
						{
							
							echo '<img class="img_category_backpack" src="/image/bulto-1-95-x-97.png"  width="95" height="97" >';
							
						}else if($item_category_slug == 'Luggage')
						{
							
							echo '<img class="img_category_luggage" src="/image/maleta-rueda-1-55-x-97.png" width="55" height="97" >';
							
						}else if($item_category_slug == 'Laptop')
						{
							
							echo '<img class="img_category_laptop" src="/image/laptop-1-97-x-67.png"  width="97" height="67" >';
							
						}else if($item_category_slug == 'Camera')
						{
							
							echo '<img class="img_category_camera" src="/image/camara-1-98-x-70.png"  width="98" height="70" >';
							
						}else if($item_category_slug == 'Passport')
						{
							
							echo '<img class="img_category_pass" src="/image/pass-68-x-94.png"  width="68" height="94" >';
							
						}else if($item_category_slug == 'Driver License')
						{
							
							echo '<img class="img_category_identitycard" src="/image/ID-1-98-x-66.png"  width="98" height="66" >';
							
						}else if($item_category_slug == 'Credit / Debit Card')
						{
							
							echo '<img class="img_category_creditcard" src="/image/credit-1-card-98-x-66.png"  width="98" height="66" >';
							
						}else if($item_category_slug == 'Other')
						{
							
							echo '<img class="img_category_other" src="/image/crus-93-x-93.png"  width="93" height="93" >';
							
						}
					
					
					?>
					<p style="color:blue;"><?php if(isset($item_category_slug)){ echo $item_category_slug; } ?></p>
					<input class="label_text_input" type="hidden" name="item_category_slug"  id="item_category_slug"   value="<?php if(isset($item_category_slug)){ echo $item_category_slug; } ?>"  readonly>
					
					<input class="label_text_input" type="hidden" name="item_category"  id="item_address"   value="<?php if(isset($item_category)){ echo $item_category; } ?>"  readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
						<input class="label_text_input" type="text" name="item_title" placeholder="Title"   id="item_title"  value="<?php if(isset($item_title)){ echo $item_title; } ?>" required tabindex="1">
					</div>	
				</div>
				
					
				
		
				<?php 
					if($method=='modify')
					{
					?>
						<div class="row">	
							<div class="col-xs-0 col-md-3" >
							</div>
							<div class="col-xs-12 col-md-6" >
								<input class="label_text_input" type="label" name="item_code"   id="item_code" class="form-control input-lg"  value="<?php if(isset($item_code)){ echo $item_code; } ?>" required  readonly>
							</div>
						</div>
					<?php 
					}
					?>
					
				
				<div class="row">
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
						<input type="text"class="label_text_input"  name="item_description" placeholder="Description"  id="item_description"  value="<?php if(isset($item_description)){echo $item_description;} ?>" required tabindex="3">
					</div>
				</div>
				
				
				<div class="row">	
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
						<input type="text" class="label_text_input" name="item_brand" placeholder="Brand"  id="item_brand"  value="<?php if(isset($item_brand)){ echo $item_brand; } ?>"  tabindex="4">
					</div>
				</div>
				
				
				
				<div class="row">
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
						<input type="text" class="label_text_input" name="item_color" placeholder="Color"   id="item_color"   value="<?php if(isset($item_color)){ echo $item_color; } ?>" tabindex="5">
					</div>
				</div>
				
				<div class="row">	
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12  	col-md-6" >
						<input type="text" class="label_text_input" name="item_model"  placeholder="Model"   id="item_model"   value="<?php if(isset($item_model)){ echo $item_model; } ?>"  tabindex="6">
					</div>
				</div>
				
				<div class="row">	
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
						<input type="text" class="label_text_input" name="item_number" placeholder="Number"   id="item_number"   value="<?php if(isset($item_number)){ echo $item_number; } ?>" tabindex="7" >
					</div>
				</div>
				
					
				<div class="row">
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
						<select class="label_text_input" name="item_country" id="item_country" tabindex="8">
										<option value="<?php if(isset($item_country)){echo $item_country;}?>" selected="selected"><?php if(isset($item_country)){echo $item_country;}else echo 'Country';?></option>
										<option value="United States">United States</option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Åland Islands">Åland Islands</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="American Samoa">American Samoa</option>
										<option value="Andorra">Andorra</option>
										<option value="Angola">Angola</option>
										<option value="Anguilla">Anguilla</option>
										<option value="Antarctica">Antarctica</option>
										<option value="Antigua and Barbuda">Antigua and Barbuda</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Aruba">Aruba</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>
										<option value="Barbados">Barbados</option>
										<option value="Belarus">Belarus</option>
										<option value="Belgium">Belgium</option>
										<option value="Belize">Belize</option>
										<option value="Benin">Benin</option>
										<option value="Bermuda">Bermuda</option>
										<option value="Bhutan">Bhutan</option>
										<option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
										<option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
										<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
										<option value="Botswana">Botswana</option>
										<option value="Bouvet Island">Bouvet Island</option>
										<option value="Brazil">Brazil</option>
										<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
										<option value="Brunei Darussalam">Brunei Darussalam</option>
										<option value="Bulgaria">Bulgaria</option>
										<option value="Burkina Faso">Burkina Faso</option>
										<option value="Burundi">Burundi</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Cameroon">Cameroon</option>
										<option value="Canada">Canada</option>
										<option value="Cape Verde">Cape Verde</option>
										<option value="Cayman Islands">Cayman Islands</option>
										<option value="Central African Republic">Central African Republic</option>
										<option value="Chad">Chad</option>
										<option value="Chile">Chile</option>
										<option value="China">China</option>
										<option value="Christmas Island">Christmas Island</option>
										<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
										<option value="Colombia">Colombia</option>
										<option value="Comoros">Comoros</option>
										<option value="Congo">Congo</option>
										<option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
										<option value="Cook Islands">Cook Islands</option>
										<option value="Costa Rica">Costa Rica</option>
										<option value="Côte d'Ivoire">Côte d'Ivoire</option>
										<option value="Croatia">Croatia</option>
										<option value="Cuba">Cuba</option>
										<option value="Curaçao">Curaçao</option>
										<option value="Cyprus">Cyprus</option>
										<option value="Czech Republic">Czech Republic</option>
										<option value="Denmark">Denmark</option>
										<option value="Djibouti">Djibouti</option>
										<option value="Dominica">Dominica</option>
										<option value="Dominican Republic">Dominican Republic</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Egypt">Egypt</option>
										<option value="El Salvador">El Salvador</option>
										<option value="Equatorial Guinea">Equatorial Guinea</option>
										<option value="Eritrea">Eritrea</option>
										<option value="Estonia">Estonia</option>
										<option value="Ethiopia">Ethiopia</option>
										<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
										<option value="Faroe Islands">Faroe Islands</option>
										<option value="Fiji">Fiji</option>
										<option value="Finland">Finland</option>
										<option value="France">France</option>
										<option value="French Guiana">French Guiana</option>
										<option value="French Polynesia">French Polynesia</option>
										<option value="French Southern Territories">French Southern Territories</option>
										<option value="Gabon">Gabon</option>
										<option value="Gambia">Gambia</option>
										<option value="Georgia">Georgia</option>
										<option value="Germany">Germany</option>
										<option value="Ghana">Ghana</option>
										<option value="Gibraltar">Gibraltar</option>
										<option value="Greece">Greece</option>
										<option value="Greenland">Greenland</option>
										<option value="Grenada">Grenada</option>
										<option value="Guadeloupe">Guadeloupe</option>
										<option value="Guam">Guam</option>
										<option value="Guatemala">Guatemala</option>
										<option value="Guernsey">Guernsey</option>
										<option value="Guinea">Guinea</option>
										<option value="Guinea">Guinea-Bissau</option>
										<option value="Guyana">Guyana</option>
										<option value="Haiti">Haiti</option>
										<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
										<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
										<option value="Honduras">Honduras</option>
										<option value="Hong Kong">Hong Kong</option>
										<option value="Hungary">Hungary</option>
										<option value="Iceland">Iceland</option>
										<option value="India">India</option>
										<option value="Indonesia">Indonesia</option>
										<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
										<option value="Iraq">Iraq</option>
										<option value="Ireland">Ireland</option>
										<option value="Isle of Man">Isle of Man</option>
										<option value="Israel">Israel</option>
										<option value="Italy">Italy</option>
										<option value="Jamaica">Jamaica</option>
										<option value="Japan">Japan</option>
										<option value="Jersey">Jersey</option>
										<option value="Jordan">Jordan</option>
										<option value="Kazakhstan">Kazakhstan</option>
										<option value="Kenya">Kenya</option>
										<option value="Kiribati">Kiribati</option>
										<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
										<option value="Korea, Republic of">Korea, Republic of</option>
										<option value="Kuwait">Kuwait</option>
										<option value="Kyrgyzstan">Kyrgyzstan</option>
										<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
										<option value="Latvia">Latvia</option>
										<option value="Lebanon">Lebanon</option>
										<option value="Lesotho">Lesotho</option>
										<option value="Liberia">Liberia</option>
										<option value="Libya">Libya</option>
										<option value="Liechtenstein">Liechtenstein</option>
										<option value="Lithuania">Lithuania</option>
										<option value="Luxembourg">Luxembourg</option>
										<option value="Macao">Macao</option>
										<option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
										<option value="Madagascar">Madagascar</option>
										<option value="Malawi">Malawi</option>
										<option value="Malaysia">Malaysia</option>
										<option value="Maldives">Maldives</option>
										<option value="Mali">Mali</option>
										<option value="Malta">Malta</option>
										<option value="Marshall Islands">Marshall Islands</option>
										<option value="Martinique">Martinique</option>
										<option value="Mauritania">Mauritania</option>
										<option value="Mauritius">Mauritius</option>
										<option value="Mayotte">Mayotte</option>
										<option value="Mexico">Mexico</option>
										<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
										<option value="Moldova, Republic of">Moldova, Republic of</option>
										<option value="Monaco">Monaco</option>
										<option value="Mongolia">Mongolia</option>
										<option value="Montenegro">Montenegro</option>
										<option value="Montserrat">Montserrat</option>
										<option value="Morocco">Morocco</option>
										<option value="Mozambique">Mozambique</option>
										<option value="Myanmar">Myanmar</option>
										<option value="Namibia">Namibia</option>
										<option value="Nauru">Nauru</option>
										<option value="Nepal">Nepal</option>
										<option value="Netherlands">Netherlands</option>
										<option value="New Caledonia">New Caledonia</option>
										<option value="New Zealand">New Zealand</option>
										<option value="Nicaragua">Nicaragua</option>
										<option value="Niger">Niger</option>
										<option value="Nigeria">Nigeria</option>
										<option value="Niue">Niue</option>
										<option value="Norfolk Island">Norfolk Island</option>
										<option value="Northern Mariana Islands">Northern Mariana Islands</option>
										<option value="Norway">Norway</option>
										<option value="Oman">Oman</option>
										<option value="Pakistan">Pakistan</option>
										<option value="Palau">Palau</option>
										<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
										<option value="Panama">Panama</option>
										<option value="Papua New Guinea">Papua New Guinea</option>
										<option value="Paraguay">Paraguay</option>
										<option value="Peru">Peru</option>
										<option value="Philippines">Philippines</option>
										<option value="Pitcairn">Pitcairn</option>
										<option value="Poland">Poland</option>
										<option value="Portugal">Portugal</option>
										<option value="Puerto Rico">Puerto Rico</option>
										<option value="Qatar">Qatar</option>
										<option value="Réunion">Réunion</option>
										<option value="Romania">Romania</option>
										<option value="Russian Federation">Russian Federation</option>
										<option value="Rwanda">Rwanda</option>
										<option value="Saint Barthélemy">Saint Barthélemy</option>
										<option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
										<option value="Saint Lucia">Saint Lucia</option>
										<option value="Saint Martin (French part)">Saint Martin (French part)</option>
										<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
										<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
										<option value="Samoa">Samoa</option>
										<option value="San Marino">San Marino</option>
										<option value="Sao Tome and Principe">Sao Tome and Principe</option>
										<option value="Saudi Arabia">Saudi Arabia</option>
										<option value="Senegal">Senegal</option>
										<option value="Serbia">Serbia</option>
										<option value="Seychelles">Seychelles</option>
										<option value="Sierra Leone">Sierra Leone</option>
										<option value="Singapore">Singapore</option>
										<option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
										<option value="Slovakia">Slovakia</option>
										<option value="Slovenia">Slovenia</option>
										<option value="Solomon Islands">Solomon Islands</option>
										<option value="Somalia">Somalia</option>
										<option value="South Africa">South Africa</option>
										<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
										<option value="South Sudan">South Sudan</option>
										<option value="Spain">Spain</option>
										<option value="Sri Lanka">Sri Lanka</option>
										<option value="Sudan">Sudan</option>
										<option value="Suriname">Suriname</option>
										<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
										<option value="Swaziland">Swaziland</option>
										<option value="Sweden">Sweden</option>
										<option value="Switzerland">Switzerland</option>
										<option value="Syrian Arab Republic">Syrian Arab Republic</option>
										<option value="Taiwan, Province of China">Taiwan, Province of China</option>
										<option value="Tajikistan">Tajikistan</option>
										<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
										<option value="Thailand">Thailand</option>
										<option value="Timor-Leste">Timor-Leste</option>
										<option value="Togo">Togo</option>
										<option value="Tokelau">Tokelau</option>
										<option value="Tonga">Tonga</option>
										<option value="Trinidad and Tobago">Trinidad and Tobago</option>
										<option value="Tunisia">Tunisia</option>
										<option value="Turkey">Turkey</option>
										<option value="Turkmenistan">Turkmenistan</option>
										<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
										<option value="Tuvalu">Tuvalu</option>
										<option value="Uganda">Uganda</option>
										<option value="Ukraine">Ukraine</option>
										<option value="United Arab Emirates">United Arab Emirates</option>
										<option value="United Kingdom">United Kingdom</option>
										<option value="United States">United States</option>
										<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
										<option value="Uruguay">Uruguay</option>
										<option value="Uzbekistan">Uzbekistan</option>
										<option value="Vanuatu">Vanuatu</option>
										<option value="Venezuela">Venezuela</option>
										<option value="Viet Nam">Viet Nam</option>
										<option value="Virgin Islands, British">Virgin Islands, British</option>
										<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
										<option value="Wallis and Futuna">Wallis and Futuna</option>
										<option value="Western Sahara">Western Sahara</option>
										<option value="Yemen">Yemen</option>
										<option value="Zambia">Zambia</option>
										<option value="Zimbabwe">Zimbabwe</option>
							</select>
					</div>
				</div>
				
				
				<div class="row" >	
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
						<input type="text" class="label_text_input"  name="item_city"  id="item_city" placeholder="City"  value="<?php if(isset($item_city)){ echo $item_city; } ?>" required tabindex="9">
					</div>
				</div>

				<div class="row" style="margin-bottom: 40px; margin-top: 10px; border-style: solid; border-color: gray; border-left: 0px solid gray; border-right: 0px solid gray;">	
					
					<div class="col-xs-12 col-md-12" >
						<a href="/insurace/"><p style="color: orange; margin-bottom: 3px; margin-top: 3px;">LOST AND STOLEN INSURACE?</p></a>
					</div>
				</div>
				
				<div class="row">	
					<div class="col-xs-3 col-md-3"  >
						
					</div>
					<div class="col-xs-2 col-md-2" >
					</div>
					<div class="col-xs-2 col-md-2">
						
					</div>
					<div class="col-xs-2 col-md-2" >
					<?php if($method=='modify')
						{
						?>
							<input type="submit" name="submit_lost" value="" style="width: 48px; height: 43px; background-image: url('/image/VIEW-&-EDIT-ITEMS-Lost-48-x-43.png'); background-size: 100% 100%; background-repeat: no-repeat; border-width: 0px;">
						<?php
						}
						?>
					</div>
					<div class="col-xs-2 col-md-3" >
					</div>
				</div>
				<div class="row div_input_principal"  style="color:blue; text-align: center; ">
					<div class="col-xs-12 col-md-12">
						<p class="fontsize_4 p_button" >
							<?php 
						if(!$method=='modify')
						{
						?>
							<input type="submit" value="Save" class="input_button" name="submit_create">
							<input type="submit" value="" class="botonera_button_principal"  name="submit_create">
							
						<?php 
						}
						else{
						?>
							<input type="submit" value="Edit" class="input_button"  name="submit_modify">
							
							<input type="submit" value="" class="botonera_button_principal"  name="submit_modify">
							
						<?php
						}
						?>
						
						
						
						</div>	
				</div>
</form>


</div>
<script>	

    var pre_photos = <?php
						if(isset($imgs_path))
						{
							$urls_photos='[';
							for ($i = 0; $i < count($imgs_path); $i++) 
							{
								if($i != 0)
								{
									$urls_photos= $urls_photos.",";
								}
								$urls_photos = $urls_photos.'"'.$imgs_path[$i].'"';
							}
							$urls_photos=$urls_photos.']';
							echo $urls_photos;
						}else echo "[]" 
						?>;
							
	
			 $(document).ready(function()
			 {	
				$('#item_country').val('<?php if(isset($item_country)){echo $item_country;} ?>');
			 });
	
		
</script>
<style>
.input_button{
	margin-bottom: 0px;
	background-color: transparent;
	border-width: 0px;
	padding-right: 0px;
	padding-left: 0px;
}
.label_text_input{
		width: 100%;
		height: 40px;
		border-width: 2px;
		padding-bottom: 1px;
		text-align:left;
		margin-bottom:5px;
		padding-left: 50px;
		border-style: solid;
		
	}
	
.div_input_principal{
	height: 110px;

}

.botonera_button_principal{
 margin-bottom:-50px;
background-image: url("/image/logo-add-111-x-171.png");
background-color: transparent;
background-size:100% 100%;
border-width: 0px;
width:83px;
height:129px;
position: absolute;
margin-left: -41px;
 margin-top: 30px;
left:50%;

}
	

	
	/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {

.botonera_button_principal{
	width:111px;
	height:176px;
	margin-top:70px;
	margin-top: 0px;
	bottom: -90px;
	left: 50%;
	margin-left: -50px;	
	padding-left: 0px;
	padding-right: 0px;
	margin-left: -55px;
	top: 25px;
 }
 
 .div_input_principal{
	height: 150px;

}


	
 }
</style>
<?php
//include header template
require('layout/footer.php');
?>