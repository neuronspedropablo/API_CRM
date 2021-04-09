<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	/* project de prueba */
	public function get_data()
	{
		//var_dump(); die();
		$this->load->model('Api_model');
	//	$data = $this->Api_model->get_data($_POST["fecha_inicio"],$_POST["fecha_inicio"]);
		$data = $this->Api_model->get_data($_GET["fecha_inicio"],$_GET["fecha_fin"]);
		$resultado = array('conexion' => true,
							'data' => $data );
		echo json_encode($data);
	}
	public function get_leads_month()
	{
		//var_dump($_POST); die();
		$this->load->model('Api_model');
	//	$data = $this->Api_model->get_data($_POST["fecha_inicio"],$_POST["fecha_inicio"]);
		$data = $this->Api_model->get_leads_month($_GET["fecha_inicio"],$_GET["fecha_fin"]);
		$resultado = array('conexion' => true,
							'data' => $data );
		echo json_encode($data);
	}
	public function getembudos(){
		
		$this->load->model('Api_model');
	//	$data = $this->Api_model->get_data($_POST["fecha_inicio"],$_POST["fecha_inicio"]);
		$data["leads"] = $this->Api_model->get_data($_GET["fecha_inicio"],$_GET["fecha_fin"]);
		//var_dump(count($data["leads"])); die();
		$data["citas_agendadas"] = $this->Api_model->gettipoactividad($_GET["fecha_inicio"],$_GET["fecha_fin"],"Cita totalmente confirmada");
		$data["citas_realizadas"] = $this->Api_model->gettipoactividad($_GET["fecha_inicio"],$_GET["fecha_fin"],"Ejecuta cita");
		$data["proceso_venta"] = $this->Api_model->gettipoactividad($_GET["fecha_inicio"],$_GET["fecha_fin"],"Seguimiento tras visita");
		$data["reservas"] = $this->Api_model->gettipoactividad($_GET["fecha_inicio"],$_GET["fecha_fin"],"Reserva");
		echo json_encode($data);
	}

	
}