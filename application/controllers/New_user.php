<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_user extends CI_Controller {
	public function index()
    {
    	$this->load->model('user_model','',TRUE);

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $config = array(
        array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required'
        ),
        array(
                'field' => 'data_nascimento',
                'label' => 'Data de Nascimento',
                'rules' => 'required' //TEM QUE VALIDAR DIREITO
        ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|is_unique[Contatos.email]'
        ),
        array(
                'field' => 'usuario',
                'label' => 'Username',
                'rules' => 'required|min_length[5]|max_length[12]|is_unique[Usuario.usuario]'
        ),
        array(
                'field' => 'senha',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'You must provide a %s.',
                ),
        ),
        array(
                'field' => 'confirm_senha',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[senha]'
        )
	);
		$this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('new_user');
        }
        else
        {
            unset($_POST['confirm_senha']);
            
            $this->user_model->inserirUsuario($_POST);

            header("Location: /");
        }
    }
}