<?php

  require('conexion.php');

  session_start();

  $con = new ConectorBD('localhost', 'root', '');

  $response['conexion'] = $con->initConexion('agenda');


  if (isset($_SESSION['user'])) {

    if ($response['conexion'] == 'OK') {

      $userActivo = $_SESSION['user'];
      $titulo = filter_input(INPUT_POST, 'titulo');
      $fecha_inicio = filter_input(INPUT_POST, 'start_date');
      $hora_inicio = filter_input(INPUT_POST, 'start_hour');
      $fecha_fin = filter_input(INPUT_POST, 'end_date');
      $hora_fin = filter_input(INPUT_POST, 'end_hour');
      $dia_completo = filter_input(INPUT_POST, 'allDay');

      $i = 1;
      $resultado = $con->consultar(['eventos'], ['id'], "WHERE id = '".$i."'");

      while ($resultado->num_rows != 0) {
        $i++;
        $resultado = $con->consultar(['eventos'], ['id'], "WHERE id = '".$i."'");
      }

      $id = $i;


      $evento['id'] = "'".$id."'";
      $evento['titulo'] = "'".$titulo."'";
      $evento['fecha_inicio'] = "'".$fecha_inicio."'";
      $evento['hora_inicio'] = "'".$hora_inicio."'";
      $evento['fecha_fin'] = "'".$fecha_fin."'";
      $evento['hora_fin'] = "'".$hora_fin."'";
      $evento['dia_completo'] = "'".$dia_completo."'";
      $evento['user_id'] = "'".$userActivo."'";

      if ($con->insertData('eventos', $evento)) {
        $response['msg'] = "OK";
      } else {
         $response['msg'] = "Se ha producido un error en la insercion";
      }

    }else {
      echo "Se presento un error en la conexion";
    }

  }else {
    echo "No ha iniciado sesion";
  }

  echo json_encode($response);

  $con->cerrarConexion();

 ?>
