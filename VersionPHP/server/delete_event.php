<?php

  require('conexion.php');

  session_start();

  $con = new ConectorBD('localhost', 'root', '');

  $response['conexion'] = $con->initConexion('agenda');

  if (isset($_SESSION['user'])) {

    if ($response['conexion'] == 'OK') {

      $userActivo = $_SESSION['user'];
      $idEvento = $_POST['id'];

      if ($con->eliminarRegistro('eventos', 'user_id = '.$userActivo.' AND id = '.$idEvento)) {
        $response['msg'] = 'OK';
      }else {
        $response['msg'] = 'Se produjo un error en la eliminacion';
      }

      echo json_encode($response);
      $con->cerrarConexion();


    }else {
      echo 'Se presento un error en la conexion';
    }

  }else {
    echo "No ha iniciado sesion";
  }


 ?>
