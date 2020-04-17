<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 
  include 'inc/link.php';
   ?>
  
</head>
<body>

<?php 
  include 'inc/navbar.php';
  include 'process/serverConfig.php';
  include 'process/consultSQL.php';
 ?>

<div class="jumbotron text-center" style="margin-bottom:0">
  <div class="">
    <h2>Busca empresas, productos o servicios</h2>
  </div>
  <br>
  <div class="mx-auto">
    <input class="form-control" type="text" placeholder="Buscar"
    aria-label="Buscar">
    <i class="fas fa-search" aria-hidden="true"></i>
    <br>
    <button class="btn btn-primary btn-lg">Buscar</button>
  </div>
  <hr style="border: 1px solid;">
</div>

<div class="container-fluid text-center" style="margin-bottom:80px;">
  <div class="row">
  
<?php 

$empresas = ejecutarSQL::consultar("select * from empresa");
for ($i=0; $i < count($empresas); $i++) { 
  echo '
  <div class="col-sm-6">
    <div class="card" >
      <div class="card-body">
        <h5 class="card-title text-uppercase pTitulos">'.$empresas[$i][1].'</h5>
        <img class="card-img-top img-fluid" src="'.$empresas[$i][12].'" alt="Card image cap" style="width: 18rem;">
        <p class="card-text">'.$empresas[$i][2].'</p>
        <a href="detalleEmpresa.php?idEmp='.$empresas[$i][0].'" class="btn btn-primary">Ver empresa</a>
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
