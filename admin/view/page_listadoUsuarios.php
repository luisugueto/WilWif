<?php

require('layout/header.php');
?>

<div class="container">

	<div class="row">

	    <div class="table-responsive">
				<h2>Usuarios</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th>Nombre</th>
						<th>Nombre de Usuario</th>
						<th>Correo</th>
						<th>Opciones</th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM user";
						$sql = mysql_query($query);
						$sql_assoc = mysql_fetch_assoc($sql);
						do{
					?>
				<tbody>
					<tr>
						<td><?php echo $sql_assoc['name']; ?></td>
						<td><?php echo $sql_assoc['username']; ?></td>
						<td><?php echo $sql_assoc['email']; ?></td>
						<td><?php echo "<a href='/modificarUsuario/?id=$sql_assoc[id]'>Bloquear</a>
										<a href='/modificarUsuario/?id=$sql_assoc[id]'>Articulos</a>
										<a href='/modificarUsuario/?id=$sql_assoc[id]'>Historia</a>"; ?></td>
						
					<?php	 
						}while($sql_assoc = mysql_fetch_assoc($sql));
					?>
					</tr>
					</tbody>
				</table>


		</div>
	</div>

</div>

<?php
//include header template
require('layout/footer.php');
?>