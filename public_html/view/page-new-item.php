<?php 
/*	
$item_name =   	$_POST['item_name'];
$item_title =	$_POST['item_title'];
$item_description =	$_POST['item_description'];
$item_contry =	$_POST['item_contry'];
$item_city =	$_POST['item_city'];
$item_address =	$_POST['item_address'];
$item_category =	$_POST['item_category'];
$foundlost =	$_POST['foundlost'];*/
$error = array();
$error['error'] = false;
/*Verificar todos los datos*/
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
		$error['item_title'] = 'Field Required';
	}

	if(isset($_POST['item_description']) && !empty($_POST['item_description']))
	{
		$item_description =   $_POST['item_description'];
	}else
	{
		
	}

	if(isset($_POST['item_contry']) && !empty($_POST['item_contry']))
	{
		$item_contry =   $_POST['item_contry'];
	}else
	{
		$error['error'] = true;
		$error['item_contry'] = 'Field Required';
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
	$item_user = $_SESSION['id'];

	$item_code = date("Y").'-'.date('m').date('d').'-';
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0; $i < 8; $i++) 
	{
		$item_code = $item_code.$characters[rand(0, strlen($characters))];
		if($i == 3)
		{
			$item_code = $item_code.'-';
		}
	}

	/*Guardamos el item en la base de datos*/
	$sql =  'INSERT INTO item (';
	$sql =  $sql. 'code' ;
	$sql =  $sql. ',name' ;
	$sql =  $sql. ',description' ;
	$sql =  $sql. ',title' ;
	$sql =  $sql. ',status' ;
	$sql =  $sql. ',findlost_address' ;
	$sql =  $sql. ',type' ;
	$sql =  $sql. ',id_category' ;
	$sql =  $sql. ',id_user' ;
	$sql =  $sql. ')' ;
	$sql =  $sql. ' VALUES (' ;
	$sql =  $sql. ' "'.$item_code.'"' ;
	$sql =  $sql. ',"'.$item_name.'"' ;
	$sql =  $sql. ',"'.$item_description.'"' ;
	$sql =  $sql. ',"'.$item_title.'"' ;
	$sql =  $sql. ',"Active"' ;
	$sql =  $sql. ',"'.$item_address.'"' ;
	$sql =  $sql. ',"'.$foundlost.'"' ;
	$sql =  $sql. ','.$item_category.'' ;
	$sql =  $sql. ','.$item_user.'' ;
	$sql =  $sql. ')' ;

	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());;

	$item_id = mysql_insert_id();
	for ($i = 0; $i < count($imgs_path); $i++) 
	{
		$sql =  'INSERT INTO item_photo (';
		$sql =  $sql. 'path' ;
		$sql =  $sql. ',id_item' ;
		$sql =  $sql. ')' ;
		$sql =  $sql. ' VALUES (' ;
		$sql =  $sql. '"'.$imgs_path[$i].'"' ;
		$sql =  $sql. ','.$item_id.'' ;
		$sql =  $sql. ')' ;
		$query = mysql_query($sql)or die('error at try to access data' . mysql_error());;
	}

}

?>
<?php 

