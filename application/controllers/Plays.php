<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plays extends CI_Controller {

    public function index()
	{
        $encuentros = $this->Encuentros->getAllEncuentros();
    }

    public function getEncuentroPorDeporteId($id){

        $encuentros = $this->Encuentros->getEncuentrosPorDeporteId($id);
    }

    public function getEncuentrosPorEquipo($idEquipo){

        $encuentros = $this->Encuentros->getEncuentrosPorEquipo($idEquipo);
        $equipo = $this->Deportes->getEquipoByid($idEquipo);

        $this->load->view('template', 
			['body'=>$this->load->view('encuentrosPorEquipo',['encuentros'=>$encuentros, 'equipo' => $equipo, 'liga' => null], true)]);
    }

    public function getEncuentrosPorLiga($idliga){

        $encuentros = $this->Encuentros->getEncuentrosPorLiga($idliga);
        $liga = $this->Leagues->getLigaFromId($idliga);

        $this->load->view('template', 
			['body'=>$this->load->view('encuentrosPorEquipo',['encuentros'=>$encuentros, 'liga' => $liga], true)]);
    }

    public function modifyEncuentro($idencuentro){

        $encuentro = $this->Deportes->getEncuentroById($idencuentro);
        $mensaje = '';

        if($this->input->post()){

            $this->form_validation->set_rules('resultado', 'Resultado', 'required');
            $this->form_validation->set_rules('resultadoLocal', 'ResultadoLocal', 'required|integer');
            $this->form_validation->set_rules('resultadoVisitante', 'ResultadoVisitante', 'required|integer');
            
            $this->form_validation->set_rules('resultado', 'Resultado', 'required',
                    array('required' => 'Campo requerido'));
            $this->form_validation->set_rules('resultadoLocal', 'ResultadoLocal', 'required|integer',
                    array('required' => 'Campo requerido',
                        'integer' => 'Debe ser numérico'));
            $this->form_validation->set_rules('resultadoVisitante', 'ResultadoVisitante', 'required|integer',
                    array('required' => 'Campo requerido',
                    'integer' => 'Debe ser numérico'));

            if(! ($this->input->post('resultado')===$encuentro->local || $this->input->post('resultado')===$encuentro->visitante)){
                $mensaje = "El equipo ganador será uno de los participantes";
            }
            
            if ($this->form_validation->run() == FALSE || $mensaje != ''){
                
                $this->load->view('template', 
			        ['body'=>$this->load->view('modifyEncuentro',['encuentro'=>$encuentro, 'mensaje' => $mensaje], true)]);
            }
            else{

                $data = $this->input->post();

                if($data['resultadoLocal'] == $data['resultadoVisitante']){
                    $data['resultado'] = "Empate";
                }

                $this->Deportes->modifyEncuentro($idencuentro, $data);
                
                $this->load->view('template', 
                    ['body'=>$this->load->view('completed',[], true)]);
            }
        }

        else{

            $this->load->view('template', 
			    ['body'=>$this->load->view('modifyEncuentro',['encuentro'=>$encuentro, 'mensaje' => ''], true)]);
        }
    }


}