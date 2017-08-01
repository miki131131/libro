<?php
include('conexion.php');
session_start();
include('inc/cab.php');
?>
<body>
<div class="container"> 
  <!-- Codrops top bar -->
  <?php 
$numero = ""; 
if ( isset ( $_GET['envLog'])) {
   $nombre = $_GET['nombreCompleto']; 
   $email = $_GET['email'];
   $pass = $_GET['password'];
   $num = $_GET['numero'];
  
   
   $_SESSION['nombreCompleto']=$nombre;
   $_SESSION['email']=$email;
   $_SESSION['password']=$pass;
   $_SESSION['numero']=$numero;
   
  
   $sql = "SELECT nombreCompleto, email, contrasena, intentos FROM usuarios WHERE email='$email'";
   $result = mysqli_query($conn,$sql);
   if(!isset($row['email'])){
	    echo "<h3 align='center' style='color:red;margin-right:60px;'>Lo sentimos. Los datos que has introducido no son correctos.</h3>";
	   }
   while($row = mysqli_fetch_assoc($result)){
	  $ints = $row['intentos'];
	  $error = "";
	  if($ints==0){
		  echo "Lo sentimos. Tu usuarios ha sido bloqueado. Ponte en contacto con el alministradordel Foro";
		  header('Refresh:2; url=index.php');
		  exit;
		  }else{
	  $_SESSION['email']=$email;
	   
	    if ( $pass != $row['contrasena'] ){
	    
      $resuelve = $_GET['numero'] + 1; 
      $numero = $resuelve;
	$sql1 = "UPDATE log SET corr='', incorr='Error al loguearse' WHERE email='$email'";
mysqli_query($conn,$sql1);
	   if($numero==3){
		$query= "UPDATE usuarios SET intentos=0 WHERE email='$email'";
		mysqli_query($conn,$query);
		
	   header('Location: error.php');
	   }

   }else{
	   $sql1 = "UPDATE log SET corr='Logueado correctamente', incorr='' WHERE email='$email'";
mysqli_query($conn,$sql1);
	   header('location: login.php');
   
   }
	   
	   }
	   

}
}
?>
  <section>
    <div id="container_demo" > <a class="hiddenanchor" id="toregister"></a> <a class="hiddenanchor" id="tologin"></a>
      <div id="wrapper">
        <div id="login" class="animate form"> 
          <!------------------------------------------   LOGIN   ------------------------------------>
          <form  action="<?php $_SERVER['PHP_SELF']; ?>" autocomplete="on" method="get">
            <h1>Log in
              <h2>
                <p> <span style="float:right"><a style="text-decoration:none" href="Admin/admin.php">Administrador</a></span> </p>
              </h2>
            </h1>
            <p>
              <label for="nombreCompleto" class="uname" data-icon="u" > Nombre </label>
              <input id="nombreCompleto" name="nombreCompleto" required type="text" placeholder="Nombre"/>
            </p>
            <p>
              <label for="email" class="uname" data-icon="u" > Tu email </label>
              <input id="email" name="email" required type="text" placeholder="Correo electrónico"/>
            </p>
            <p>
              <label for="password" class="youpasswd" data-icon="p"> Tu password </label>
              <input id="password" name="password" required type="password" placeholder="eg. X8df!90EO" />
            </p>
            <!--<p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
								</p>-->
            <label for="numero" class="youpasswd" data-icon="p"> Intentos <span style="font-size:0.5em">(Si introduces datos incorrectos por tercera vez ser&aacute;s bloqueado.)</span> </label>
            <input type = "text" name = "numero" value = "<?php echo $numero; ?>" readonly>
            <p class="login button">
              <input type="submit" name="envLog" value="Login" />
            </p>
            <p class="change_link"> Aún no eres miembro? <a href="#toregister" class="to_register">Regístrate</a> </p>
          </form>
        </div>
        
        <!------------------------------------------   REGISTRO   ------------------------------------>
        <div id="register" class="animate form">
          <form  action="reg.php" autocomplete="on" method="get">
            <h1> Sign up </h1>
            <p>
              <label for="usernamesignup" class="uname" data-icon="u">Tu username</label>
              <input id="usernamesignup" name="usernamesignup" required type="text" placeholder="Tu nombre" />
            </p>
            <p>
              <label for="emailsignup" class="youmail" data-icon="e" > Tu email</label>
              <input id="emailsignup" name="emailsignup" required type="email" placeholder="Tu email"/>
            </p>
            <p>
              <label for="passwordsignup" class="youpasswd" data-icon="p">Tu password </label>
              <input id="passwordsignup" name="passwordsignup" required type="password" placeholder="eg. X8df!90EO"/>
            </p>
            <p>
              <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirma tu password </label>
              <input id="passwordsignup_confirm" name="passwordsignup_confirm" required type="password" placeholder="eg. X8df!90EO"/>
            </p>
            <label for="color">Elige color para tu usuario:</label>
            <select class="color" name="color" required>
             <option value="selecciona">Selecciona</option>
              <option value="green">Verde</option>
              <option value="blue">Azul</option>
              <option value="red">Rojo</option>
              <option value="violet">Violeta</option>
              <option value="brown">Marron</option>
              <option value="orange">Naranja</option>
            </select>
            <p class="signin button">
              <input type="submit" name="envReg" value="Registrarse"/>
            </p>
            <p class="change_link"> Estás registrado? <a href="#tologin" class="to_register"> Ir a Login </a> </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
</body>
</html>