//include header template
require('layout/header.php'); 
?>
<div id="container" style="padding-bottom: 20px;">
	<form role="form" method="post" action="" autocomplete="off">
		
		<div class="images_holder">
			
		</div>
		
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_name" class="form-control input-lg">Item Name</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="item_name" id="item_name" class="form-control input-lg" placeholder="Passport Marcos Gonzales" value="<?php if($error['error']){ echo $_POST['item_name']; } ?>" required tabindex="1">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_title" class="form-control input-lg">Title</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="item_title" id="item_title" class="form-control input-lg" placeholder="Marcos Passport" value="<?php if($error['error']){ echo $_POST['item_title']; } ?>" required tabindex="2">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_description" class="form-control input-lg">Description</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="item_description" id="item_description" class="form-control input-lg" placeholder="is a new passport from Germany" value="<?php if($error['error']){ echo $_POST['item_description']; } ?>" tabindex="3">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_contry" class="form-control input-lg">Country</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<select class="form-control input-lg" name="item_contry">
								<option value="">Select a Contry</option>
								<option value="AF">Afghanistan</option>
								<option value="AX">Åland Islands</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AS">American Samoa</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua and Barbuda</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AU">Australia</option>
								<option value="AT">Austria</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
								<option value="BY">Belarus</option>
								<option value="BE">Belgium</option>
								<option value="BZ">Belize</option>
								<option value="BJ">Benin</option>
								<option value="BM">Bermuda</option>
								<option value="BT">Bhutan</option>
								<option value="BO">Bolivia, Plurinational State of</option>
								<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
								<option value="BA">Bosnia and Herzegovina</option>
								<option value="BW">Botswana</option>
								<option value="BV">Bouvet Island</option>
								<option value="BR">Brazil</option>
								<option value="IO">British Indian Ocean Territory</option>
								<option value="BN">Brunei Darussalam</option>
								<option value="BG">Bulgaria</option>
								<option value="BF">Burkina Faso</option>
								<option value="BI">Burundi</option>
								<option value="KH">Cambodia</option>
								<option value="CM">Cameroon</option>
								<option value="CA">Canada</option>
								<option value="CV">Cape Verde</option>
								<option value="KY">Cayman Islands</option>
								<option value="CF">Central African Republic</option>
								<option value="TD">Chad</option>
								<option value="CL">Chile</option>
								<option value="CN">China</option>
								<option value="CX">Christmas Island</option>
								<option value="CC">Cocos (Keeling) Islands</option>
								<option value="CO">Colombia</option>
								<option value="KM">Comoros</option>
								<option value="CG">Congo</option>
								<option value="CD">Congo, the Democratic Republic of the</option>
								<option value="CK">Cook Islands</option>
								<option value="CR">Costa Rica</option>
								<option value="CI">Côte d'Ivoire</option>
								<option value="HR">Croatia</option>
								<option value="CU">Cuba</option>
								<option value="CW">Curaçao</option>
								<option value="CY">Cyprus</option>
								<option value="CZ">Czech Republic</option>
								<option value="DK">Denmark</option>
								<option value="DJ">Djibouti</option>
								<option value="DM">Dominica</option>
								<option value="DO">Dominican Republic</option>
								<option value="EC">Ecuador</option>
								<option value="EG">Egypt</option>
								<option value="SV">El Salvador</option>
								<option value="GQ">Equatorial Guinea</option>
								<option value="ER">Eritrea</option>
								<option value="EE">Estonia</option>
								<option value="ET">Ethiopia</option>
								<option value="FK">Falkland Islands (Malvinas)</option>
								<option value="FO">Faroe Islands</option>
								<option value="FJ">Fiji</option>
								<option value="FI">Finland</option>
								<option value="FR">France</option>
								<option value="GF">French Guiana</option>
								<option value="PF">French Polynesia</option>
								<option value="TF">French Southern Territories</option>
								<option value="GA">Gabon</option>
								<option value="GM">Gambia</option>
								<option value="GE">Georgia</option>
								<option value="DE">Germany</option>
								<option value="GH">Ghana</option>
								<option value="GI">Gibraltar</option>
								<option value="GR">Greece</option>
								<option value="GL">Greenland</option>
								<option value="GD">Grenada</option>
								<option value="GP">Guadeloupe</option>
								<option value="GU">Guam</option>
								<option value="GT">Guatemala</option>
								<option value="GG">Guernsey</option>
								<option value="GN">Guinea</option>
								<option value="GW">Guinea-Bissau</option>
								<option value="GY">Guyana</option>
								<option value="HT">Haiti</option>
								<option value="HM">Heard Island and McDonald Islands</option>
								<option value="VA">Holy See (Vatican City State)</option>
								<option value="HN">Honduras</option>
								<option value="HK">Hong Kong</option>
								<option value="HU">Hungary</option>
								<option value="IS">Iceland</option>
								<option value="IN">India</option>
								<option value="ID">Indonesia</option>
								<option value="IR">Iran, Islamic Republic of</option>
								<option value="IQ">Iraq</option>
								<option value="IE">Ireland</option>
								<option value="IM">Isle of Man</option>
								<option value="IL">Israel</option>
								<option value="IT">Italy</option>
								<option value="JM">Jamaica</option>
								<option value="JP">Japan</option>
								<option value="JE">Jersey</option>
								<option value="JO">Jordan</option>
								<option value="KZ">Kazakhstan</option>
								<option value="KE">Kenya</option>
								<option value="KI">Kiribati</option>
								<option value="KP">Korea, Democratic People's Republic of</option>
								<option value="KR">Korea, Republic of</option>
								<option value="KW">Kuwait</option>
								<option value="KG">Kyrgyzstan</option>
								<option value="LA">Lao People's Democratic Republic</option>
								<option value="LV">Latvia</option>
								<option value="LB">Lebanon</option>
								<option value="LS">Lesotho</option>
								<option value="LR">Liberia</option>
								<option value="LY">Libya</option>
								<option value="LI">Liechtenstein</option>
								<option value="LT">Lithuania</option>
								<option value="LU">Luxembourg</option>
								<option value="MO">Macao</option>
								<option value="MK">Macedonia, the former Yugoslav Republic of</option>
								<option value="MG">Madagascar</option>
								<option value="MW">Malawi</option>
								<option value="MY">Malaysia</option>
								<option value="MV">Maldives</option>
								<option value="ML">Mali</option>
								<option value="MT">Malta</option>
								<option value="MH">Marshall Islands</option>
								<option value="MQ">Martinique</option>
								<option value="MR">Mauritania</option>
								<option value="MU">Mauritius</option>
								<option value="YT">Mayotte</option>
								<option value="MX">Mexico</option>
								<option value="FM">Micronesia, Federated States of</option>
								<option value="MD">Moldova, Republic of</option>
								<option value="MC">Monaco</option>
								<option value="MN">Mongolia</option>
								<option value="ME">Montenegro</option>
								<option value="MS">Montserrat</option>
								<option value="MA">Morocco</option>
								<option value="MZ">Mozambique</option>
								<option value="MM">Myanmar</option>
								<option value="NA">Namibia</option>
								<option value="NR">Nauru</option>
								<option value="NP">Nepal</option>
								<option value="NL">Netherlands</option>
								<option value="NC">New Caledonia</option>
								<option value="NZ">New Zealand</option>
								<option value="NI">Nicaragua</option>
								<option value="NE">Niger</option>
								<option value="NG">Nigeria</option>
								<option value="NU">Niue</option>
								<option value="NF">Norfolk Island</option>
								<option value="MP">Northern Mariana Islands</option>
								<option value="NO">Norway</option>
								<option value="OM">Oman</option>
								<option value="PK">Pakistan</option>
								<option value="PW">Palau</option>
								<option value="PS">Palestinian Territory, Occupied</option>
								<option value="PA">Panama</option>
								<option value="PG">Papua New Guinea</option>
								<option value="PY">Paraguay</option>
								<option value="PE">Peru</option>
								<option value="PH">Philippines</option>
								<option value="PN">Pitcairn</option>
								<option value="PL">Poland</option>
								<option value="PT">Portugal</option>
								<option value="PR">Puerto Rico</option>
								<option value="QA">Qatar</option>
								<option value="RE">Réunion</option>
								<option value="RO">Romania</option>
								<option value="RU">Russian Federation</option>
								<option value="RW">Rwanda</option>
								<option value="BL">Saint Barthélemy</option>
								<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="KN">Saint Kitts and Nevis</option>
								<option value="LC">Saint Lucia</option>
								<option value="MF">Saint Martin (French part)</option>
								<option value="PM">Saint Pierre and Miquelon</option>
								<option value="VC">Saint Vincent and the Grenadines</option>
								<option value="WS">Samoa</option>
								<option value="SM">San Marino</option>
								<option value="ST">Sao Tome and Principe</option>
								<option value="SA">Saudi Arabia</option>
								<option value="SN">Senegal</option>
								<option value="RS">Serbia</option>
								<option value="SC">Seychelles</option>
								<option value="SL">Sierra Leone</option>
								<option value="SG">Singapore</option>
								<option value="SX">Sint Maarten (Dutch part)</option>
								<option value="SK">Slovakia</option>
								<option value="SI">Slovenia</option>
								<option value="SB">Solomon Islands</option>
								<option value="SO">Somalia</option>
								<option value="ZA">South Africa</option>
								<option value="GS">South Georgia and the South Sandwich Islands</option>
								<option value="SS">South Sudan</option>
								<option value="ES">Spain</option>
								<option value="LK">Sri Lanka</option>
								<option value="SD">Sudan</option>
								<option value="SR">Suriname</option>
								<option value="SJ">Svalbard and Jan Mayen</option>
								<option value="SZ">Swaziland</option>
								<option value="SE">Sweden</option>
								<option value="CH">Switzerland</option>
								<option value="SY">Syrian Arab Republic</option>
								<option value="TW">Taiwan, Province of China</option>
								<option value="TJ">Tajikistan</option>
								<option value="TZ">Tanzania, United Republic of</option>
								<option value="TH">Thailand</option>
								<option value="TL">Timor-Leste</option>
								<option value="TG">Togo</option>
								<option value="TK">Tokelau</option>
								<option value="TO">Tonga</option>
								<option value="TT">Trinidad and Tobago</option>
								<option value="TN">Tunisia</option>
								<option value="TR">Turkey</option>
								<option value="TM">Turkmenistan</option>
								<option value="TC">Turks and Caicos Islands</option>
								<option value="TV">Tuvalu</option>
								<option value="UG">Uganda</option>
								<option value="UA">Ukraine</option>
								<option value="AE">United Arab Emirates</option>
								<option value="GB">United Kingdom</option>
								<option value="US">United States</option>
								<option value="UM">United States Minor Outlying Islands</option>
								<option value="UY">Uruguay</option>
								<option value="UZ">Uzbekistan</option>
								<option value="VU">Vanuatu</option>
								<option value="VE">Venezuela, Bolivarian Republic of</option>
								<option value="VN">Viet Nam</option>
								<option value="VG">Virgin Islands, British</option>
								<option value="VI">Virgin Islands, U.S.</option>
								<option value="WF">Wallis and Futuna</option>
								<option value="EH">Western Sahara</option>
								<option value="YE">Yemen</option>
								<option value="ZM">Zambia</option>
								<option value="ZW">Zimbabwe</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_city" class="form-control input-lg">City</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="item_city" id="item_city" class="form-control input-lg" placeholder="Caracas" value="<?php if($error['error']){ echo $_POST['item_city']; } ?>" required tabindex="4">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_address" class="form-control input-lg">Address</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="text" name="item_address" id="item_address" class="form-control input-lg" placeholder="Fruisof-402, Postal Code 35745" value="<?php if($error['error']){ echo $_POST['item_address']; } ?>" required tabindex="4">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_category" class="form-control input-lg">Category</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<select class="form-control input-lg" name="item_category">	
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
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="foundlost" class="form-control input-lg">You Lost/Found the Item</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<select class="form-control input-lg" name="foundlost">
								<option value="Found">Found</option>
								<option value="Found">Lost</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6">
						
					</div>
					<div class="col-xs-6 col-md-6">
						<input type="submit" name="submit_create" value="Add" class="btn btn-primary btn-block btn-lg" required tabindex="6">
					</div>
				</div>	
