<?php
include('conexion.php');
$idmens= $_GET['idmens'];
	
	$sql = "DELETE FROM mensajes WHERE idMensaje=$idmens";
	if(mysqli_query($conn,$sql)){
		echo "Registro borrado con &eacute;xito";
		header('Refresh:2; url=index.php');
		}else{
			echo "Error borrando el registro";
					header('Refresh:2; url=index.php');
			}
	
?>