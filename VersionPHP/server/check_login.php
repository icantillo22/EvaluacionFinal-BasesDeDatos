<?php
  require('conexion.php');

  $con = new ConectorBD('localhost', 'root', '');

  $response['conexion'] = $con->initConexion('agenda');

  if ($response['conexion'] == 'OK') {
    $user = $_POST['username'];
    $psw = $_POST['password'];
    $response['msg'] = 'Conectado';
    $resultado = $con->consultar(['usuarios'], ['*'], 'WHERE email = "'.$user.'"');
    $row = $resultado->fetch_assoc();

    if ($resultado->num_rows > 0) {
      if (password_verify($psw, $row['clave'])) {
			  $response['msg'] = "OK";
        session_start();
			  $_SESSION['user'] = $row['id'];
      }else {
        $response['msg'] = 'Contraseña invalida';
      }
    }else {
      $response['msg'] = 'Usuario Invalido';
    }
  }else {
    $response['msg'] = 'No se pudo conectar con la Base de Datos';
  }

    $con->cerrarConexion();
    echo json_encode($response);

?>
