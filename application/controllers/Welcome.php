<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		//Loads
		$this->load->model('user_model','',TRUE);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		//Get dados
        $this->form_validation->set_rules('usuario', 'Usuario', 'required','Usuario não pode estar em branco');
        $this->form_validation->set_rules('senha', 'Senha', 'required', 'Senha não pode estar em branco');

        //Teste de formulario de login
        if ($this->form_validation->run() == FALSE)
        {
        	//se não está correto, voltar a pagina principal(Login)
            $this->load->view('welcome_principal');
        }
        else
        {
        	//caso as informações estejam corretas, tenta logar
        	$this->_tentaLogar();
        }
	}

	private function _validaDados(){
		$nome = $data_nascimento = $usuario = $senha = null;
		
		$correto = false;
		
		if(!empty($_POST))
			$correto = true;
		//Testar valores passados pelo post, tratar
		//** Aqui
		//**

		$dados = [
		'nome'=>$nome,
		'data_nascimento'=>$data_nascimento,
		'usuario'=>$usuario,
		'senha'=>$senha
		];

		if($correto){
			$this->load->model('user_model','',true);
			if($this->user_model->inserirUsuario($dados)){
				header("Location: /");
			}
		}
		return $dados;
	}

	//VALIDA LOGIN E INICIA SESSÃO
	private function _tentaLogar(){
		//definições
		$uri_home = "/home";
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		$msg_erro = "Usuario ou senha incorretos";

		//Verifica com o banco se bate as informações
		$result = $this->user_model->logar($usuario, $senha);
		
		//Caso sim, inicia a sessão e redireciona
		//Caso não, exibe mensagem de erro de validação, e retorna a pagina de login
		if(isset($result)){
			session_start();
			$_SESSION['usuario'] = $result;
			header("Location: $uri_home");
		}else{
			$dados['erro'] = $msg_erro;
			$this->load->view('welcome_principal', $dados);	
		}
	}
}
