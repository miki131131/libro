<?php
include('conexion.php');
$id= $_GET['id'];
	
	$sql = "UPDATE usuarios SET intentos=1 WHERE idUser=$id";
	if(mysqli_query($conn,$sql)){
		echo "Activado con &eacute;xito";
		header('Refresh:2; url=index.php');
		}else{
			echo "Error borrando el registro";
					header('Refresh:2; url=index.php');
			}
	
?>