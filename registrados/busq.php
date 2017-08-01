<?php
include('conexion.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<div class="container">
<?php 
if(isset($_GET['nombre'])){
	$nom = $_GET['nombre'];
	$nom = trim($nom);
	
	
	$sql = "SELECT * FROM mensajes as men INNER JOIN usuarios as usu on men.idUser=usu.idUser WHERE mensaje LIKE '%$nom%'";
		
	$res = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($res)){?>
    
    
    
    
		<table class="table">
        <th>Nombre</th>
                <th>Fecha</th>
                        <th>Comentario</th>
        <tr class="active">
        <td class="active"><?php echo $row['nombreCompleto'] ?></td>
        <td class="active"><?php echo $row['fecha'] ?></td>
        <td class="active"><?php echo $row['mensaje'] ?></td>
                </tr>
        </table>
		<?php
        }
	
	}?>
</div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>