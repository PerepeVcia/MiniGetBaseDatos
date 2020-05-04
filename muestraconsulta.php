<?php 



	require('class.tablainbox.php');

	$variable = new tablainbox();

	$busqueda = $variable->getAll();


	echo json_encode($busqueda);


/*	while ($fila1 = mysqli_fetch_array($busqueda)) {

		echo "print1";
		var_dump($fila1);


	};

	var_dump($busqueda);

	foreach ($busqueda as $fila3) {
		
		$todo[] = $fila3;
	}

	echo json_encode($todo);*/

 ?>