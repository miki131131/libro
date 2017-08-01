<!--Admin/index-->
<?php
include('conexion.php');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>comentarios</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style>
.borr {position:absolute;font-family:"Courier New", Courier, monospace;cursor:pointer}
.botones {
	font-family:"Courier New", Courier, monospace;
	background-color:#3B5999;
	color:#FFF;
	border: 3px solid #CCC;
	border-radius: 0.3em;
	padding: 6px;
	margin-right: 10px;
	cursor:pointer;
}
</style>
</head>

<body>
<header> <img id="foro" src="img/foro.jpg"> <img id="coment" src="img/coment1.png"> <img id="foro1" src="img/foro1.jpg"> </header>
<nav>
  <div class="sess"><?php echo "<span class='recib'>Bienvenido a la Administración</span>"; ?></div>
  <span class="exit" style='cursor:pointer' onClick='exit()'>&nbsp;&nbsp;&nbsp;Salir</span> 
  <script>
function exit(){
	location.href="../exit.php";
	}
</script>
<div class="formu">	
<form method="get" action="../registrados/busq.php">
<label for="busqu">Buscar&nbsp;&nbsp;&nbsp;</label>
<input type="text" name="nombre" placeholder="Buscar" autofocus>
</form>
</div>
</nav>
<!--////////////////////////////////////////COMBO///////////////////////////////////////////-->
<div class="container"> 
  <!--<div>&nbsp;<span class="neocom"><a href="nuevo.php">NUEVO COMENTARIO</a><a href="mod.php">Modifica tus datos</a></span></div>-->
  <section>
    <article id="art2">
      <form name="form1" method="get" action="poruser.php">
      Usuarios
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
        <input type="submit" name="envio" value="Ir >>>" />
      </form>
      <br />
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


$consulta_resultados = "SELECT men.idMensaje, men.mensaje, men.fecha, usu.idUser, usu.nombreCompleto FROM mensajes as men INNER JOIN usuarios as usu on men.idUser=usu.idUser ORDER BY men.fecha DESC LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
$result2 = mysqli_query($conn,$consulta_resultados);

while ($row = mysqli_fetch_assoc($result2)) 
{  


echo "<table><tr>";

echo "<td><span class='autor'>" .$row['fecha']. "<br>" . $row['nombreCompleto']." dice: </span><br /><br />".$row['mensaje']."</td>".
  
  "<br /><td class='borr'><a onclick='javascript:confirmarborrado(" . $row['idMensaje'] .")'>Borrar</a></td>" .

 
"</tr></table>";
echo "<br /><br />";
}

//echo "Total = " . $total_paginas;
for ($i=1; $i<=$total_paginas; $i++) {
	//if($total_paginas>6)$total_paginas=6;
	
	echo "<a href='?pagina=".$i."'>".$i."</a>| ";
	
	
  } 
	///////////////////////////////////////FIN PAGINACION//////////////////////////////////////////////////	
?>

<script>
function confirmarborrado(id){
	var confirmar = confirm("Seguro que quieres borrar el mensaje " + id + " ?");
	if(confirmar == true){
		location.href="delete.php?id=" + id;
		}
	}
	
function actualizardatos(id){
	location.href="edit.php?id=" + id;
	}
	

    </script>

    </article>
  </section>
</div>
<footer>
  <p id="foot">&copy; <?php echo date('Y'); ?> comments
  <p>
</footer>
</body>
</html>