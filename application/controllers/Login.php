<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Emailme');
        require 'vendor/autoload.php';
    }

    public function index(){

        if($this->input->post()){
            if($this->Usuario->login($this->input->post('usuario'),$this->input->post('pass'))){
                redirect('Principal');
            }
            else{ 
                $this->load->view('template',[
                    'body'=>$this->load->view('index', [], true)]);
            }
        }
        else{
            $this->load->view('template',[
                'body'=>$this->load->view('index', [], true)]);
        }
    }

    public function solicitud(){

        $this->load->library('cart');

        $this->form_validation->set_rules('dni', 'Dni', 'trim|required|exact_length[9]|callback_validadni_check');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required');
        $this->form_validation->set_rules('residencia', 'Residencia', 'required');

        $this->form_validation->set_rules('dni', 'Dni', 'trim|required|exact_length[9]|callback_validadni_check',
                array('required' => 'Campo requerido', 
                'exact_length[9]' => 'Debe contener 9 carácteres'));
        $this->form_validation->set_rules('telefono', 'Telefono', 'required',
                array('required' => 'Campo requerido'));
        $this->form_validation->set_rules('residencia', 'Residencia', 'required',
                array('required' => 'Campo requerido'));

        
        if ($this->form_validation->run() == FALSE){
            $this->load->view('template',
                ['body'=>$this->load->view('solicitud',[],true)]);
        }
        else{


            /*$this->load->view('template',
                ['body'=>$this->load->view('index',[],true)]);

                if($this->session->has_userdata('solicitudes')){

                }*/
        }

    }

    public function register(){

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user', 'user', 'required');
        $this->form_validation->set_rules('pass', 'pass', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',
                array('required' => 'Campo requerido', 
                'valid_email' => 'Formato incorrecto'));
        $this->form_validation->set_rules('user', 'user', 'required',
                array('required' => 'Campo requerido'));
        $this->form_validation->set_rules('pass', 'pass', 'trim|required|min_length[6]',
                array('required' => 'Campo requerido', 
                'min_length[6]' => 'Longitud mínima de 6 caracteres'));
        $this->form_validation->set_rules('nombre', 'Nombre', 'required',
                array('required' => 'Campo requerido'));
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required',
                array('required' => 'Campo requerido'));     

        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('template',
                ['body'=>$this->load->view('register',[],true)]);
            }
            else
            {
                $this->load->view('template',
                ['body'=>$this->load->view('index',[],true)]);

                $this->Usuario->setRegistro($this->input->post());
            }
    }

    public function logOut(){

        $this->Usuario->logOut();
        redirect('Principal');
    }

    public function validadni_check($dni){

        $letra = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
        $num=intval(substr($dni,0,-1)) % 23;
        $letraDNI=$letra[$num];
    
        if (substr($dni,-1)===$letraDNI)
            return true;
        else {   
            $this->form_validation->set_message('validadni_check', 'El dni no es correcto');
            return false;
        }
      }
      
}