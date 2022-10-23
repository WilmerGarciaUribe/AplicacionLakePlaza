<?php
	include("sesion.php");
	include("db.php");
	$ocultar = 'hidden';

	// Geters para recuperar datos a actualizar

	if (isset($_GET['id_user'])) {
		$id = $_GET['id_user'];
		$query = "Select * from usuarios where id_user = $id";
		$resultado = $conn->prepare($query);
		$cuantos=$resultado->execute();
		if ($cuantos == 1) {
			$row = $resultado->fetch(PDO::FETCH_ASSOC);
			$codUser = $row['cod_user'];
			$usuario = $row['usuario'];
			$email = $row['email_user'];
		}
	}
		
	if (isset($_GET['id_prod'])) {
		$id = $_GET['id_prod'];
		$query = "Select * from productos where id_prod = $id";
		$resultado = $conn->prepare($query);
		$cuantos=$resultado->execute();
		if ($cuantos == 1) {
			$row = $resultado->fetch(PDO::FETCH_ASSOC);
			$codProd = $row['cod_prod'];
			$nombre = $row['nombre'];
			$estado = $row['estado'];
		}
	}

	if (isset($_POST['update_prod'])) {
		$id = $_GET['id_prod'];
		$nombre = $_POST['nombre'];
		$estado = $_POST['estado'];
		$query = "Update productos set nombre='$nombre', estado='$estado' where id_prod='$id' ";
		$resultado = $conn->prepare($query);
		$cuantos=$resultado->execute();

		if ($cuantos<1) {
			die("Accion de editar fallida! ".$cuantos);
		}
		$_SESSION['message'] = "Registro actualizado correctamente.";
		$_SESSION['message_type'] = 'success';
		header('location:registro_datos_maestros.php?maestro=producto');
		//echo "<script>window.location.replace('http://localhost/AplicacionLakePlaza/index.php')</script>";
	}

?>

<?php include("includes/header.php") ?>

<div class="container p-4 usuario" <?php 	if (!isset($_GET['id_user'])) { echo $ocultar ; } ?> >
	<div class="row">
		<div class="col-md-4 mx-auto">
			<div class="card border-success mb-3" style="max-width: 18rem;">
			<div class="card-header bg-transparent text-primary border-success text-center">EDITAR USUARIO</div>
				<div class="card card-body">
					<form action="editar.php?id_user=<?php echo $_GET['id_user'];?>" method="POST">
						<div class="form-outline mb-3 col-10">
							<label for="usuario" class="form-label">Usuario:</label>
							<input type="text" name="usuario" value="<?php echo $usuario ;?>" class="form-control" placeholder="Actualiza usuario" autofocus>
						</div>
						<div class="form-outline mb-3 col-10">
							<label for="email_user" class="form-label">Correo:</label>
							<input type="email" name="email_user" class="form-control" value="<?php echo $email; ?>" placeholder="Actualiza el correo">
						</div>
						<div class="form-outline mb-3 col-10">
							<label for="clave_usuario" class="form-label">Contraseña:</label>
							<input type="password" name="clave_usuario" value="<?php echo $password ;?>" class="form-control" placeholder="Nueva clave" >
						</div>
						<div class="card-footer bg-transparent border-success text-center">
							<button type="submit" class="btn btn-success" name="update">Actualizar</button>
			  		</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container p-4 producto " <?php if (!isset($_GET['id_prod'])) { echo $ocultar ; } ?>  >
	<div class="row">
		<div class="col-md-4 mx-auto">
			<div class="card border-success mb-3" style="max-width: 18rem;">
			  <div class="card-header bg-transparent text-primary border-success text-center">EDITAR PRODUCTO</div>
		  	<div class="card-body text-success">
					<form action="editar.php?id_prod=<?php echo $_GET['id_prod'];?>" method="POST">
						<div class="form-outline mb-3 col-10">
							<label for="nombre" class="form-label">Nombre del Producto:</label>
							<input type="text" name="nombre" value="<?php echo $nombre ;?>" class="form-control" placeholder="Actualiza producto" autofocus>
						</div>
						<div class="form-outline mb-3 col-md-5 ">
					    <label for="estado_producto" class="form-label">Estado</label>
					    <select class="form-select" id="estado" name="estado" >
					    	<?php if ($estado == 1) { ?>
										<option selected value="1">Activo</option>
										<option value="0">Inactivo</option>
						    <?php }else{ ?>
										<option  value="1">Activo</option>
										<option selected value="0">Inactivo</option>					    	
								<?php } ?>
					    </select>
						</div>							
			  		<div class="card-footer bg-transparent border-success text-center">
							<button type="submit" class="btn btn-success" name="update_prod">Actualizar</button>
			  		</div>
	  			</form>
	  		</div>
			</div>
		</div>
	</div>
</div>