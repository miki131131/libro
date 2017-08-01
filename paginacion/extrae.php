<?php
include_once("conexion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<head>
	<title>Paginaci&oacute;n de resultados</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <style>

	body{font-family:Arial, Helvetica, sans-serif}
	a:hover{cursor:pointer}
	.content{width:70%;margin:auto}
    td{height:30px;width:150px}
	img{height:30px;}
    </style>
</head>
<body>
<center>
<?php
$cantidad_resultados_por_pagina = 10;

///////////////////////////////////////////////////////////////////////////////////

if (isset($_GET["pagina"])) {

	//Si el GET de HTTP SÍ es una string / cadena, procede
	if (is_string($_GET["pagina"])) {

		
		 if (is_numeric($_GET["pagina"])) {

			 
			 if ($_GET["pagina"] == 1) {
				 header("Location: extrae.php");
				 
			 } else { 
				 $pagina = $_GET["pagina"];
			};

		 } else { 
			 header("Location: index.php");
			
		 };
	};

} else { 
	$pagina = 1;
};


$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;

////////////////////////////////////////////////////////////////////////////////////////////////////

$obtener_todo_BD = "SELECT * FROM user";

//Realiza la consulta
$consulta_todo = mysqli_query($conn, $obtener_todo_BD);


$total_registros = mysqli_num_rows($consulta_todo);


$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 


$consulta_resultados = mysqli_query($conn, "
SELECT * FROM user 
ORDER BY idUser ASC 
LIMIT $empezar_desde, $cantidad_resultados_por_pagina");

while($datos = mysqli_fetch_array($consulta_resultados)) {

echo "<div class='content'>";
 echo "<table border='1'></tr>";
 
 $id=$datos['idUser'];
 echo "<td>" . $datos['idUser'] . "</td><td>" . $datos['nombre'] . "</td><td>".$datos['email']."</td>". "<td>".$datos['password']."</td><td><img src='". $datos['ruta_img'] ."'></td><td>" . $datos['dia'] .
 
  "<td><a onclick='javascript:confirmarborrado(" . $datos['idUser'] .")'>Borrar</a></td>" .
  "<td><a onclick='javascript:actualizardatos(" . $datos['idUser'] .")'>Editar</a></td>";
 
 
 
echo "</tr></table>";
echo "</div>";

};
?>




<hr><!----------------------------------------------->

<a href="http://localhost/paginacion/extrae.php?pagina=1">&laquo;</a>| 

<?php

for ($i=1; $i<=$total_paginas; $i++) {
	if($total_paginas>6)$total_paginas=6;
	
	echo "<a href='?pagina=".$i."'>".$i."</a>| ";
	
	
} 


?>

<a href="http://localhost/paginacion/extrae.php?pagina=7">&raquo;</a>
<?php
/*if($total_paginas=7){
	$empezar_desde = $pagina+1;
	for ($x=7; $x<=$total_paginas; $x++) {
	//if($total_paginas>6)$total_paginas=6;
	
	echo "<a href='?pagina=".$x."'>".$x."</a>| ";
	
} 
	}*/
?>



<!--/////////////////////////////////////////////////SCRIPTS////////////////////////////////////////////-->


<script>
function confirmarborrado(id){
	var confirmar = confirm("Seguro que quieres borrarel id " + id + " ?");
	if(confirmar == true){
		location.href="delete.php?id=" + id;
		}
	}
	
function actualizardatos(id){
	location.href="edit.php?id=" + id;
	}
	

    </script>


</center>
</body>
</html>