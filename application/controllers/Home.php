<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Trocas - Controlador da Sessão Home
 * Essa classe controla a pagina Privada de cada Usuario
 * @package		Trocas
 * @category	Libraries
 * @author		Rafael de Oliveira
 */
class Home extends CI_Controller {
	/**
	 * Pagina Home Principal
	 * Carrega o index da pagina com suas devidas variaveis já definida
	 * @param	void
	 * @return	void
	 */
	public function index(){
		$this->_logado_ou_sai();

		$dados['usuario'] = $_SESSION['usuario'];

		$this->load->view('home/index', $dados);
	}

	public function cxmsg(){
		$this->_logado_ou_sai();

		$dados['usuario'] = $_SESSION['usuario'];
		
		$mensagens[] = [
			'de'=>'Carol',
			'para'=>'Rafael',
			'hora'=>'13:00, 12/12/2017',
			'mensagem'=>'Boa tarde Rafael, vc tem interesse em trocar seu violão em meu teclado?'
		];
		$mensagens[] = [
			'de'=>'Isabel',
			'para'=>'Rafael',
			'hora'=>'17:56, 15/09/2017',
			'mensagem'=>'Boa tarde Rafael, quer trocar seu violão em minha guitarra?'
		];

		$dados['mensagens'] = $mensagens;

		$this->load->view('home/cxmsg', $dados);

	}
	
	/**
	 * Pagina Home Principal
	 * Carrega o Perfil do Usuario e tambem trata as informações passadas e chama o model para alterar ou remover o registro no banco.
	 * @param	void
	 * @return	void
	 */
	public function perfil(){
		$this->_verificaSessao();

		$this->load->model('user_model','', TRUE);

		$dados['perfil'] = $this->user_model->obter($_SESSION['usuario']['id']);

		if(!empty($_POST) && isset($_POST['delete_user'])){
			$this->_removerPerfil($dados);
		}

		if(!empty($_POST) && isset($_POST['alterar'])){
			$dados['perfil'] = $this->_alterarPerfil($dados['perfil']);
		}
		
		$this->load->view('home/perfil', $dados);
	}

	/**
	 * Pagina Inserção de novo objeto
	 * Carrega a pagina de inserção de objetos, trata a entrada, e insere no banco.
	 * @param	void
	 * @return	void
	 */
	public function newobj(){
		$this->_verificaSessao();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nome', 'Nome', 'required','Nome não pode estar em branco');
        $this->form_validation->set_rules('descricao', 'Descricao', 'required', 'Descrição não pode estar em branco');

		if ($this->form_validation->run() == FALSE)
        {
        	$this->load->view('home/newobj');
        }
        else
        {
			$this->load->model('objeto_model','',true);
			$dados['sucesso'] = $this->_inserirObjeto();
			$this->form_validation->reset_validation();
			$this->load->view('home/newobj', $dados);
        }
	}

	/**
	 * Passa para o model as informações para inserção
	 * Só faz isso
	 * @param	void
	 * @return	void
	 */
	private function _inserirObjeto(){
		unset($_POST['submit']);
		$_POST['usuario'] = $_SESSION['usuario']['id'];
		return $this->objeto_model->inserir($_POST);
	}

	/**
	 * Verifica a sessão
	 * Só faz isso
	 * @param	void
	 * @return	bool
	 */
	private function _verificaSessao(){
		session_start();
		if(!isset($_SESSION['usuario']))
			return false;
		else
			return true;
	}

	/**
	 * Ver se está logado, caso não esteja, sai, caso esteja retorna
	 * Só faz isso
	 * @param	void
	 * @return	bool
	 */
	private function _logado_ou_sai(){
		if($this->_verificaSessao())
			return;
		else
			header("Location: /");
	}

	/**
	 * Passa para o model as informações para remoção de usuario
	 * Somente isso
	 * @param	array $dados Dados do Usuario
	 * @return	void
	 */
	private function _removerPerfil($dados){
		$chaves = [
			'usuario'=>$dados['perfil']['idUsuario'],
			'contatos'=>$dados['perfil']['contatos']['idContatos'],
			'redes_sociais'=>$dados['perfil']['contatos']['redes_sociais']['idRedesSociais'],
			'endereco'=>$dados['perfil']['endereco']['idendereco']
			];
			$this->user_model->_removerUser($chaves);			
			unset($_SESSION);
			header("Location: /");
	}

	/**
	 * Passa informações para o model Alterar informações de Usuario
	 * @param	array $dados Dados do Usuario
	 * @return	array $usuario Novo array com informações atualizadas
	 */
	private function _alterarPerfil($dados){
		$usuario = ['nome'=>$_SESSION['usuario']['nome']];
		$endereco = ['estado'=>$_POST['estado'], 'cidade'=>$_POST['cidade'], 'bairro'=>$_POST['bairro'], 'rua'=>$_POST['rua'], 'complemento'=>$_POST['complemento']];
		$contatos = ['email'=>$_POST['email'], 'telefone1'=>$_POST['telefone1']];
		$redesSociais = ['facebook'=>$_POST['facebook'], 'instagram'=>$_POST['instagram'], 'outras1'=>$_POST['rs_outra']];
		
		$this->user_model->_alterEndereco($dados['endereco']['idendereco'], $endereco);
		$this->user_model->_alterContatos($dados['contatos']['idContatos'], $contatos);
		$this->user_model->_alterRedesSociais($dados['contatos']['redes_sociais']['idRedesSociais'], $redesSociais);

		$usuario['endereco'] = $endereco;
		$contatos['redes_sociais'] = $redesSociais;
		$usuario['contatos'] = $contatos;
		return $usuario;
	}
}