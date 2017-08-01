<?php
include('conexion.php');
 if(isset($_GET['id'])){
$id= $_GET['id'];
	$sql = "SELECT * FROM user WHERE idUser=$id";
	//var_dump($id);
	$result = mysqli_query($conn,$sql);
	
	while($fila = mysqli_fetch_array($result)){ 
	//var_dump($fila);
	
?>
    <form method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
    <label for="idUser">ID:</label>
  <input type="text" name="idUser" readonly value=" <?php echo $fila['idUser']; ?>" /><br /><br />
  <label for="nombre">Nombre:</label>
  <input type="text" name="nombre" value=" <?php echo $fila['nombre']; ?>" /><br /><br />
  <label for="email">Email:</label>
  <input type="text" name="email" value=" <?php echo $fila['email']; ?>" /><br /><br />
  <label for="password">Password:</label>
  <input type="text" name="password" value=" <?php echo $fila['password']; ?>" /><br /><br />
  <label for="ruta_img">Ruta Imagen:</label>
  <input type="text" name="ruta_img" value=" <?php echo $fila['ruta_img']; ?>" /><br /><br />
  <input type="submit" name="env" value="Actualizar" />
  </form>
 <?php      

   } 

 }
      //var_dump($_GET);
 if(isset($_GET['env'])){ 
 $id= $_GET['idUser'];
 $nombre = $_GET["nombre"];
 $email = $_GET["email"];
 $password = $_GET["password"];
 $ruta_img = $_GET["ruta_img"];
  

$sql = "UPDATE user SET nombre='$nombre', email='$email', password='$password', ruta_img ='$ruta_img' WHERE idUser=$id";

//echo $sql;
if (mysqli_query($conn,$sql)){
echo "Actualizaci&oacute;n exitosa";
}else{
echo "Error de actualizacion"; 
}
 }
?>