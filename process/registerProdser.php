<?php 

$nombreProdSer = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$prodser = $_POST['prodser'];
$idEmp = $_POST['idEmp'];


include 'serverConfig.php';
include 'consultSQL.php';

//validar que existe un id por lo tanto existe una sesion existente
if ($idEmp != "") {
	//Validar imagen por vacio, extension y peso
	if($_FILES['img']['name'] != ""){
		$arrayExt = ['jpg', 'png', 'gif', 'jpeg', 'webp'];

		$imgSize = $_FILES['img']['size'];
		$info = new SplFileInfo($_FILES['img']['name']);
		$extension =  $info->getExtension();

		if (in_array($extension, $arrayExt)) {
			$rand = rand(10, 100);
			$output = '../assets/imgProdSer/'.$_FILES['img']['name'].$rand.'.webp';
			$img = $_FILES['img']['tmp_name'];
			$image = imagecreatefromstring(file_get_contents($img));
			ob_start();
			imagejpeg($image, null, 100);
			$cont = ob_get_contents();
			ob_end_clean();
			imagedestroy($image);
			$content = imagecreatefromstring($cont);
			imagewebp($content, $output);
			imagedestroy($content);
		}else{
			return 'El archivo que seleccionó no es valido, use archivos .jpeg/.jpg/.gif/.png/.webp';
		}
	}else{
		$img = "";
	}



	//Validar otros campos, precio puede ser vacío
	if ($nombreProdSer != "" && $descripcion != "" && $prodser != "") {
		//Aquí irá filtrado por "where empresa = X"
		$verificar = ejecutarSQL::consultar("select * from productos_servicios where empresa ='".$idEmp." and nombre = '".$nombreProdSer."'");
		if (empty($verificar)) {
			if ($precio == "") {
				$consulta = consultasSQL::InsertSQL("productos_servicios", "nombre, descripcion, tipo, img, idEmpresa", "'$nombreProdSer', '$descripcion', '$prodser', '$output', '$idEmp'");
			}else{
				$consulta = consultasSQL::InsertSQL("productos_servicios", "nombre, descripcion, precio, tipo, img, idEmpresa", "'$nombreProdSer', '$descripcion', '$precio', '$prodser', '$output', '$idEmp'");
			}

			if ($consulta) {
				echo "Registro correcto";
			}else{
				echo "Error en registro";
			}
		}else{
			echo "Ya exite un producto registrado con ese nombre";
		}
	}
}else{
	echo "Necesitas estár registrado para poder insertar un producto";
}

?>