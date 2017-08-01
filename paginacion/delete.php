<?php
include('conexion.php');
$id= $_GET['id'];
	
	$sql = "DELETE FROM user WHERE idUser=$id";
	if(mysqli_query($conn,$sql)){
		echo "Registro borrado con &eacute;xito";
		}else{
			echo "Error borrando el registro";
			}
	unlink("uploads/cliente$id.jpg");
?>