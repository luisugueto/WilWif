<?php 
require('layout/header.php'); 
$error = array();
$error['error'] = false;
$method="";
if(!$user->is_logged_in() ){
	header('Location: /register/');
}
if (isset($_POST['submit_create'])) 
{
	if(isset($_POST['item_name']) && !empty($_POST['item_name']))
	{
		$item_name =   	$_POST['item_name'];
	}else
	{
		$error['error'] = true;
		$error['item_name'] = 'Field Required';
	}

	if(isset($_POST['item_title']) && !empty($_POST['item_title']))
	{
		$item_title =   $_POST['item_title'];
	}else
	{
		$error['error'] = true;
		$error['item_title'] = 'title Required';
	}

	if(isset($_POST['item_description']) && !empty($_POST['item_description']))
	{
		$item_description =   $_POST['item_description'];
	}else
	{
		$error['error'] = true;
		$error['item_decription'] = 'description Required';
	}

	if(isset($_POST['item_country']) && !empty($_POST['item_country']))
	{
		$item_country =   $_POST['item_country'];
	}else
	{
		$error['error'] = true;
		$error['item_country'] = 'contry Required';
	}

	if(isset($_POST['item_city']) && !empty($_POST['item_city']))
	{
		$item_city =   $_POST['item_city'];
	}else
	{
		$error['error'] = true;
		$error['item_city'] = 'Field Required';
	}

	if(isset($_POST['item_address']) && !empty($_POST['item_address']))
	{
		$item_address =   $_POST['item_address'];
	}else
	{
		
		//$error['item_address'] = 'Field Required';
	}

	if(isset($_POST['item_category']) && !empty($_POST['item_category']))
	{
		$item_category =   $_POST['item_category'];
	}else
	{
		$error['error'] = true;
		$error['item_category'] = 'Field Required';
	}

	if(isset($_POST['foundlost']) && !empty($_POST['foundlost']))
	{
		$foundlost =   $_POST['foundlost'];
	}else
	{
		$error['error'] = true;
		$error['foundlost'] = 'Field Required';
	}
	
	if(isset($_POST['foundlost']) && !empty($_POST['foundlost']))
	{
		$item_type =   $_POST['foundlost'];
	}else
	{
		$error['error'] = true;
		$error['foundlost'] = 'Field Required';
	}
	
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
	if(!$error['error'])
	{
		$item = CreateItem($item_name, $item_title, $item_description, $item_country,$item_city, $item_address, $item_category, $item_type , $imgs_path,$item_brand,$item_color,$item_number,$item_model);
		if (is_a($item, 'errorCodes')) {
			$errors = $item->GetErrors();
			echo "<p>type Error</p>";
			foreach($errors as $error)
			{
				echo "<p>type Error".$error."</p>";
			}
			
		}
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
	
	}
}else if(isset($_POST['submit_modify'])){
	$method = 'modify';
	
	if(isset($_POST['item_code']) && !empty($_POST['item_code']))
	{
		$item_code =   	$_POST['item_code'];
	}else
	{
		$error['error'] = true;
		$error['message'] = 'Field Code Required';
	}
	
	if(isset($_POST['item_name']) && !empty($_POST['item_name']))
	{
		$item_name =   	$_POST['item_name'];
	}else
	{
		$error['error'] = true;
		$error['message'] = 'Field Name Required';
	}

	if(isset($_POST['item_title']) && !empty($_POST['item_title']))
	{
		$item_title =   $_POST['item_title'];
	}else
	{
		$error['error'] = true;
		$error['message'] = 'Field Title Required';
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
		$error['error'] = true;
		$error['message'] = 'Field Country Required';
	}

	if(isset($_POST['item_city']) && !empty($_POST['item_city']))
	{
		$item_city =   $_POST['item_city'];
	}else
	{
		$error['error'] = true;
		$error['message'] = 'Field City Required';
	}

	if(isset($_POST['item_address']) && !empty($_POST['item_address']))
	{
		$item_address =   $_POST['item_address'];
	}else
	{
		
		//$error['item_address'] = 'Field Required';
	}

	if(isset($_POST['item_category']) && !empty($_POST['item_category']))
	{
		$item_category =   $_POST['item_category'];
	}else
	{
		$error['error'] = true;
		$error['message'] = 'Field Category Required';
	}

	if(isset($_POST['foundlost']) && !empty($_POST['foundlost']))
	{
		$item_type =   $_POST['foundlost'];
	}else
	{
		$error['error'] = true;
		$error['message'] = 'Field Type Required';
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
	$item_color = (isset($_POST['item_color'])) ?  $_POST['item_color']: '';
	$item_brand = (isset($_POST['item_brand'])) ?  $_POST['item_brand']: '';
	$item_number = (isset($_POST['item_number'])) ?  $_POST['item_number']: '';
	$item_model = (isset($_POST['item_model'])) ?  $_POST['item_model']: '';
	if(!$error['error'])
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
			
		}
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
	}else
	{
		echo "<p>Error".$error['message']."</p>";
	}

}else if(isset($_POST['submit_delete'])){

	if(isset($_POST['item_code']) && !empty($_POST['item_code']))
	{
			$item_code =   	$_POST['item_code'];
	}else
	{
		$error['error'] = true;
		$error['item_code'] = 'Field Required';
	}
	
	if(!$error['error'])
	{
		if (DeleteItem($item_code)) {
			header('Location: /account/lost-items/');
		}
	}
}else if(isset($_GET['code'])){

$item = new item($_GET['code']);
if(!$item->item_id)
{
	header('Location: /account/lost-items/');
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

$item_color =  $item->item_color;
$item_brand = $item->item_brand;
$item_number = $item->item_number;
$item_model = $item->item_model;
}

?>
<script src="/js/uploader.js"></script>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left; padding-left: 221px;">
		<div style="background-image: url('/image/barra-account-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;">Lost Item</h1>
		</div>
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	
	
	<form role="form" method="post" action="" autocomplete="off">
		
		<div class="images_holder">
			
		</div>
				<?php 
					if($method=='modify')
					{
					?>
						<div class="row">	
							<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png'); display: inline-block;">
								<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
									<label class="form-control input-lg">Item Code</label>
								</div>
								<div class="form-group" style="float: left; height: 50px; width: 442px; ">
									<input type="label" name="item_code" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;"  id="item_code" class="form-control input-lg"  value="<?php if(isset($item_code)){ echo $item_code; } ?>" required tabindex="1" readonly>
								</div>
							</div>
						</div>
					<?php 
					}
					?>
					
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png'); display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_name" class="form-control input-lg">Item Name</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_name" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;" id="item_name" class="form-control input-lg"  value="<?php if(isset($item_name)){ echo $item_name; } ?>" required tabindex="1">
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_title" class="form-control input-lg">Title</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_title" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;"  id="item_title" class="form-control input-lg"  value="<?php if(isset($item_title)){ echo $item_title; } ?>" required tabindex="2">
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_brand" class="form-control input-lg">Brand</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_brand" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;"  id="item_brand" class="form-control input-lg"  value="<?php if(isset($item_brand)){ echo $item_brand; } ?>" >
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_color" class="form-control input-lg">Color</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_color" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;"  id="item_color" class="form-control input-lg"  value="<?php if(isset($item_color)){ echo $item_color; } ?>" >
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_model" class="form-control input-lg">Model</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_model" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;"  id="item_model" class="form-control input-lg"  value="<?php if(isset($item_model)){ echo $item_model; } ?>" >
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_number" class="form-control input-lg">Number</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_number" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;"  id="item_number" class="form-control input-lg"  value="<?php if(isset($item_number)){ echo $item_number; } ?>" >
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png'); display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_country" class="form-control input-lg">Country</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; overflow: hidden;">
							<select class="form-control input-lg" name="item_country" id="item_country" style="padding: 0px; background-color: transparent; height: 50px; width: 460px; border-width: 0px; text-align: center;">
										<option value="">Select a Country</option>
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
				</div>
				
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png'); display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_city" class="form-control input-lg">City</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_city" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;" id="item_city" class="form-control input-lg" placeholder="Caracas" value="<?php if(isset($item_city)){ echo $item_city; } ?>" required tabindex="4">
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_address" class="form-control input-lg">Address</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; ">
							<input type="text" name="item_address" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;" id="item_address" class="form-control input-lg" placeholder="Fruisof-402, Postal Code 35745" value="<?php if(isset($item_address)){ echo $item_address; } ?>" required tabindex="5">
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="item_category" class="form-control input-lg">Category</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px;overflow: hidden;">
							<select class="form-control input-lg" name="item_category" id="item_category" style="padding: 0px; background-color: transparent; height: 50px; width: 460px; border-width: 0px; text-align: center;">	
								<option value=""></option>
									<?php
									$sql = "select slug,id from item_category";
									$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
									while($row = mysql_fetch_assoc($query))
									{
										echo "<option value=".$row['id'].">".$row['slug']."</option>"; 
													
									}
								?>
								
							</select>
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 50px; background-image: url('/image/barra-register-405-26.png');  display: inline-block;">
						<div class="form-group" style="float: left; height: 50px; width: 137px; padding-top: 15px;">
							<label for="foundlost" class="form-control input-lg">Lost/Found?</label>
						</div>
						<div class="form-group" style="float: left; height: 50px; width: 442px; overflow: hidden;">
							<div class="form-group" style="float: left; height: 50px; width: 442px; ">
								<input type="text" name="foundlost" style="padding-top: 0px; padding-left: 20px; border-width: 0px; width: 440px; padding-right: 20px; height: 50px; background-color: transparent; text-align: center;" id="item_address" class="form-control input-lg" placeholder="Fruisof-402, Postal Code 35745" value="<?php if(isset($item_type)){echo $item_type;}else echo "Lost"; ?>" required tabindex="5" readonly>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div style="width: 580px; background-size: 100% 100%; height: 130px; background-image: url('/image/barra-reset-718-62.png'); display: inline-block; padding: 15px;">
						<textarea rows="4" cols="50" maxlength="200"  style="resize: none; border-width: 0px; margin-top: 0px; background-color: transparent; height: 100px; width: 550px;" class="form-control input-lg" style="resize:none" name="item_description" id="item_description" placeholder="Description: is a new passport from Germany"><?php if(isset($item_description)){ echo $item_description; } ?></textarea> 
					</div>
				</div>
				
				
				
				<div class="row">
					<div style="float: left; margin-right: 20px;">
					<?php echo "<a href='/account/lost-items/'>";?>
						<img width="50" height="50" src="/image/boton-volver-50-50.png" style="cursor: pointer;">
						<p style="width: 62px;margin-bottom: 0px;">Return</p>
					</a>
					</div>
					<?php 
					if(!$method=='modify')
					{
					?>
						<div class="col-xs-6 col-md-6">
						
						</div>
						<div class="col-xs-6 col-md-6">
						<input type="submit" name="submit_create" value="Add" class="btn btn-primary btn-block btn-lg" required tabindex="6">
						</div>
					<?php 
					}
					else{
					?>
						<div class="col-xs-6 col-md-6">
						<input type="submit" name="submit_delete" value="Delete" class="btn btn-primary btn-block btn-lg" required tabindex="6">
						</div>
						<div class="col-xs-6 col-md-6">
						<input type="submit" name="submit_modify" value="Edit" class="btn btn-primary btn-block btn-lg" required tabindex="6">
						</div>
					<?php
					}
					?>
				</div>	
</form>
</div>

	</div>
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
		//$('#foundlost').val('<?php if(isset($item_type)){echo $item_type;} ?>');
		$('#item_category').val('<?php if(isset($item_category)){echo $item_category;} ?>');
		$('#item_country').val('<?php if(isset($item_country)){echo $item_country;} ?>');
 });
	
	
</script>
<?php
//include header template
require('layout/footer.php');
?>