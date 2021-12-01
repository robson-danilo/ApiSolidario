<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		//Limpa o cache, não permitindo ao usuário visualizar nenhuma página logo depois de ter feito logout do sistema
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}


	public function index()
	{
		return false;
		//$this->template->load('template/Template_Base', 'inicio') ;
		//$this->load->view('welcome_message');
	}

	public function EnviarDadosPorEmail()
	{
		$email = 'robson.coelho2021@gmail.com';
		$nome = $this->input->post('nome');
		$emailUsu = $this->input->post('email');
		$telefone = $this->input->post('telefone');
		$mensagem = $this->input->post('mensagem');


		$this->load->library("phpmailer_lib");
		$mail = $this->phpmailer_lib->load();

		$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = '';                 // SMTP username
		$mail->Password = '';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to

		$mail->setFrom('danilo20riodjx@gmail.com', 'Contato Portfolio');
		$mail->addAddress($email);               // Name is optional

		$nomeArquivo = $nome.'_'.date('Ymdhi');
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Segue em Email os dados de contato Portfolio';
		$mail->Body    = '
		Nome: '.$nome.'<br>
		Email: '.$emailUsu.'<br>
		Celular: '.$telefone.'<br><br>
		Mensagem: '.$mensagem.'<br><br>';
		$mail->send();
	
	}
}
