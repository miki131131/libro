<!--index-->
<?php
session_start();
include('conexion.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>comentarios</title>
<link rel="stylesheet" type="text/css" href="css/front.css">
</head>

<body>
<header>

<img id="foro" src="registrados/img/foro.jpg">
<img id="coment" src="registrados/img/coment1.png">
<img id="foro1" src="registrados/img/foro1.jpg">
</header>
<nav>

<!--//////////////////////////////  CUADRO BÚSQUEDA   //////////////////////-->
<div class="formu">	
<form method="get" action="registrados/busq.php">
<label for="busqu">Buscar&nbsp;&nbsp;&nbsp;</label>
<input type="text" name="nombre" placeholder="Buscar" autofocus>
</form>
</div>

<!--////////////////////////////// FIN CUADRO BÚSQUEDA   //////////////////////-->

<div class="busq">
<ul>
<li><a href="log_main.php">Login</a></li>
<li><a href="log_main.php#toregister">Registro</a></li>

</ul>
</div>
</nav>
<div class="container"
<section>

<article id="art2">
<?php

$cantidad_resultados_por_pagina = 4;



if (isset($_GET["pagina"])) {

	//Si el GET de HTTP SÍ es una string / cadena, procede
	if (is_string($_GET["pagina"])) {

		
		 if (is_numeric($_GET["pagina"])) {

			 
			 if ($_GET["pagina"] == 1) {
				 header("Location: index.php");
				 
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

///////////////////////////////////////////////////////////////////////////////////

$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;

////////////////////////////////////////////////////////////////////////////////////////////////////

$obtener_todo_BD = "SELECT * FROM mensajes";

//Realiza la consulta
$consulta_todo = mysqli_query($conn, $obtener_todo_BD);


$total_registros = mysqli_num_rows($consulta_todo);
//echo "Total = " . $total_registros;

$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 


///////////////////////////////////////////////////////////////////////////////////


$consulta_resultados = "SELECT men.mensaje, men.fecha, usu.idUser, usu.nombreCompleto, usu.color FROM mensajes as men INNER JOIN usuarios as usu on men.idUser=usu.idUser ORDER BY men.fecha DESC LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
$result2 = mysqli_query($conn,$consulta_resultados);

while ($row = mysqli_fetch_assoc($result2)) 
{  
 
echo "<table><tr>";
echo "<td><span class='autor'>" .$row['fecha']. "<br><p style='color:".$row['color']."'>" . $row['nombreCompleto']."</p> dice: </span><br /><br />".$row['mensaje']."</td>";
echo "</tr></table>";
}

for ($i=1; $i<=$total_paginas; $i++) {
	
	echo "<a href='?pagina=".$i."'>".$i."</a>| ";
	
	
} 

?>
</article>
</section>

</div><footer><p id="foot">&copy; <?php echo date('Y'); ?> comments<p></footer>
</body>
</html>