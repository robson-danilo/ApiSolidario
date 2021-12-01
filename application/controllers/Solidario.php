<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solidario extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); //Carrega o helper de url(link)
		$this->load->helper('form'); //Carrega o helper de formul?rio
		$this->load->helper('array'); //Carrega o helper array
		$this->load->helper('encode');
		$this->load->library('session'); //Carrega a biblioteca de sess?o
		$this->load->library('table'); // Carrega a bibioteca de tabela
		$this->load->library('form_validation'); //Carrega a biblioteca de valida??o de formul?rio
		$this->load->model('login_model'); //Carrega o model
		//Limpa o cache, não permitindo ao usuário visualizar nenhuma página logo depois de ter feito logout do sistema
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		header('Access-Control-Allow-Origin: *');
		date_default_timezone_set('America/Recife');	
	}


	public function index()
	{
		print_r("Caiu aqui");

		$retorno = $this->login_model->teste();
		echo json_encode($retorno);



		
	}


	//FUNÇÕES DE CADASTRO

	public function cadastrarInstituicao(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$senha_md5 = md5($this->input->post('senha'));

			$dados = array('nome'=>$this->input->post('nome'),
				'email'=>$this->input->post('email'),
				'cnpj'=>$this->input->post('cnpj'),
				'senha'=>$senha_md5,
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'));

			$retorno = $this->login_model->verificarInstituicaoEinserir($dados);
		}
		echo json_encode($retorno);
	}

	public function cadastrarUsuario(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$senha_md5 = md5($this->input->post('senha'));

			$dados = array('nome'=>$this->input->post('nome'),
				'email'=>$this->input->post('email'),
				'senha'=>$senha_md5);

			$retorno = $this->login_model->verificarUsuarioEinserir($dados);
		}
		echo json_encode($retorno);
	}

	public function cadastrarPrestadorInstituicao(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$senha_md5 = md5($this->input->post('senha'));

			$dados = array('instituicao_id'=>$this->input->post('instituicao_id'),
				'nome'=>$this->input->post('nome'),
				'email'=>$this->input->post('email'),
				'cpf'=>$this->input->post('cpf'),
				'senha'=>$senha_md5);

			$retorno = $this->login_model->verificarPrestadorEinserir($dados);
		}
		echo json_encode($retorno);
	}

	public function enviarPublicacao(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){

			$tipo_usuario = $this->input->post('tipo_usuario_id');
			if ($tipo_usuario == 1){

				$imagemEnviada = null;
				$image = $this->input->post('image');
				if ($image == 'true'){
					$nomeImagem = md5(date('H:i:s', time())).'.png';
					$target_path = "images/";
					$target_path = $target_path.basename($nomeImagem);
					move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
					$imagemEnviada = $nomeImagem;
				}

				$dados_publicacao_instituicao = array('instituicao_id'=>$this->input->post('instituicao_p_id'),
					'instituicao_p_id'=>$this->input->post('instituicao_p_id'),
					'descricao'=>$this->input->post('descricao'),
					'imagem'=>$imagemEnviada,
					'data_inserido'=>date('Y-m-d H:i:s'));

				$retorno = $this->login_model->InserirPublicacao($dados_publicacao_instituicao);
			}else {

				$imagemEnviada = null;
				$image = $this->input->post('image');
				if ($image == 'true'){
					$nomeImagem = md5(date('H:i:s', time())).'.png';
					$target_path = "images/";
					$target_path = $target_path.basename($nomeImagem);
					move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
					$imagemEnviada = $nomeImagem;
				}

				$dados_publicacao_prestador = array('instituicao_id'=>$this->input->post('instituicao_p_id'),
					'prestador_p_id'=>$this->input->post('prestador_p_id'),
					'descricao'=>$this->input->post('descricao'),
					'imagem'=>$imagemEnviada,
					'data_inserido'=>date('Y-m-d H:i:s'));

				$retorno = $this->login_model->InserirPublicacao($dados_publicacao_prestador);
			}
			
		}
		echo json_encode($retorno);
	}

	public function adicionarPrestador(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$dados = array('id_usuario'=>$this->input->post('id_usuario'),
				'id_prestador'=>$this->input->post('id_prestador'));

			$retorno = $this->login_model->verificarPrestadorAdicionado($dados);
		}
		echo json_encode($retorno);
	}

	public function EnviarMensagem(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$tipo_usuario = $this->input->post('tipo_usuario_id');
			if ($tipo_usuario == 2){
				$dados = array('id_enviou'=>$this->input->post('id_prestador'),
					'id_recebeu'=>$this->input->post('id_usuario'),
					'mensagem'=>$this->input->post('mensagem'),
					'data_hora'=>date('Y-m-d H:i:s'),
					'prestador'=> 'T');
			}else if ($tipo_usuario == 3){
				$dados = array('id_enviou'=>$this->input->post('id_usuario'),
					'id_recebeu'=>$this->input->post('id_prestador'),
					'mensagem'=>$this->input->post('mensagem'),
					'data_hora'=>date('Y-m-d H:i:s'),
					'usuario'=> 'T');
			}
			$dados_buscar_mensagem = array('id_usuario'=>$this->input->post('id_usuario'),
				'id_prestador'=>$this->input->post('id_prestador'));
			$retorno = $this->login_model->enviarMensagem($dados);
			if ($retorno == true){
				$retorno = $this->login_model->buscarMensagens($dados_buscar_mensagem);
			}
		}
		echo json_encode($retorno);

	}

	public function enviarCodigoEmail(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$tipo_usuario = $this->input->post('tipo_usuario_id');
			if ($tipo_usuario == 1){//Instituição
				$dados = array('email'=>$this->input->post('email'));
				$retorno = $this->login_model->verificarInstituicaoCadastrada($dados);

				if ($retorno == false){
					$retorno = 'email';
				}else{
					$random = rand(1000000, 9999999);
					$retorno = $random;

					$dadosCodigo = array('email_inst'=>$dados['email'],
						'codigo'=>$random,
						'data'=>date('Y-m-d H:i:s'));

					$this->login_model->salvarCodigoRecuperarSenha($dadosCodigo);
				}

			}else if ($tipo_usuario == 3){//usuario
				$dados = array('email'=>$this->input->post('email'));
				$retorno = $this->login_model->verificarUsuarioCadastrado($dados);

				if ($retorno == false){
					$retorno = 'email';
				}else{
					$random = rand(1000000, 9999999);
					$retorno = $random;

					$dadosCodigo = array('email_user'=>$dados['email'],
						'codigo'=>$random,
						'data'=>date('Y-m-d H:i:s'));

					$this->login_model->salvarCodigoRecuperarSenha($dadosCodigo);
					
				}
			}
			
		}
		echo json_encode($retorno);
	}

	public function enviarEmail(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			
			$dados = array('email'=>$this->input->post('email'),
				'codigo'=>$this->input->post('codigo'));
			$this->EnviarDadosPorEmail($dados['email'], $dados['codigo']);
			//$retorno = true;
		}

		//echo json_encode($retorno);
	}

	


	//FUNÇÕES DE CONSULTA

	public function buscarPublicacoesInstituicoes(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$retorno = $this->login_model->buscarPublicacaoInstituicao($this->input->post('id'));
		}
		echo json_encode($retorno);

	}

	public function buscarPrestadoresInstituicoes(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$retorno = $this->login_model->buscarPrestadoresInstituicao($this->input->post('id'));
		}
		echo json_encode($retorno);
	}

	public function buscarDadosUsuarioInstituicao(){

		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$senha_md5 = md5($this->input->post('senha'));

			$dados = array('email'=>$this->input->post('email'),
				'cnpj'=>$this->input->post('cnpj'),
				'senha'=>$senha_md5);

			$retorno = $this->login_model->verificarInstituicao($dados);
		}
		echo json_encode($retorno);

	}


	public function buscarDadosUsuario(){

		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$senha_md5 = md5($this->input->post('senha'));

			$dados = array('email'=>$this->input->post('email'),
				'senha'=>$senha_md5);

			$retorno = $this->login_model->verificarUsuario($dados);
		}
		echo json_encode($retorno);

	}

	public function buscarDadosUsuarioPrestador(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$senha_md5 = md5($this->input->post('senha'));

			$dados = array('cpf'=>$this->input->post('cpf'),
				'senha'=>$senha_md5);

			$retorno = $this->login_model->verificarPrestador($dados);
		}
		echo json_encode($retorno);
	}

	public function buscarInstituicoes(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){

			$retorno = $this->login_model->buscarInstituicoes();
		}
		echo json_encode($retorno);
	}

	public function buscarInstituicoesEspecifica(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){

			$retorno = $this->login_model->buscarInstituicoesEspecifica($this->input->post('id'));
		}
		echo json_encode($retorno);
	}

	public function buscarConversas(){

		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){

			$dados = array('id_usuario'=>$this->input->post('id_usuario'),
				'id_prestador'=>$this->input->post('id_prestador'),
				'tipo_usuario_id'=>$this->input->post('tipo_usuario_id'));

			$retorno = $this->login_model->buscarMensagens($dados);
		}
		echo json_encode($retorno);

	}

	public function buscarAdicionados(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$tipo_usuario = $this->input->post('tipo_usuario_id');
			if ($tipo_usuario == 2){//prestador
				$dados = array('id_prestador'=>$this->input->post('id_prestador'));
				$retorno = $this->login_model->buscarDadosUsuariosAdicionado($dados);
			}else if ($tipo_usuario == 3){//usuario
				$dados = array('id_usuario'=>$this->input->post('id_usuario'));
				$retorno = $this->login_model->buscarDadosPrestadorAdicionado($dados);
			}
			
		}
		echo json_encode($retorno);
	}


	//Funções de EDIÇÕES

	public function EditarInstituicao(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$dados_instituições = array('nome'=>$this->input->post('nome'),
				'email'=>$this->input->post('email'),
				'id'=>$this->input->post('instituicao_id'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'));

			$retorno = $this->login_model->editarDadosInstituicao($dados_instituições);
			if ($retorno == true){
				$retorno = $this->login_model->buscarInstituicoesEspecifica($dados_instituições['id']);
			}
		}
		echo json_encode($retorno);
	}

	public function EditarPrestador(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$dados_prestador = array('nome'=>$this->input->post('nome'),
				'email'=>$this->input->post('email'),
				'id'=>$this->input->post('prestador_id'),
				'descricao'=>$this->input->post('descricao'));

			$retorno = $this->login_model->editarDadosPrestador($dados_prestador);
			if ($retorno == true){
				$retorno = $this->login_model->buscarPrestadorEspecifico($dados_prestador['id']);
			}
		}
		echo json_encode($retorno);
	}

	public function EditarUsuario(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$dados_usuario = array('nome'=>$this->input->post('nome'),
				'email'=>$this->input->post('email'),
				'id'=>$this->input->post('usuario_id'),
				'descricao'=>$this->input->post('descricao'));

			$retorno = $this->login_model->editarDadosUsuario($dados_usuario);
			if ($retorno == true){
				$retorno = $this->login_model->buscarUsuarioEspecifico($dados_usuario['id']);
			}
		}
		echo json_encode($retorno);
	}

	public function EditarSenha(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){


			$senha_md5 = md5($this->input->post('senha'));
			$tipo_usuario = $this->input->post('tipo_usuario_id');
			if ($tipo_usuario == 1){
				$dados = array('id'=>$this->input->post('instituicao_id'),
					'senha'=>$senha_md5);

				$retorno = $this->login_model->editarSenhaInstituicao($dados);
				if ($retorno){
					$retorno = $this->login_model->buscarInstituicoesEspecifica($dados['id']);
				}
			}else if ($tipo_usuario == 2){
				$dados = array('id'=>$this->input->post('prestador_id'),
					'senha'=>$senha_md5);

				$retorno = $this->login_model->editarSenhaPrestador($dados);
				if ($retorno){
					$retorno = $this->login_model->buscarPrestadorEspecifico($dados['id']);
				}
			}else if ($tipo_usuario == 3){
				$dados = array('id'=>$this->input->post('usuario_id'),
					'senha'=>$senha_md5);

				$retorno = $this->login_model->editarSenhaUsuario($dados);
				if ($retorno){
					$retorno = $this->login_model->buscarUsuarioEspecifico($dados['id']);
				}
			}

			
		}
		echo json_encode($retorno);
	}

	public function mudarStatusPrestador(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$dados_prestador = array('id'=>$this->input->post('id'),
				'ativo'=>$this->input->post('ativo'));

			$retorno = $this->login_model->editarStatusPrestador($dados_prestador);
			if ($retorno == true){
				$retorno = $this->login_model->buscarPrestadoresInstituicao($this->input->post('id_instituicao'));
			}
		}
		echo json_encode($retorno);

	}

	public function atualizarCapa(){
		$retorno = false;
		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$nomeImagem = md5(date('H:i:s', time())).'.png';
			$target_path = "logos/";
			$target_path = $target_path.basename($nomeImagem);
			move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
			$imagemEnviada = $nomeImagem;

			$dados = array('id'=>$this->input->post('id_instituicao'),
				'logo'=>$imagemEnviada);

			$retorno = $this->login_model->salvarNovaFotoCapaInstituicao($dados);

			if ($retorno == true){
				$retorno = $this->login_model->buscarNovasInformaçõesInstituicao($dados);
			}
		}
		echo json_encode($retorno);
	}

	public function excluirPublicacao(){
		$retorno = false;
		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){

			$dados = array('id'=>$this->input->post('id'),
				'instituicao_id'=>$this->input->post('id_instituicao'),
				'ativo'=>'F');

			$retorno = $this->login_model->alterarStatusPublicacao($dados);
		}
		echo json_encode($retorno);
	}

	public function alterarSenhaAutenticaPeloCodigo(){
		$retorno = false;

		if ($this->input->post('token') == '00eac30fb28ecae5fad0469dca969e01b35b47bf'){
			$tipo_usuario = $this->input->post('tipo_usuario_id');
			$senha_md5 = md5($this->input->post('senha'));
			if ($tipo_usuario == 1){//Instituição
				$dados = array('email'=>$this->input->post('email'),
					'senha'=>$senha_md5,
					'tipo'=>$tipo_usuario);

				$dadosCodigo = array('email'=> $dados['email'],
					'ativo'=>'F',
					'data_atualizacao'=>date('Y-m-d H:i:s'),
					'codigo'=>$this->input->post('codigo'),
					'tipo'=>$tipo_usuario);

				$retorno = $this->login_model->desativarCodigo($dadosCodigo);
				if($retorno){
					$retorno = $this->login_model->mudarSenhaRecuperada($dados);
				}
			}else if ($tipo_usuario == 3){//usuario
				$dados = array('email'=>$this->input->post('email'),
					'senha'=>$senha_md5,
					'tipo'=>$tipo_usuario);

				$dadosCodigo = array('email'=> $dados['email'],
					'ativo'=>'F',
					'data_atualizacao'=>date('Y-m-d H:i:s'),
					'codigo'=>$this->input->post('codigo'),
					'tipo'=>$tipo_usuario);

				$retorno = $this->login_model->desativarCodigo($dadosCodigo);
				if($retorno){
					$retorno = $this->login_model->mudarSenhaRecuperada($dados);
				}
			}
			
		}
		echo json_encode($retorno);
	}


	

	public function EnviarDadosPorEmail($email,$codigo)
	{
		$email = $email;
		$mensagem = 'O código para alterar a senha da sua conta é: '.$codigo;


		$this->load->library("phpmailer_lib");
		$mail = $this->phpmailer_lib->load();

		$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'suporterdtech@gmail.com';                 // SMTP username
		$mail->Password = '86617327Da.';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		$mail->setFrom('danilo20riodjx@gmail.com', 'Suporte Solidário');
		$mail->addAddress($email);               // Name is optional

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Segue em Email o código para a troca da senha da sua conta no Aplicativo Solidario';
		$mail->Body    = ''.$mensagem.'<br><br>';
		$mail->send();
	}	
}
