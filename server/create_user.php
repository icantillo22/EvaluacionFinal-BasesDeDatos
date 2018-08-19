<?php

  require('conexion.php');

  $con = new ConectorBD('localhost', 'root', '');

  if ($con -> initConexion('agenda') == 'OK') {
    $insert = $con->getConexion()->prepare('INSERT INTO usuarios (id, nombre, email, clave, nacimiento) VALUES (?,?,?,?,?)');
		$insert->bind_param("issss", $id, $nombre, $email, $password, $nacimiento);

    $hash = password_hash('1234', PASSWORD_DEFAULT);


    for ($i=1; $i <= 3; $i++) {
  		$email = "user".$i."@mail.com";
      $password = $hash;
  		$nombre = "Usuario ".$i;
  		$nacimiento = "1998-12-08";
      $id = $i;
      $insert->execute();
    }


	$con -> cerrarConexion();
}



 ?>
