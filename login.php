<?php
session_start();
include('conexion.php');
include('inc/cab.php');
	
	$nombre=$_SESSION['nombreCompleto'];
    $email=$_SESSION['email'];
	$pass=$_SESSION['password'];
	
	

/********************************************************************/

  
$sql = mysqli_query($conn,"SELECT * FROM usuarios WHERE email='$email' and contrasena='$pass'");
/********************************************************************/

/********************************************************************/
 if( mysqli_num_rows($sql) == 0){
	 $numero=$_SESSION['numero'];
	 $numero += $numero;

echo "<h1 style='font-size:2em'>";
echo "Datos incorrectos";
			
echo "</h1>";



//header('Refresh:2; url=log_main.php');
}
else{
header('Refresh:2; url=registrados/index.php');

}

/********************************************************************/
?>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
           
            <header>
                <h1>Estamos redirigiendote al <span>FORO</span></h1>
				
            </header>
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">

						
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>