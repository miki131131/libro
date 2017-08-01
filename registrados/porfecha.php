<?php
include('conexion.php');
session_start();
$nom = $_SESSION['nombreCompleto'];
//	$email = $_SESSION['email'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>comentarios</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
<div class="busq">

<form method="get" action="busq.php">
<label for="nombre">Buscar&nbsp;&nbsp;&nbsp;</label>
<input type="search" name="nombre" placeholder="Buscar" autofocus>
</form>
</div>

</nav>
<!--////////////////////////////////////////COMBO///////////////////////////////////////////-->
<div class="container">
<div>&nbsp;<a class="neocom" href="nuevo.php">NUEVO COMENTARIO</a></div>
<br>
<div><span>Buscar por fecha:</samp></div>
<section>
<div class="fecha">

<form method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
Desde:
<input type="date" name="fecha1" step="1" min="2017-01-01" value="2017-01-01">
Hasta:
<input type="date" name="fecha2" step="1" max="2017-12-31" value="2017-01-01">
<input type="submit" value="Buscar" name="busqfch">

</form>
<button id="btnVol" type="button" onClick="vuelta()">Volver</button>
</div>
<script>
function vuelta(){
	window.location.href = 'index.php';
	}
</script>



<article id="art2">

<!--<form name="form1" method="get">
<select id="users" name="users">
<option value="todos">Todos</option>-->
<?php

/*$sql = ("SELECT idUser, nombreCompleto FROM usuarios");
$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_assoc($result)) {  

echo "<option value='" . $row['idUser'] . "'>" . $row['nombreCompleto'] . "</option>";


}*/

?>
<!--</select>
<input type="submit" name="envio" value="Ir" />
</form>-->



<?php
/*	if(isset($_GET['envio'])){

		$valor = $_GET['users'];
		
			global $valor;
		if($valor=='todos'){
			header('Location: index.php');
			}	*/
			


	//var_dump($valor);
//////////////////////////////////////PAGINACION/////////////////////////////////////////////

if(isset($_GET['busqfch'])){
	$fecha1 = $_GET['fecha1'];
	$fecha2 = $_GET['fecha2'];
	
	


	$cantidad_resultados_por_pagina = 20;



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



//var_dump($consulta_resultados);
?>
<div class="containe" width="800px">
  <h2>Comentarios. Del día <?php echo $fecha1; ?> al día <?php echo $fecha2; ?></h2>
        
  <table class="table table-bordered">
    <thead>
      <tr>
      <th>ID Mensaje</th>
       <th>Comentario</th>
       <th>Fecha</th>
       <th>ID usuario</th>        
        <th>Nombre</th>
       
        
       
       
      </tr>
    </thead>
    <tbody> 
     <?php
	
$consulta_resultados = "SELECT men.idMensaje, men.mensaje, men.fecha, usu.idUser, usu.nombreCompleto FROM mensajes as men INNER JOIN usuarios as usu on men.idUser=usu.idUser WHERE fecha	 BETWEEN '$fecha1' AND '$fecha2'";
$result2 = mysqli_query($conn,$consulta_resultados);
//var_dump($result2);
   
   foreach($result2 as $row){ ?>
      <tr>
      <td><?php echo $row['idMensaje'] ?></td>
      <td><?php echo $row['mensaje'] ?></td>
      <td><?php echo $row['fecha'] ?></td>
      <td><?php echo $row['idUser'] ?></td> 
      <td><?php echo $row['nombreCompleto'] ?></td>  
      </tr>
      
     <?php
   
	  	  
	//var_dump($result2);
	  }
	 ?>
    </tbody>
  </table>
</div>

<?php



/*for ($i=1; $i<=$total_paginas; $i++) {
	
	
	echo "<a href='?pagina=".$i."'>".$i."</a>| ";
	
	
  } */
}	
	///////////////////////////////////////FIN PAGINACION//////////////////////////////////////////////////	
?>
</article>

</section>

</div><footer><p id="foot">&copy; <?php echo date('Y'); ?> comments<p></footer>
<script src"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>