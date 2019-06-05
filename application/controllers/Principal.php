<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	function __construct(){
    parent::__construct();
  	$this->load->model('Emailme');
		require 'vendor/autoload.php';
		$this->load->model('Solicitud');
    }

	public function index(){
		
		$this->load->view('template', 
			['body'=>$this->load->view('index',[], true)]);
		
	}

	public function register(){

		$this->load->view('template', 
			['body'=>$this->load->view('register',[], true)]);

	}
	
	public function solicitud(){

		$this->load->view('template', 
			['body'=>$this->load->view('solicitud',[], true)]);
	}
	
	public function getSolicitudes(){

		if($this->Usuario->isAdmin()){
			
			$solicitudes = $this->Solicitud->getSolicitudes();
			
			if($solicitudes != null){

				$this->load->view('template', 
					['body'=>$this->load->view('solicitudes',['solicitudes' => $solicitudes], true)]);
			}
			else{
				 redirect('Principal/getSolicitudesGestionadas');
			}
			
		}
		else{
			redirect('Principal/forbidden');
		}
	}

	function getSolicitudesGestionadas(){

		$solicitudesGestionadas = $this->Solicitud->getSolicitudesGestionadas();

		$this->load->view('template', 
					['body'=>$this->load->view('solicitudes',['solicitudes' => $solicitudesGestionadas], true)]);
	}

	public function acceptSolicitud($idSol){

		if($this->Usuario->isLogged() && $this->Usuario->isAdmin()){
			$solicitud = $this->Solicitud->getSolicitudById($idSol);
			$this->Usuario->changeTypeToGestor($solicitud->usuarios_idusuarios);
			$this->Solicitud->setBorradoSolicitud($idSol);
			$this->Solicitud->Aceptar($idSol);

			$this->load->view('template', 
				['body'=>$this->load->view('completed',[], true)]);
		}
		else{
			redirect('Principal/forbidden');
		}
	}

	public function rejectSolicitud($idSol){

		if($this->Usuario->isLogged() && $this->Usuario->isAdmin()){

			$this->Solicitud->setBorradoSolicitud($idSol);
			$this->Solicitud->Denegar($idSol);

			$this->load->view('template', 
				['body'=>$this->load->view('completed',[], true)]);
		}
		else{
				redirect('Principal/forbidden');
		}
	}

	public function selectEquipo(){

		$equipos = $this->Deportes->getEquiposByUsuarioId();

		if($equipos!=null){

			$this->load->view('template', 
				['body'=>$this->load->view('selectEquipo',['equipos' => $equipos], true)]);	

		}
		else{
			redirect('Principal/forbidden');
		}
		
	}

	public function notify(){

		if($this->input->post()){
			$this->Deportes->setNotify($this->input->post('selectDep'));
			$encuentros = $this->Encuentros->getEncuentrosPorEquipo($this->input->post('selectDep'));
			$this->Emailme->notify(
				'prgdwes@gmail.com', $this->session->userdata('user')->usuario, "Horarios de su equipo", $encuentros);

			$this->load->view('template', 
				['body'=>$this->load->view('completed',[], true)]);

		}
		else{
			redirect('Principal/selectEquipo');
		}
	}

	function controlUsuarios(){

		$this->load->library('grocery_CRUD');

		if($this->Usuario->isAdmin()){

			$crud = new grocery_CRUD();
			$crud->set_table('usuarios');
			$crud->columns('usuario','nombre','apellidos','correo', 'tipo');
			 
			$output = $crud->render();
			 
			$this->_example_output($output);
		}
		else{
			redirect('Principal/forbidden');
		}

	}

	public function _example_output($output = null){

			$this->load->view('CRUD.php',(array)$output);
	}

	public function forbidden(){

		$this->load->view('template', 
				['body'=>$this->load->view('forbidden',[], true)]);
	}

}
