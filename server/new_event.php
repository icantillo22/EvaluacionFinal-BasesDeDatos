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

      
    }
  }

 ?>
