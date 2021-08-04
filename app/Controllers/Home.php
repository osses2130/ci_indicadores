<?php

namespace App\Controllers;

use App\Models\Medida;
use App\Models\Indicador;

class Home extends BaseController
{

	protected $umedida;
	protected $indicador;

	public function __construct(){
		$this->umedida = new Medida();
		$this->indicador = new Indicador();
	}

	public function index()
	{
		
		$apiUrl = "https://mindicador.cl/api";
		//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
		if ( ini_get("allow_url_fopen") ) {
			$json = file_get_contents($apiUrl);
		} else {
			//De otra forma utilizamos cURL
			$curl = curl_init($apiUrl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($curl);
			curl_close($curl);
		}
		$indicadores = json_decode($json);

		$contador = 0;
		foreach($indicadores as $clave => $valor){
			$contador++;
			if($contador>3){
				$valoresApi[]=["codigo"=>$indicadores->$clave->codigo,
							"nombre"=>$indicadores->$clave->nombre,
							"umedida"=>$indicadores->$clave->unidad_medida,
							"fecha"=>$indicadores->$clave->fecha,
							"valor"=>$indicadores->$clave->valor
						];
			}
		}
		$datos["indicadorCombobox"] = $valoresApi;

		return view("home",$datos);
	}

	public function indicadorXAnio(){

		//Recibo las variables del formulario
		$tipo = $this->request->getPost('tipo');
		$anio = $this->request->getPost('anio');
		$apiUrl = "https://mindicador.cl/api/".$tipo."/".$anio;

		//Consulo los datos
		if ( ini_get("allow_url_fopen") ) {
			$json = file_get_contents($apiUrl);
		} else {
			$curl = curl_init($apiUrl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($curl);
			curl_close($curl);
		}

		$indicadorXAnio = json_decode($json);
		
		$nombreIndicador = $indicadorXAnio->nombre;
		$unidadMedida = $indicadorXAnio->unidad_medida;

		
		//Para obtener de fecha sólo los 1ros de cada mes
		for($a=0;$a<count($indicadorXAnio->serie);$a++){
			$fecha = substr($indicadorXAnio->serie[$a]->fecha,0,10);
			if(substr($fecha,8,2)=="01"){
				$fechas[] = $fecha;
				$fechaValor[] = ["fecha"=>$fecha, "valor"=>$indicadorXAnio->serie[$a]->valor];
			}
		}

		
		//Ordeno las fechas de menor a mayor
		sort($fechas);

		//Formateo los datos para pasar al gráfico
		//De acuerdo a la variable fechas que se encuentra ordenada ordeno el otro array con los valores de cada mes
		$meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
		for($f=0;$f<count($fechas);$f++){
			for($a=0;$a<count($fechaValor);$a++){
				if($fechas[$f]==$fechaValor[$a]["fecha"]){
					//$fechaValorOrdenados[] = ["fecha" => $fechaValor[$a]["fecha"], "valor" => $fechaValor[$a]["valor"]];
					$categoria.= "'01-".$meses[intval(substr($fechaValor[$a]["fecha"],5,2)-1)]."',";
					$data.= $fechaValor[$a]["valor"].",";
					$valor[]= $fechaValor[$a]["valor"];
					$sumaValor += $fechaValor[$a]["valor"];
				}

			}
		}


		$categoria = substr($categoria, 0, -1);
		$data = substr($data, 0, -1);

		$vMaximo = max($valor);
		$vMinimo = min($valor);
		$vPromedio = ($sumaValor/count($fechas));

		$datos["losDatos"] = ["nombre"=> $nombreIndicador,"unidad"=>$unidadMedida,"categoria"=>$categoria,"data"=>$data,"vmaximo"=>$vMaximo,"vminimo"=>$vMinimo,"vpromedio"=>$vPromedio];
		
		return view("grafico",$datos);
		
	}


	public function nuevoIndicador(){
		//Recibo las variables del formulario
		$codigo = $this->request->getPost('codigo');
		$nombre = $this->request->getPost('nombre');
		$medida = $this->request->getPost('medida');
		$fecha = $this->request->getPost('fecha');
		$valor = $this->request->getPost('valor');
		$fecha = date('Y-m-d', strtotime($fecha));

		$data = ["codigo"=>$codigo,"nombre"=>$nombre,"id_unidad_medida"=>$medida,"fecha"=>$fecha,"valor"=>$valor];
		$resultado = $this->indicador->set_inserta_datos($data);
		echo $resultado;
		

	}

	public function actualizaIndicador(){
		//Recibo las variables del formulario
		$id = $this->request->getPost('id');
		$codigo = $this->request->getPost('codigo');
		$nombre = $this->request->getPost('nombre');
		$medida = $this->request->getPost('medida');
		$fecha = $this->request->getPost('fecha');
		$valor = $this->request->getPost('valor');
		$fecha = date('Y-m-d', strtotime($fecha));

		$data = ["codigo"=>$codigo,"nombre"=>$nombre,"id_unidad_medida"=>$medida,"fecha"=>$fecha,"valor"=>$valor];
		$resultado = $this->indicador->set_actualiza_datos($id,$data);
		echo $resultado;
		

	}

	public function eliminaIndicador(){
		//Recibo las variables del formulario
		$id = $this->request->getPost('id');
		$resultado = $this->indicador->set_elimina_datos($id);
		echo $resultado;
		

	}

	public function tablaIndicador(){

		$medidas = $this->umedida->get_medidas();
		$datos['umedida'] = $medidas;
		
		$tbIndicadores = $this->indicador->get_indicador_medida();
		$datos['tbindicadores'] = $tbIndicadores;
		return view("tabla_indicadores",$datos);
	}


}
