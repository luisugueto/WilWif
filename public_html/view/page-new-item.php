<?php 

/*code
category
name
description
title
status
findlost_address
type
photos*/
?>
<?php 

//include header template
require('layout/header.php'); 
?>
<div class="images_holder">

</div>
<div class="form-group">
	<input type="text" name="item_name" id="item_name" class="form-control input-lg" placeholder="Passport Marcos Gonzales" value="<?php if(isset($error)){ echo $_POST['item_name']; } ?>" required tabindex="1">
</div>
<div class="form-group">
	<input type="text" name="item_title" id="item_title" class="form-control input-lg" placeholder="Marcos Passport" value="<?php if(isset($error)){ echo $_POST['item_title']; } ?>" required tabindex="2">
</div>
<div class="form-group">
	<input type="text" name="item_description" id="item_description" class="form-control input-lg" placeholder="is a new passport from Germany" value="<?php if(isset($error)){ echo $_POST['item_description']; } ?>" required tabindex="3">
</div>
<div class="form-group">
	<input type="text" name="item_address" id="item_address" class="form-control input-lg" placeholder="Napole-Italia   Fruisof-402" value="<?php if(isset($error)){ echo $_POST['item_address']; } ?>" required tabindex="4">
</div>
<div class="form-group">
	<select class="form-control">
		<option value="Found">ID</option>
		<option value="Found">Passport</option>
	</select>
</div>
<div class="form-group">
	<select class="form-control">
		<option value="Found">Found</option>
		<option value="Found">Lost</option>
	</select>
</div>
<div class="form-group">
	<input type="text" name="item_type" id="item_type" class="form-control input-lg" placeholder="Lost/Found" value="<?php if(isset($error)){ echo $_POST['item_type']; } ?>" required tabindex="5">
</div>

<?php
//include header template
require('layout/footer.php');
?>