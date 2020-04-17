<?php 

$inputNombreEmpresa = $_POST['inputNombreEmpresa'];
$inputDescripcionEmpresa = $_POST['inputDescripcionEmpresa'];
$inputNombre = $_POST['inputNombre'];
$inputApellido = $_POST['inputApellido'];
$inputEmail = $_POST['inputEmail'];
$inputTelefono = $_POST['inputTelefono'];
$inputRfc = $_POST['inputRfc'];
$inputCiudad = $_POST['inputCiudad'];
$test = $_FILES['imagenEmp']['name'];

include 'serverConfig.php';
include 'consultSQL.php';

//valida existencia de imagen subida
if($_FILES['imagenEmp']['name'] != ""){
		$arrayExt = ['jpg', 'png', 'gif', 'jpeg', 'webp'];

		$imgSize = $_FILES['imagenEmp']['size'];
		echo $imgSize;
		$info = new SplFileInfo($_FILES['imagenEmp']['name']);
		$extension =  $info->getExtension();
		//valida extensión de imagen
		if (in_array($extension, $arrayExt)) {
				$rand = rand(10, 100);
				$output = '../assets/imgEmp/'.$_FILES['imagenEmp']['name'].$rand.'.webp';
				$img = $_FILES['imagenEmp']['tmp_name'];
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
			echo('El archivo que seleccionó no es valido, use archivos .jpeg/.jpg/.gif/.png/.webp');
		}
	}else{
		$img = "";
	}


if ($inputNombreEmpresa != "" && $inputDescripcionEmpresa != "" && $inputNombre != "" && $inputApellido != "" && $inputEmail != "" && $inputTelefono != "" && $inputRfc != "" && $inputCiudad != "") {
	$verificar = ejecutarSQL::consultar("select * from empresa where rfcEmpresa ='".$inputRfc."'");
	if (empty($verificar)) {
		if ($img != "") {
			$consulta = consultasSQL::InsertSQL("empresa", "nombreEmpresa, descripcion, nombreDuenio, apellidoDuenio, rfcEmpresa, ciudad, email, telefono, estatus, imgBanner", "'$inputNombreEmpresa','$inputDescripcionEmpresa', '$inputNombre', '$inputApellido', '$inputRfc', '$inputCiudad', '$inputEmail', '$inputTelefono', '0', '$output'");
		}else{
			$consulta = $consultaConImg = consultasSQL::InsertSQL("empresa", "nombreEmpresa, descripcion, nombreDuenio, apellidoDuenio, rfcEmpresa, ciudad, email, telefono, estatus", "'$inputNombreEmpresa','inputDescripcionEmpresa', '$inputNombre', '$inputApellido', '$inputRfc', '$inputCiudad', '$inputEmail', '$inputTelefono', '0'");
		}
		if ($consulta) {
			echo "Registro correcto";
		}else{
			echo "Error en registro";
		}
	}else{
		echo "La empresa ya se encuentra registrada";
	}
}



 ?>