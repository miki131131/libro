<?php
include('conexion.php');
include('inc/cab.php');

if(isset($_GET['envReg'])){
	$user = $_GET['usernamesignup'];
	$email = $_GET['emailsignup'];
	$pass = $_GET['passwordsignup'];
	$pass1 = $_GET['passwordsignup_confirm'];
	$color = $_GET['color'];
	
	
	if($pass != $pass1){
		echo "Las contraseñas no son iguales. Por favor, inténtalo de nuevo";
		header('Refresh:2; url=log_main.php');
		}else{
			
			$sql = "INSERT INTO usuarios(nombreCompleto, email, contrasena, color) VALUES   ('$user','$email','$pass','$color')";
			mysqli_query($conn,$sql);
			$id_insert= mysqli_insert_id($conn);			
			
			$sql2 ="INSERT INTO log (idUser, email, corr) VALUES ('$id_insert','$email','Logueado correctamente.')";
			mysqli_query($conn,$sql2);
			header('Refresh:2; url=log_main.php');
			
			}
	}

?>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
           
            <header>
                <h1>Estamos completando tu registro en el <span>FORO</span></h1>
				
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