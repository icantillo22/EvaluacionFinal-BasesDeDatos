<?php

  require('conexion.php');

  session_start();

  $con = new ConectorBD('localhost', 'root', '');

  $response['conexion'] = $con->initConexion('agenda');

  if (isset($_SESSION['user'])) {

    if ($response['conexion'] == 'OK') {

      $data['fecha_inicio'] = '"'.$_POST['start_date'].'"';
  		$data['fecha_fin'] = '"'.$_POST['end_date'].'"';
  		$data['hora_inicio'] = '"'.$_POST['start_hour'].'"';
  		$data['hora_fin'] = '"'.$_POST['end_hour'].'"';

      if ($con->actualizarRegistro('eventos', $data, 'id = '.$_POST['id'])) {
        $response['msg'] = 'OK';
      } else {
        $response['msg'] = 'No se actualizo el evento';
      }

    }else {
      $response['msg'] = "Se presento un error en la conexion";
    }

  }else {
    $response['msg'] = 'No se ha iniciado una sesion';
  }

  echo json_encode($response);
  $con->cerrarConexion();

 ?>
