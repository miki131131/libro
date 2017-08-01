<?php
include('conexion.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<?php 
$numero = 0; 
if ( isset ( $_POST['submit'] ) ) 
{ 
   $op1 = $_POST['numero1'];
   $op2 = $_POST['numero2']; 

   if ( $op1 != $op2 ) 
   { 
      $resuelve = $_POST['numero'] + 1; 
      $numero = $resuelve;
	  if($numero>1){
	   echo "Llevas " . $numero . " intentos.";
	  }else{
		  echo "Llevas " . $numero . " intento.";
		  }
	   if($numero==3){
		$query= "UPDATE usuarios SET intentos=0 WHERE idUser=3";
		mysqli_query($conn,$query);
	  // header('Location: error.php');
	   }
 
/*$total = "";
for ($segundos = 1; $segundos <= 5; $segundos++)
{
echo "<p>".$segundos."</p>";
//Para cada iteración 1 segundo
sleep($segundos);
$total = $segundos;
}
echo "Tiempo completado: $total segundos";
sleep(5);
 echo "Ya toy aqui";*/
   }else{
	   
	   }
   }

?>
<?php
 $numero;
?> 
<form name = "submit" action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST"> 
<input type = "text" name = "numero" value = "<?php echo $numero; ?>" readonly> 
<p>Seleccione que operación desea realizar:<br/> 
Num1 <input type = "text" name = "numero1" ><br/> 
Num2 <input type = "text" name = "numero2" "><p> 
<input type = "submit" name = "submit" value = "Realizar operación"> 
</form>
</body>
</html>

