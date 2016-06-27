<?php

//if not logged in redirect to login page
#if(!$user->is_logged_in()){ header('Location: login.php'); } 

$category_sql = "SELECT * FROM item_category";
$category = mysql_query($category_sql);


if(isset($_POST['submit'])){
	$categoria = $_POST['categoria'];
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$title = $_POST['title'];
	$direccion = $_POST['direccion'];
	$codigo = date('d-m-Y')."/".mt_rand(1, 3000)."-".mt_rand(1,3000);

	$query = "INSERT INTO item (id_category, code, name, description, title, findlost_address, create_date, last_mod_date, id_user) VALUES ('".$categoria."', '".$codigo."','".$nombre."', '".$descripcion."', '".$title."', '".$direccion."', '".date('d-m-Y H:i')."', '".date('d-m-Y H:i')."', '".$_SESSION['id']."')";
	$execute = mysql_query($query) or die(mysql_error());
	echo "<script>
			alert('Objeto Registrado Exitosamente.');
		</script>";
		$mensaje[] = "Registro Exitoso";
	header('./');
}


//define page title
$title = 'Inicio';

//include header template
require('layout/header.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Nuevo Objeto Perdido</h2>
				<?php

				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($mensaje)){
					foreach($mensaje as $mensaje){
						echo "<h2 class='bg-success'>".$mensaje."</h2>";
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {

					}

				}

				
				?>
				<div class="form-group">
					<select class="form-control" required name="categoria" id="categoria">
						<option value="" disabled="" selected="">Seleccione una categoría</option>
						<?php
						$category_assoc = mysql_fetch_assoc($category);
						do{
							echo "<option value='".$category_assoc['id']."'>$category_assoc[name]</option>"; 
						}while($category_assoc = mysql_fetch_assoc($category));
						?>
					</select>
				</div>
				<div class="form-group">
					<input required type="text" name="nombre" id="nombre" class="form-control input-lg" placeholder="Nombre" value="<?php if(isset($error)){ echo $_POST['nombre']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input required type="text" name="descripcion" id="descripcion" class="form-control input-lg" placeholder="Descripcion" value="<?php if(isset($error)){ echo $_POST['descripcion']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input required type="text" name="title" id="title" class="form-control input-lg" placeholder="Titulo" value="<?php if(isset($error)){ echo $_POST['title']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<select class="form-control" name="status" id="status">
						<option value="" disabled="" selected="">Seleccione una estatus</option>
					</select>
				</div>
				<div class="form-group">
					<input required type="text" name="direccion" id="direccion" class="form-control input-lg" placeholder="Dirección de perdida" value="<?php if(isset($error)){ echo $_POST['direccion']; } ?>" tabindex="1">
				</div>				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Guardar" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>


</div>

<?php 
//include header template
require('layout/footer.php'); 
?>
