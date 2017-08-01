<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<center>
<div class="container">
<div class="contadmin">
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<fieldset>
  <legend>Acceso Administrador</legend>
  Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="emai"><p>&nbsp;</p>
  Password: <input type="password" name="pasw"><br><p>&nbsp;</p>
  <input type="submit" value="Acceder a la Administración" name="admi">
  
 </fieldset>
</form>
<?php
if(isset($_POST['admi'])){
	$emai = $_POST['emai'];
	$pasw = $_POST['pasw'];
	if($emai=='miguelcano128@gmail.com' && $pasw=='654321'){
		header('Location: index.php');
		}else{
			echo "<p style='font-size:1.2em;color:red'>No puedes acceder a esta zona.</p>";
			header('Refresh:2; url=../index.php');
			}
	}
?>
</div>
</div>
</center>
</body>
</html>