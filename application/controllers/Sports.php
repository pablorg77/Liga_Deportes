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

	public function creaEquipo(){

        $deportes = $this->Deportes->getDeportes();
        $usuarios = $this->Usuario->getAllusuarios();

		if($this->input->post()){

            $this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[equipos.nombre]');
            $this->form_validation->set_rules('origen', 'Origen', 'required');
            
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[equipos.nombre]',
					array('required' => 'Campo requerido', 
						'is_unique[equipos.nombre]' => 'Nombre existente'));
            $this->form_validation->set_rules('origen', 'Origen', 'required',
                    array('required' => 'Campo requerido'));
            
            if ($this->form_validation->run() == FALSE){
                
                $this->load->view('template', 
			        ['body'=>$this->load->view('creaEquipo',['deportes'=>$deportes, 'usuarios' => $usuarios], true)]);
            }
            else{

                $this->Deportes->setEquipo($this->input->post());

                if($this->input->post('usuarios[]') != null){
                    foreach($this->input->post('usuarios[]') as $usuario){
                        $this->Deportes->setUsuarioEnEquipo($usuario);
                    }
                }
                
                $this->load->view('template', 
                    ['body'=>$this->load->view('completed',[], true)]);
            }
        }

        else{

            $this->load->view('template', 
			        ['body'=>$this->load->view('creaEquipo',['deportes'=>$deportes, 'usuarios' => $usuarios], true)]);
        }
    }
	



}
