<?php
include('conexion.php');
session_start();
$email = $_SESSION['email'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

<?php
include('conexion.php');
 if(isset($_SESSION['email'])){

	$sql = "SELECT * FROM usuarios WHERE email='$email'";
	//var_dump($sql);
	$result = mysqli_query($conn,$sql);
	
	while($fila = mysqli_fetch_array($result)){ 
	//var_dump($fila);
	
?>
    <form method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
    <label for="idUser">ID:</label>
  <input type="text" name="idUser" readonly value="<?php echo $fila['idUser']; ?>" /><br /><br />
  
  <label for="nombre">Nombre:</label>
  <input type="text" name="nombre" value="<?php echo $fila['nombreCompleto']; ?>" /><br /><br />
  
  <label for="email">Email:</label>
  <input type="text" name="email" value="<?php echo $fila['email']; ?>" /><br /><br />
  
  <label for="password">Password:</label>
  <input type="text" name="password" value="<?php echo $fila['contrasena']; ?>" /><br /><br />
 
  <input type="submit" name="env" value="Actualizar" />
  </form>
 <?php      

  
 if(isset($_GET['env'])){ 
 $id= $_GET['idUser'];
 $nombre = $_GET["nombre"];
 $email = $_GET["email"];
 $password = $_GET["password"];

  

$sql2 = "UPDATE usuarios SET nombreCompleto='$nombre', contrasena='$password' WHERE email='$email'";

//var_dump($sql2);
if (mysqli_query($conn,$sql2)){
echo "Actualizaci&oacute;n exitosa. Por favor, ingresa con tus nuevos datos.";
header('Refresh:2; url=../exit.php');

}else{
echo "Error de actualizacion"; 
}
 }
 }
   }     //var_dump($_GET);

?>

</body>
</html>