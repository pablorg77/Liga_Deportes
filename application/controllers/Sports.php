<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sports extends CI_Controller {


	public function index(){

		$deportes = $this->Deportes->getDeportes();

		$this->load->view('template',
		['body'=>$this->load->view('baseDeporte',['deportes'=>$deportes], true)]);

		
	}

	public function cargaDeporte($id){
		$deporte = $this->Deportes->getDeporteById($id);
		$equipos = $this->Deportes->getEquiposByDeporteId($deporte->iddeporte);

		$this->load->view('template',
		['body'=>$this->load->view('deporte',['deporte'=>$deporte, 'equipos'=>$equipos], true)]);
	}



}
