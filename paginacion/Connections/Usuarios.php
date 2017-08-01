<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Usuarios = "localhost";
$database_Usuarios = "usuarios";
$username_Usuarios = "root";
$password_Usuarios = "";
$Usuarios = mysql_pconnect($hostname_Usuarios, $username_Usuarios, $password_Usuarios) or trigger_error(mysql_error(),E_USER_ERROR); 
?>