
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	include 'inc/link.php';
	include 'inc/navbar.php';
  	include 'process/serverConfig.php';
  	include 'process/consultSQL.php';

	//Id de la empresa solicitada
	$idEmp = $_GET['idEmp'];
	$empresa = ejecutarSQL::consultar("select * from empresa where idEmpresa=$idEmp");
 	?>
</head>
<body>
	<div class="container-fluid">
		<div class="jumbotron">
			<center>
				<img src='<?php echo $empresa[0][12]; ?>' class="img-fluid">
			</center>
		</div>
		<div class="card">
			<div class="card-header text-uppercase">
				<center>
					<h1><?php echo $empresa[0][1]; ?></h1>
				</center>
			</div>
			<div class="card-body">
				<center>
					<h3>CONTACTO</h3>
					<p>Ciudad: <?php echo $empresa[0][6]; ?></p>
					<p>Email: <?php echo $empresa[0][9]; ?></p>
					<p>Telefono: <?php echo $empresa[0][10]; ?></p>
					<p>Dirección: <?php echo $empresa[0][11]; ?></p>
				</center>
				
			</div>
		</div>
		<div class="row" style="margin-bottom: 65px;">
			<?php 
				$productos = ejecutarSQL::consultar("select * from productos_servicios where idEmpresa=$idEmp");
				for ($i=0; $i < count($productos); $i++) { 
				  echo '
				  <div class="col-sm-6">
				    <div class="card" >
				      <div class="card-body">
				        <img class="card-img-top img-fluid" src="'.$productos[$i][5].'" alt="Card image cap" style="width: 18rem;">
				        <h5 class="card-title text-uppercase"></h5>
				        <p class="card-text">'.$productos[$i][2].'</p>';
				        if ($productos[$i][3] != null) {
				        	echo '<p class="card-text">'.$productos[$i][3].' MXN</p>';
				        }
				       echo '
				      </div>
				    </div>
				  </div>
				  ';
				}
			?>
		</div>
	</div>
</body>
</html>