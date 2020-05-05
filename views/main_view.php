<!DOCTYPE html>
<html lang="es">
<head>
  	<!-- jQuery -->
  	<script src="/js/jquery-3.2.1.min.js"></script>

	<meta charset="UTF-8">
	<title>MOSTRAR UNA CONSULTA MEDIANTE AJAX</title>
</head>
<body>


	<div class="file"><button><a>BOTON 1</a></button></div>
	<div id="mostrar">
		<table id="myTable" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Fecha</th>
					<th>Name</th>
					<th>Email</th>
					<th>Subject</th>
					<th>Email</th>
					<th>ID</th>
					<th>Message</th>
					<th>Adjuntos</th>
				</tr>
			</thead>
			<tbody id="inbox">

			</tbody>
		</table>
	</div>
</body>
<script src="tablaconajax.js"></script>
<SCRIPT>

	$(function(){

		
		$('body').on('click', '.file', function () {
			
			// para una demo, se puede utilizar tambien funConsultaTabla2()

			funConsultaTabla();

		});


	});


</SCRIPT>
</html>