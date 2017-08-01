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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
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

  <div class="container">
  <form role="form">
  <div class="form-group">
    <label for="email">ID:</label>
    <input type="text" name="idUser" class="form-control" readonly value="<?php echo $fila['idUser']; ?>" />
  </div>
  <div class="form-group">
    <label for="pwd">Nombre:</label>
   <input type="text" name="nombre" class="form-control" value="<?php echo $fila['nombreCompleto']; ?>" />
  </div>
   <div class="form-group">
    <label for="email">Email:</label>
  <input type="text" name="email" class="form-control" value="<?php echo $fila['email']; ?>" />
  </div>
   <div class="form-group">
    <label for="password">Password:</label>
  <input type="text" name="password" class="form-control" value="<?php echo $fila['contrasena']; ?>" />
  </div>
  <button type="submit" name="env" class="btn btn-default">Submit</button>
</form>
</div>
 <?php      

  
 if(isset($_GET['env'])){ 
 $id= $_GET['idUser'];
 $nombre = $_GET["nombre"];
 $ema = $_GET["email"];
 $password = $_GET["password"];
   

$sql2 = "UPDATE usuarios SET nombreCompleto='$nombre', email='$ema', contrasena='$password' WHERE idUser='$id'";

//var_dump($sql2);
if (mysqli_query($conn,$sql2)){
echo "Actualizaci&oacute;n exitosa. Por favor, ingresa con tus nuevos datos.";
header('Refresh:2; url=../exit.php');

}else{
echo "Error de actualizacion"; 
}
 }
 }
   }     

?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>