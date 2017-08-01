<?php
include('conexion.php');
include('captcha.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<style>
.content{width:70%;margin:auto;padding:30px;background-color:#9E9E9E;color:#FFF}
input[type=text], input[type=password]{box-shadow:0.5em 0.5em 0.5em #666 inset}
input[type=submit]{color:#069;width:100px;font-family:Georgia, "Times New Roman", Times, serif;font-weight:bold}
.registro{text-align:center;color:red}
</style>
</head>

<body>
<!--<div class="content">
<form action="<?php /*$_SERVER['PHP_SELF']*/ ?>" method="post" enctype="multipart/form-data">

<input type="submit" name="env" value="Enviar" />
</form>
</div>-->
<?php
  
 
	for($i=0;$i<100;$i++){
		  //var_dump($i);
		$imagen = "uploads/cliente$i.jpg";
		
		$sql = "INSERT INTO user (nombre, email, password, ruta_img) VALUES ('Miguel$i', 'ejemplo$i','011$i','$imagen')";
		
		mysqli_query($conn,$sql);
		 
		create_image(true,"uploads/cliente$i","cliente $i"); 
		}
 
	
	




?>


</body>
</html>