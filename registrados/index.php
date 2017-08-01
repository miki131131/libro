<!--/registrados/index-->
<?php
include('conexion.php');
session_start();
$nom = $_SESSION['nombreCompleto'];
$email = $_SESSION['email'];
;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>comentarios</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="../css/front.css">
</head>

<body>
<header>

<img id="foro" src="img/foro.jpg">
<img id="coment" src="img/coment1.png">
<img id="foro1" src="img/foro1.jpg">
</header>
<nav>
<div class="sess"><?php echo "<span class='recib'>Hola " . $nom . " </span>"; ?></div>
<span class="exit" style='cursor:pointer' onClick='exit()'>&nbsp;&nbsp;&nbsp;Salir</span>
<script>
function exit(){
	location.href="../exit.php";
	}
</script>
<!--//////////////////////////////  CUADRO BÚSQUEDA   //////////////////////-->
<div class="formu">	

<form method="get" action="busq.php">
<a id="busqpf" href="porfecha.php">Buscar por fecha</a>
<label for="busqu">Buscar por palabra:&nbsp;&nbsp;&nbsp;</label>
<input type="text" name="nombre" placeholder="Buscar" autofocus>
</form>
</div>

<!--////////////////////////////// FIN CUADRO BÚSQUEDA   //////////////////////-->
<form action="porfecha.php" method="get">


</form>
</nav>
<!--////////////////////////////////////////COMBO///////////////////////////////////////////-->
<div class="container">
<div>&nbsp;<span class="neocom"><a href="nuevo.php">NUEVO COMENTARIO</a><a href="mod.php">Modifica tus datos</a></span></div>
<section>

<article id="art2">

<form name="form1" method="get" action="poruser.php">
<select id="users" name="users">
<option value="todos">Todos</option>
<?php

$sql = ("SELECT idUser, nombreCompleto FROM usuarios");
$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_assoc($result)) {  

echo "<option value='" . $row['idUser'] . "'>" . $row['nombreCompleto'] . "</option>";


}

?>
</select>
<input style='cursor:pointer' type="submit" name="envio" value="Ir" />
</form>

<?php

	
//////////////////////////////////////PAGINACION/////////////////////////////////////////////


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

$empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;


$obtener_todo_BD = "SELECT * FROM mensajes";

//Realiza la consulta
$consulta_todo = mysqli_query($conn, $obtener_todo_BD);


$total_registros = mysqli_num_rows($consulta_todo);
//echo "Total = " . $total_registros;

$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 


////////////////////////////////////////QUERY///////////////////////////////////////////


$consulta_resultados = "SELECT men.mensaje, men.fecha, usu.nombreCompleto, usu.color FROM mensajes as men INNER JOIN usuarios as usu on men.idUser=usu.idUser ORDER BY men.fecha DESC LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
$result2 = mysqli_query($conn,$consulta_resultados);

while ($row = mysqli_fetch_assoc($result2)) 
{  
 
echo "<table><tr>";
echo "<td><span class='autor'>" .$row['fecha']. "<br><p style='color:".$row['color']."'>" . $row['nombreCompleto']."</p> dice: </span><br /><br />".$row['mensaje']."</td>";
echo "</tr></table>";
}

//echo "Total = " . $total_paginas;
for ($i=1; $i<=$total_paginas; $i++) {
	//if($total_paginas>6)$total_paginas=6;
	
	echo "<a href='?pagina=".$i."'>".$i."</a>| ";
	
	
  } 
	///////////////////////////////////////FIN PAGINACION//////////////////////////////////////////////////	
?>
</article>

</section>

</div><footer><p id="foot">&copy; <?php echo date('Y'); ?> comments<p></footer>
</body>
</html>