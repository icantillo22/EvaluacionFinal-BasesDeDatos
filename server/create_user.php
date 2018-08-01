<?php

  require('conexion.php');

  $con = new ConectorBD('localhost', 'user_prueba', 'chopo1206');

  if ($con -> initConexion('agenda_db') == 'OK') {
    $insert = $con->getConexion()->prepare('INSERT INTO users (email, password, full_name, b_date) VALUES (?,?,?,?)');
		$insert->bind_param("ssss", $email, $password, $nombre, $fecha_nacimiento);


    for ($i=1; $i <= 3; $i++) {
      $password = "1234";
  		$email = "user".$i."@mail.com";
  		$nombre = "Usuario ".$i;
  		$password = password_hash($password, PASSWORD_DEFAULT);
  		$fecha_nacimiento = "1998-12-08";

      $insert->execute();
    }


	$con -> cerrarConexion();
}



 ?>
