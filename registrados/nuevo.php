<?php
include('conexion.php');
session_start();

$nom = $_SESSION['nombreCompleto'];

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
<div class="sess"><?php echo "<span class='recib'>Hola " . $nom . "</span>"; ?></div>
<span class="exit" style='cursor:pointer' onClick='exit()'>&nbsp;&nbsp;&nbsp;Salir</span>
<script>
function exit(){
	location.href="../exit.php";
	}
</script>
<div class="formu">	

<form method="get" action="busq.php">
<a id="busqpf" href="porfecha.php">Buscar por fecha</a>
<label for="busqu">Buscar por palabra:&nbsp;&nbsp;&nbsp;</label>
<input type="text" name="nombre" placeholder="Buscar" autofocus>
</form>
</div>

</nav>
<div class="container">
<?php echo "Hola " . $nom .". Por favor, inserta tu comentario.";
echo "<p>&nbsp;</p>";
?>
<form action="insertar.php" method="get">
<textarea rows="6" name="txta"cols="162">
 
</textarea><br />
<input type="submit" name="envmsg" value="Enviar">
</form>
</div>

<footer><p id="foot">&copy; <?php echo date('Y'); ?> comments<p></footer>
</body>
</html>