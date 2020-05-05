<?php

require('../models/tablainbox_model.php');

	$variable = new tablainbox();

	$busqueda = $variable->getAll();

	echo json_encode($busqueda);


?>