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

		$categorias = $this->Deportes->getCategorias();
		$deportes = $this->Deportes->getDeportes();

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

		if($this->Usuario->isLogged() && $this->Usuario->isAdmin()){
			
			$solicitudes = $this->Solicitud->getSolicitudes();
			if($solicitudes != null){

				$this->load->view('template', 
					['body'=>$this->load->view('solicitudes',['solicitudes' => $solicitudes], true)]);
			}
			else{
				$this->load->view('template', 
					['body'=>$this->load->view('index',[], true)]);
			}
			
		}
		else{
			$this->load->view('template', 
				['body'=>$this->load->view('forbidden',[], true)]);
		}
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
			$this->load->view('template', 
				['body'=>$this->load->view('forbidden',[], true)]);
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
			$this->load->view('template', 
				['body'=>$this->load->view('forbidden',[], true)]);
		}
	}

	public function selectEquipo(){

		$equipos = $this->Deportes->getEquiposByUsuarioId();

		if($equipos!=null){

			$this->load->view('template', 
				['body'=>$this->load->view('selectEquipo',['equipos' => $equipos], true)]);	

		}
		else{
			$this->load->view('template', 
				['body'=>$this->load->view('forbidden',[], true)]);
		}
		
	}

	public function notify(){

		if($this->input->post()){
			$id = $this->input->post();
			$this->Deportes->setNotify($this->input->post('selectDep'));

			$this->load->view('template', 
				['body'=>$this->load->view('completed',[], true)]);

		}
		else{
			redirect('Principal/selectEquipo');
		}
	}


}
