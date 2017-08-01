<?php
include('conexion.php');
session_start();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>comentarios</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<header>

<img id="foro" src="img/foro.jpg">
<img id="coment" src="img/coment1.png">
<img id="foro1" src="img/foro1.jpg">
</header>
<nav>
<div class="sess"><?php echo "<span class='recib'>Administración </span>"; ?></div>
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
<div>&nbsp;<span class="neocom">USUARIOS</span></div>
<section>

<article id="art2">

<form name="form1" method="get">
<select id="users" name="users">
<option value="todos">Todos</option>
<?php

$sql = ("SELECT idUser, nombreCompleto FROM usuarios");
$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_assoc($result)) {  

echo "<option value='" . $row['idUser'] . "'>" . $row['nombreCompleto'] . "</option>";
/*echo "<a onclick='javascript:confirmarborrado(" . $row['idUser'] .")'>Borrar</a>";*/


}

?>
</select>
<input type="submit" name="envio" value="Ir >>>" />
</form><br />

<?php
	if(isset($_GET['envio'])){

		$valor = $_GET['users'];
		
			global $valor;
		if($valor=='todos'){
			header('Location: index.php');
			}	
			


	//var_dump($valor);
//////////////////////////////////////PAGINACION/////////////////////////////////////////////


	$cantidad_resultados_por_pagina = 30;



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


$consulta_resultados = "SELECT men.idMensaje, men.mensaje, men.fecha, usu.idUser, usu.nombreCompleto  FROM mensajes as men INNER JOIN usuarios as usu on men.idUser=usu.idUser WHERE usu.idUser='$valor' ORDER BY men.idUser DESC LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
$result2 = mysqli_query($conn,$consulta_resultados);
//var_dump($consulta_resultados);

while ($row = mysqli_fetch_assoc($result2)) 
{  
$iduser = $row['idUser'];
$_SESSION['idUser']=$iduser;
echo "<table><tr>";
echo "<td><span class='autor'>" .$row['fecha']. "<br>'" . $row['nombreCompleto']." dice: </span><br /><br />".$row['mensaje']."</td>";
echo "<td class='borr'><a style='cursor:pointer;color:green;float:right' onclick='javascript:confirmarborradomensaje(" . $row['idMensaje'] .")'>Borrar Mensaje</a></td>";
echo "</tr></table>";
$user = $row['nombreCompleto'];

$row_cnt = $result2->num_rows;

}
if($result2->num_rows==0){
	echo "No hay comentarios";echo $row['idUser'];
}else{
echo "<br>" . $user . " tiene \"<strong>" . $row_cnt . "</strong>\" comentarios";
$sql3 = "UPDATE log SET nummens='$row_cnt' WHERE idUser='$iduser'";
echo "ID user =" . $iduser;
	}

/*for ($i=1; $i<=$total_paginas; $i++) {
	
	
	echo "<a href='?pagina=".$i."'>".$i."</a>| ";
	
	
  }*/  echo "<td class='borr'><a style='cursor:pointer;color:green;float:right' onclick='javascript:confirmarborrado(" . $valor .")'>Borrar Usuario</a></td><br><br>";
    echo "<td class='borr'><a style='cursor:pointer;color:green;float:right' onclick='javascript:activarusuario(" . $valor .")'>Activar Usuario</a></td>";
}	
	///////////////////////////////////////FIN PAGINACION//////////////////////////////////////////////////	
?>
</article>

</section>
<script>

function activarusuario(id){
	var confirmar = confirm("Seguro que quieres activar el usuario " + id + " ?");
	if(confirmar == true){
		location.href="activar.php?id=" + id;
		}
	}
function confirmarborrado(id){
	var confirmar = confirm("Seguro que quieres borrar el usuario " + id + " ?");
	if(confirmar == true){
		location.href="deluser.php?id=" + id;
		}
	}
function confirmarborradomensaje(idmens){
	var confirmar = confirm("Seguro que quieres borrar el mensaje " + idmens + " ?");
	if(confirmar == true){
		location.href="delmens.php?idmens=" + idmens;
		}
	}
	</script>
</div><footer><p id="foot">&copy; <?php echo date('Y'); ?> comments<p></footer>
</body>
</html>