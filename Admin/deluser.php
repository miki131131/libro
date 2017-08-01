<?php
include('conexion.php');
$id= $_GET['id'];
	
	$sql = "DELETE FROM usuarios WHERE idUser=$id";
	if(mysqli_query($conn,$sql)){
		echo "Registro borrado con &eacute;xito";
		header('Refresh:2; url=index.php');
		}else{
			echo "Error borrando el registro";
					header('Refresh:2; url=index.php');
			}
	
?>