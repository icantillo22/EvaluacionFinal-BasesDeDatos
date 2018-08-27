<?php
	session_start();
	if (isset($_SESSION['user'])) {
		session_destroy();
		$response['msg'] = 'Redireccionar';
    header('Location: http://localhost/EvaluacionFinal-BasesDeDatos/client/');
	}else{
		$response['msg'] = 'Redireccionar';
    header('Location: http://localhost/EvaluacionFinal-BasesDeDatos/client/');
	}
	echo json_encode($response);
?>
