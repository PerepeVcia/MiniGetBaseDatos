
// informativo para ver como funciona <--- funConsultaTabla2 ---->
// si que funciona, pero no es efectivo. solo sirve para comprender su funcionamiento
// crea dos bucles (each), pasa por el primer elemento,y como este, es un objeto, se mete dentro de ese objeto y pasa
// por todos los elemntos que tiene dentro. Cuando ha terminado, pasa por el siguiente elemento, que como tambien es
// un objeto, se mete dentro y recorre todos los elementos.
// a la practica es un objeto compuesto por muchas lineas, y cada linea tiene muchos campos, con sus valores respectivos.
// entra en la primera linea, recorre los campos y los valores de estos, y cuando termina, se va a la siguiente linea
var funConsultaTabla2 = function(){


	$.ajax({
		type: "POST",
		url: "muestraconsulta.php",
		datatype: 'json',
		}).done(function(data){

		//objjson es un string que tiene formato json, y lo convertimos a un objeto Json
		objjson = JSON.parse(data);

		//muestra del objeto objjson, solamente el valor del subobjeto 1, para la propiedad Para (es jquery)
		$('#mostrar').append( " este " + objjson[1].Para  + "<br/>" );
				

		//desgrana el objeto JSON en lineas con subobjetos
		$.each(objjson, function(index,objeto2) {						//recorre el objetoJson por cada linea
	
			$('#mostrar').append( index + " de " + objjson.length + "<br/>" );
	
			//desgrana cada subobjeto en propiedades y su valor
			$.each(objeto2, function(propiedad,valor) {
				$('#inbox').append( propiedad + " :  " + valor + "<br/>" );
				if (propiedad == "Asunto"){
					recordatorio = valor;
				}
			});
	
			$('#mostrar').append( "RESUMEN" + " :  " + recordatorio + "<br/>" );
		});
			
	});
};

//plantilla real
function funConsultaTabla(){


	$.ajax({
		type: "POST",
		url: "muestraconsulta.php",
		datatype: 'json',
		}).done(function(data){

		//objjson es un string que tiene formato json, y lo convertimos a un objeto Json
		objjson = JSON.parse(data);
						
		var mostrarhtml;

		$.each(objjson, function(index,objeto2) {
			if((index>=10) && (index<17)){
				mostrarhtml+="<tr>";
	
				$.each(objeto2, function(propiedad,valor) {			

					mostrarhtml+="<th>" + valor + "</th>";

				});		

				mostrarhtml += "</tr>";
			};

		});


		$('#inbox').append(mostrarhtml);
			
	});
};
