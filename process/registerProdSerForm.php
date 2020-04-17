<?php 
$_SESSION['empresa'] = 1;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.0.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#reg-prod-ser').submit(function(event){
				event.preventDefault();
				$.ajax({
					type: 'POST',
					url: $(this).attr('action'),
					data: $(this).serialize(),
					beforeSend: function(){
						$('#res-prod-ser').html('Insertando...');
					},
					success: function(data){
						$('#res-prod-ser').html(data);
					},
					error: function(){
						$('#res-prod-ser').html('Error en la inserción');
					}
				});
				return false;
			});
		});
	</script>


	<form id="reg-prod-ser" action="register.php" method="post">
		<div class="form-group">
			<label>Nombre del producto/servicio</label>
			<input type="text" name="nombre">
		</div>
		<div class="form-group">
			<label>Descripción</label>
			<textarea name="descripcion"></textarea>
		</div>
		<div class="form-group">
			<label>Precio $MXN</label>
			<input type="text" name="precio">
		</div>

		<div class="form-check">
			<input class="form-check-input" type="radio" name="prodser" value="1" checked>
		  	<label class="form-check-label">
		    	Producto
		  	</label>
		</div>
		<div class="form-check">
		  	<input class="form-check-input" type="radio" name="prodser" value="2">
		  	<label class="form-check-label">
		    	Servicio
		  	</label>
		</div>
		<div class="form-group">
	        <label>Imagen de producto/servicio</label>
	        <input type="file" name="img" accept=".jpg,.png" required>
	        <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
      	</div>
      	<div class="form-group">
      		<input type="hidden" name="idEmp" value="<?php echo $_SESSION['empresa'] ?>">
      	</div>
		<div class="form-group">
			<button type="sumbit" class="btn btn-outline-dark">Registrarme</button>
		</div>
		<div id="res-prod-ser">
			
		</div>
		
	</form>
</body>
</html>