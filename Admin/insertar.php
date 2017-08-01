<?php
include('conexion.php');
session_start();

$email = $_SESSION['email'];
//echo "Holaaaaa " . $nom;


$sql = "SELECT idUser FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row['idUser'];
		 $_SESSION['idUser']=$id;		
    }
	//$usess = $_SESSION['idUser'];

}

if(isset($_GET['envmsg'])){
$txta = $_GET['txta'];
$sql1 = "INSERT INTO  mensajes (idUser, mensaje) VALUES ('$id', '$txta');";
mysqli_query($conn,$sql1);
header('Location: index.php');
}
//echo "Id ext =  " . $usess ;
$conn->close();




?>