</form>
</div>
<script>
 $(document).ready(function()
 {
	
    function previewImgs()
	{
		var list = document.getElementById('lista-imagenes');
		var pre_photos = ["/images/foto 1 wilwif.png", "/images/foto 2 wilwif.png", "/images/foto 3 wilwif.png"];
		var imgcontw = pre_photos.length*125;
		if(imgcontw <= 0)
		{
			imgcontw = 0;
		}
		$(".upload_container_inner").width(imgcontw);
		for (var i = 0; i < pre_photos.length; i++) {
			var path_url = pre_photos[i];
			
			var eliminar  = document.createElement('div'); 
			eliminar.innerHTML = "X";	
			eliminar.className = "uploader_eliminar";
			eliminar.addEventListener('click', function(e) { 
			this.parentNode.parentNode.removeChild(this.parentNode);
			//row_img.parentNode.removeChild(row_img);
					var lis = document.getElementById('lista-imagenes').getElementsByTagName("li");
					var imgcontw= lis.length*125;
					if(imgcontw <= 0)
					{
						imgcontw = 0;
					}
					$(".upload_container_inner").width(imgcontw);
			}, false);
			var	row_img = document.createElement('li');	
			var upload_img  = document.createElement('div'); 
			
			upload_img.style.background = "url('"+ path_url +"')";
			upload_img.style.backgroundSize = "100px 100px";
			upload_img.className = "uploader_clasethumb";
			row_img.appendChild(upload_img);
			row_img.appendChild(eliminar);	
			list.appendChild(row_img);
			// add url value 
			var input_url = document.createElement('input'); 
			input_url.type = "hidden";
			input_url.id = "url_img[]";
			input_url.name = "url_img[]";
			input_url.value = "'"+ path_url +"'";
			row_img.appendChild(input_url);
		}
			
	}
	previewImgs();
 });
</script>
<?php
//include header template
require('layout/footer.php');
?>