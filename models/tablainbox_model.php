<?php 
//  	Manejar tabla inbox

require_once('../models/conexion_model.php');

class tablainbox extends Conexion{

	public $consultaultimo;

		
	public function __construct(){

		parent::__construct();
	}
		
	public function getId(){

			$query = "SELECT IdInbox
						FROM inbox
					ORDER BY IdInbox
					DESC LIMIT 1";

			$consultaultimo = $this->conexion_db->query($query) or die ("la consulta no devuelve datos");
			$res = $consultaultimo->fetch_assoc();
	    	return $res['IdInbox'];
	}

	public function getAll(){


			$query = "SELECT *
					    FROM inbox";

			$consulta = $this->conexion_db->query($query) or die ("la consulta no devuelve datos");
			
			foreach ($consulta as $linea) {
				$response[] = $linea;
			}
			/*
			while ($fila = $consulta->fetch_assoc() ) {
				$response[] = $fila;
			}*/
			
			return $response;

	}

	public function comprueba_idmail($idmail){
		
		if($idmail){
			//$idmail = "hola";
		}
		
		return $idmail;
	}

	public function guardarcorreo($arraymail){

			//$arraymail['idmail'] = $this->comprueba_idmail($arraymail['idmail']);
			$UltimoId = $this->getId();						//extrae el ultimo id
			$IdSiguiente = $UltimoId + 1;					//ultimo guardado + 1
			$arraymail['denombre'] = $this->busca_caract_noadmit($arraymail['denombre']);
			//$arraymail['denombre'] = $this->extrae_tildes($arraymail['denombre']);


        	$grabadatos = "INSERT INTO inbox ( 
        					Fecha, 
        					NomRemite, 
        					MailRemite,
        					Asunto,
        					Para,
        					IdMailServidor,
        					Mensaje,
        					NumAdjuntos
        			)VALUES (
        					FROM_UNIXTIME('$arraymail[fecha]'),
        					'$arraymail[denombre]',
        					'$arraymail[dedireccion]',
        					'$arraymail[asunto]',
        					'$arraymail[paradireccion]',
        					'$arraymail[idmail]',
        					'$arraymail[MensajeRed]',
        					'$arraymail[numadj]'
        			)";

        	$this->conexion_db->query($grabadatos) or die ('<br> No se han podido guardar los datos <br>' );
        	return $IdSiguiente;
	}
				// El nombre autonumerico de la tabla es : IdInbox, la variable asignada es IdSiguiente


	// devuelve el numero de filas
	public function getrowsinbox(){
		$query = "SELECT * 
				    FROM inbox";
		$result = $this->conexion_db->query($query) or die ("la consulta no funciona");
		// $rows = $result->fetch_assoc();
		return $result;
	}

	public function saveadjunto($IdSiguiente,$i,$filename){
		$grabaadjunto = "INSERT INTO inbox2 (
				IdInbox,
				IdAdjunto,
				NombreFichero)
						VALUES (
				'$IdSiguiente',
				'$i',
				'$filename'
			)";
		$this->conexion_db->query($grabaadjunto);
	}

	public function guardararchivoadj($IdSiguiente,$i,$filename,$archivoadj){

		$gr = fopen($_SERVER['DOCUMENT_ROOT']."/0ordenados/admin_LTE/3AdminLTE-3.0.0-beta.2/archivos/adjuntosdeservidor/".$IdSiguiente."_".$i." ".$filename, "w+");   									// prefijo de numero de correo electronico con el nombre del archivo
		fwrite($gr, $archivoadj);
		fclose($gr);
		$this->saveadjunto($IdSiguiente,$i,$filename);				//registra la grabacion del archivo  en la base de datos   
	}

	private function busca_caract_noadmit($string){
		$caract = "'";
		if(stripos($string, $caract)){

			$res = $this->extrae_tildes($string);
			return $res;
		}else{

			return $string;
		}
	}


	private function extrae_tildes($string){

		$Str_sintildes = mysqli_real_escape_string($this->conexion_db,$string);
		//$Str_sintildes = str_replace ("'", "*", $string);

		return $Str_sintildes;
	}

}
// fin bloque clase tablainbox





 ?>