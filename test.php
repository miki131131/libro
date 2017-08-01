<?php
include('conexion.php');
session_start();
$ema = "luis@gmail.es";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<label for="ema">Email:</label>
<input type="text" name="ema">
<input type="submit" value="Enviar" name="env">
</form>
<?php
if(isset($_POST['env'])){
$query = "SELECT idUser FROM usuarios WHERE email='$ema'";
$res = mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($res)){
	$ema = $_POST['ema'];
	}
	echo "Email = " . $ema;
}
?>
</body>
</html>