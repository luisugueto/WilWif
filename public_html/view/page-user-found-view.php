<?php
require('layout/header.php');

$code = $_GET['code'];
$type = $_GET['type'];
$query = "SELECT * FROM item WHERE code = '".$code."'";
$sql = mysql_query($query);
$assoc = mysql_fetch_assoc($sql);

if(isset($_POST['guardar']))
{
	$name = $_POST['name'];
	$description = $_POST['description'];
	$title = $_POST['title'];
	$address = $_POST['address'];
	$category = $_POST['category'];
	$foundlost = $_POST['foundlost'];
	$country = $_POST['country'];
	$city = $_POST['city'];
	$query = "UPDATE item SET name = '".$name."', description = '".$description."', title = '".$title."', country = '".$country."', city = '".$city."', findlost_address = '".$address."', type = '".$foundlost."', id_category = '".$category."', last_mod_date = NOW() WHERE code = '".$code."'";
	$edit = mysql_query($query);
	$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'It has changed an item.', NOW())";
	$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	$type = 'v';
}


if (isset($_POST['delete'])) {
	$query = "UPDATE item SET status = 'Deleted', last_mod_date = NOW() WHERE code = '".$code."'";
	$edit = mysql_query($query);
	$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'It has removed an item.', NOW())";
	$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	header('Location: /account/found');
}
if (isset($_POST['edit'])) {
	$type = 'e';
}

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
	
	
	

	<div><?php
         $defaultCatID = $assoc['id_category'];
         echo $defaultCatID;
         ?></div>
	<div class="row">

	    <div class="table-responsive">
				<h2>Item</h2>
				<hr>
				<?php if($type == 'v'){ ?>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Code</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['code']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Name</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['name']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Description</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['description']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Title</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['title']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Type</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['type']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Country</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['country']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">City</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['city']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Create date</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['create_date']; ?>" type="label" name="item_code" id="item_code" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<form action="" method="POST">
								<input type="hidden" name="code" id="code" value="<?php echo $code; ?>">
								<input onclick="return confirm('¿Edit Item?')" class="btn btn-primary" type="submit" name="edit" id="edit" value="Edit">
								<input onclick="return confirm('¿Delete Item?')" class="btn btn-danger" type="submit" name="delete" id="delete" value="Delete">
					</form>
				</div>
				<?php } ?>
				<br>
				<?php if($type == 'e'){ ?>
			<form action="" method="post">
				<div class="row"> 
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Code</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['code']; ?>" type="label" class="form-control input-lg" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Name</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['name']; ?>" type="label" name="name" id="name" class="form-control input-lg">
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Description</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['description']; ?>" type="label" name="description" id="description" class="form-control input-lg">
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Title</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['title']; ?>" type="label" name="title" id="title" class="form-control input-lg">
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
							<input type="text" name="address" id="address" class="form-control input-lg" placeholder="Fruisof-402, Postal Code 35745" value="<?php echo $assoc['findlost_address'] ?>" required tabindex="4">
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
							<select class="form-control input-lg" name="category" id="category">	
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
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="foundlost" class="form-control input-lg">You Lost/Found the Item</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<select class="form-control input-lg" name="foundlost" id="foundlost">
								<option value=""></option>
								<option value="Found">Found</option>
								<option value="Lost">Lost</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="item_country" class="form-control input-lg">Country</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<select class="form-control input-lg" name="country" id="country">
								<option value="">Select a Country</option>
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
								<option value="VE">Venezuela</option>
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
							<input type="text" name="city" id="city" class="form-control input-lg" placeholder="Caracas" value="<?php echo $assoc['city']; ?>" required tabindex="4">
						</div>
					</div>
				</div>
				<div class="row">
							<input onclick="return confirm('¿Edit Item?')" class="btn btn-primary" type="submit" name="guardar" id="guardar" value="Edit">
				</div>
			</form>	
				<?php } ?>
		</div>
	</div>
</div>
</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>