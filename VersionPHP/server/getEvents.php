<?php

  require('conexion.php');

  session_start();

  $con = new ConectorBD('localhost', 'root', '');

  $response['conexion'] = $con->initConexion('agenda');

  if (isset($_SESSION['user'])) {

    if ($response['conexion'] == 'OK') {

      $userActivo = $_SESSION['user'];

      $resultado = $con->consultar(['eventos'], ['*'], "WHERE user_id = '".$userActivo."'");

      if ($resultado->num_rows != 0) {

        $i = 0;

        while ($row = $resultado->fetch_assoc()) {
          $response['eventos'][$i]['id'] = $row['id'];
          $response['eventos'][$i]['titulo'] = $row['titulo'];
          $response['eventos'][$i]['start'] = $row['fecha_inicio'].' '.$row['hora_inicio'];
          $response['eventos'][$i]['end'] = $row['fecha_fin'].' '.$row['hora_fin'];
          $response['eventos'][$i]['allDay'] = boolval($row['dia_completo']);
          $i++;
        }
        $response['msg'] = 'OK';
      }


      echo json_encode($response);

      $con->cerrarConexion();

    }else {
      $response['msg'] = "Se presento un error en la conexion";
    }
  }else {
    $response['msg'] = 'No se ha iniciado una sesion';
  }

 ?>
