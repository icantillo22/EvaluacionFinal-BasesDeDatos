<?php

  require('conexion.php');

  $con = new ConectorBD('localhost', 'root', '');

  if ($con -> initConexion('agenda_db') == 'OK') {
    $insert = $con->getConexion()->prepare('INSERT INTO users (email, password, full_name, b_date) VALUES (?,?,?,?)');
		$insert->bind_param("ssss", $email, $password, $nombre, $fecha_nacimiento);

    $hash = password_hash('1234', PASSWORD_DEFAULT);


    for ($i=1; $i <= 3; $i++) {
  		$email = "user".$i."@mail.com";
      $password = $hash;
  		$nombre = "Usuario ".$i;
  		$fecha_nacimiento = "1998-12-08";

      $insert->execute();
    }


	$con -> cerrarConexion();
}



 ?>
