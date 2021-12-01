<?php
class Login_model extends CI_Model
{

	//Trata os caracteres para utf-8, tanto os de entrada como os de sa�da de dados.
	

	public function verificarInstituicaoEinserir($dados){
		//$this->db->trans_start(); //inicio transação

		$this->db->select('id');
		$this->db->from('instituicao');
		$this->db->where('email', $dados['email']);
		$email = $this->db->get()->row_array();
		$verificarEmail = (is_array($email) ? count($email) : 0);
		if ($verificarEmail > 0){
			return 'email';
		}else {
			$this->db->select('id');
			$this->db->from('instituicao');
			$this->db->where('cnpj', $dados['cnpj']);
			$cnpj = $this->db->get()->row_array();
			$verificarCNPJ = (is_array($cnpj) ? count($cnpj) : 0);
			if ($verificarCNPJ > 0){
				return 'cnpj';
			}else {
				$this->db->insert('instituicao', $dados);
				$id_instituicao = $this->db->insert_id();

				$this->db->select('id as id_instituicao, nome as nome_instituicao, latitude, longitude, logo as logo_instituicao, ativo');
				$this->db->from('instituicao');
				$this->db->where('id', $id_instituicao);
				return $this->db->get()->row_array();
				
			}
		}
		//return $this->db->trans_complete(); //fim transação
	}

	public function verificarUsuarioEinserir($dados){
		//$this->db->trans_start(); //inicio transação

		$this->db->select('id');
		$this->db->from('usuario');
		$this->db->where('email', $dados['email']);
		$email = $this->db->get()->row_array();
		$verificarEmail = (is_array($email) ? count($email) : 0);
		if ($verificarEmail > 0){
			return 'email';
		}else {
			$this->db->insert('usuario', $dados);
			$id_usuario = $this->db->insert_id();

			$this->db->select('id as id_usuario, email as email_usuario, ativo, descricao, nome');
			$this->db->from('usuario');
			$this->db->where('id', $id_usuario);
			return $this->db->get()->row_array();
		}
		//return $this->db->trans_complete(); //fim transação
	}	

	public function verificarPrestadorEinserir($dados){
		$this->db->select('id');
		$this->db->from('prestador');
		$this->db->where('email', $dados['email']);
		$email = $this->db->get()->row_array();
		$verificarEmail = (is_array($email) ? count($email) : 0);
		if ($verificarEmail > 0){
			return 'E-mail';
		}else {
			//return 'CPF';
			$this->db->select('id');
			$this->db->from('prestador');
			$this->db->where('cpf', $dados['cpf']);
			$cpf = $this->db->get()->row_array();
			$verificarCpf = (is_array($cpf) ? count($cpf) : 0);
			if ($verificarCpf > 0){
				return 'CPF';
			}else{
				return $this->db->insert('prestador', $dados);
			}
		}
	}

	public function buscarPublicacaoInstituicao($id){
		$this->db->select("publicacao.*, date_format(publicacao.data_inserido, '%d/%m/%Y %H:%i') AS data_inserido, instituicao.logo as logo_instituiao, instituicao.nome as nome_instituicao, prestador.nome as nome_prestador");
		$this->db->from('publicacao');
		$this->db->join('instituicao', 'instituicao.id = publicacao.instituicao_p_id', 'left');
		$this->db->join('prestador', 'prestador.id = publicacao.prestador_p_id', 'left');
		$this->db->where('publicacao.instituicao_id', $id);
		$this->db->where('publicacao.ativo', 'T');
		$this->db->order_by('publicacao.data_inserido', 'DESC');
		return $this->db->get()->result_array();
	}

	public function buscarPrestadoresInstituicao($id){
		$this->db->select('prestador.*');
		$this->db->from('prestador');
		$this->db->join('instituicao', 'instituicao.id = prestador.instituicao_id', 'left');
		$this->db->where('prestador.instituicao_id', $id);
		$this->db->order_by('prestador.nome', 'ASC');
		return $this->db->get()->result_array();
	}


	public function verificarInstituicao($dados){
		$this->db->select('id as id_instituicao, nome as nome_instituicao, latitude, longitude, logo as logo_instituicao, ativo, cnpj, email');
		$this->db->from('instituicao');
		$this->db->where('email', $dados['email']);
		$this->db->where('cnpj', $dados['cnpj']);
		$this->db->where('senha', $dados['senha']);
		$this->db->where('ativo', 'T');
		return $this->db->get()->row_array();
	}

	public function verificarUsuario($dados){
		$this->db->select('id as id_usuario, email as email_usuario, ativo, descricao, nome');
		$this->db->from('usuario');
		$this->db->where('email', $dados['email']);
		$this->db->where('senha', $dados['senha']);
		$this->db->where('ativo', 'T');
		return $this->db->get()->row_array();
	}


	public function buscarInstituicoes(){
		$this->db->select('latitude, longitude, id as id_instituicao, nome as nome_instituicao, logo');
		$this->db->from('instituicao');
		return $this->db->get()->result_array();
	}
	public function buscarInstituicoesEspecifica($id){
		$this->db->select('id as id_instituicao, nome as nome_instituicao, latitude, longitude, logo as logo_instituicao, ativo, cnpj, email');
		$this->db->from('instituicao');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}


	public function verificarPrestador($dados){
		$this->db->select('prestador.id as id_prestador, prestador.instituicao_id as id_instituicao, prestador.nome as nome_prestador, prestador.descricao, prestador.ativo, prestador.email, prestador.cpf, instituicao.nome as nome_instituicao, instituicao.logo as logo_instituicao, prestador.descricao');
		$this->db->from('prestador');
		$this->db->join('instituicao', 'instituicao.id = prestador.instituicao_id', 'left');
		$this->db->where('prestador.cpf', $dados['cpf']);
		$this->db->where('prestador.senha', $dados['senha']);
		$this->db->where('prestador.ativo', 'T');
		return $this->db->get()->row_array();
	}

	public function InserirPublicacao($dados){
		return $this->db->insert('publicacao', $dados);
	}

	public function editarDadosInstituicao($dados){
		$this->db->select('id');
		$this->db->from('instituicao');
		$this->db->where('email', $dados['email']);
		$this->db->where('id != ', $dados['id']);
		$email = $this->db->get()->row_array();
		$verificarEmail = (is_array($email) ? count($email) : 0);
		if ($verificarEmail > 0){
			return false;
		}else {
			$this->db->where('id', $dados['id']);
			return $this->db->update('instituicao', $dados);
		}
		
	}

	public function editarDadosPrestador($dados){
		$this->db->select('id');
		$this->db->from('prestador');
		$this->db->where('email', $dados['email']);
		$this->db->where('id != ', $dados['id']);
		$email = $this->db->get()->row_array();
		$verificarEmail = (is_array($email) ? count($email) : 0);
		if ($verificarEmail > 0){
			return false;
		}else {
			$this->db->where('id', $dados['id']);
			return $this->db->update('prestador', $dados);
		}
		
	}

	public function editarDadosUsuario($dados){
		$this->db->select('id');
		$this->db->from('usuario');
		$this->db->where('email', $dados['email']);
		$this->db->where('id != ', $dados['id']);
		$email = $this->db->get()->row_array();
		$verificarEmail = (is_array($email) ? count($email) : 0);
		if ($verificarEmail > 0){
			return false;
		}else {
			$this->db->where('id', $dados['id']);
			return $this->db->update('usuario', $dados);
		}
		
	}


	public function editarSenhaInstituicao($dados){
		$this->db->where('id', $dados['id']);
		return $this->db->update('instituicao', $dados);
	}

	public function editarSenhaPrestador($dados){
		$this->db->where('id', $dados['id']);
		return $this->db->update('prestador', $dados);
	}

	public function editarSenhaUsuario($dados){
		$this->db->where('id', $dados['id']);
		return $this->db->update('usuario', $dados);
	}

	
	public function buscarPrestadorEspecifico($id){
		$this->db->select('prestador.id as id_prestador, prestador.instituicao_id as id_instituicao, prestador.nome as nome_prestador, prestador.descricao, prestador.ativo, prestador.email, prestador.cpf, instituicao.nome as nome_instituicao, instituicao.logo as logo_instituicao, prestador.descricao');
		$this->db->from('prestador');
		$this->db->join('instituicao', 'instituicao.id = prestador.instituicao_id', 'left');
		$this->db->where('prestador.id', $id);
		return $this->db->get()->row_array();
	}

	public function buscarUsuarioEspecifico($id){
		$this->db->select('id as id_usuario, email as email_usuario, ativo, descricao, nome');
		$this->db->from('usuario');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	public function editarStatusPrestador($dados){
		$this->db->where('id', $dados['id']);
		return $this->db->update('prestador', $dados);
	}

	public function verificarPrestadorAdicionado($dados){
		$this->db->select('id');
		$this->db->from('adicionados');
		$this->db->where('id_usuario', $dados['id_usuario']);
		$this->db->where('id_prestador', $dados['id_prestador']);
		$verificar = $this->db->get()->row_array();
		$verificarAdicionado = (is_array($verificar) ? count($verificar) : 0);
		if ($verificarAdicionado > 0){
			return true;
		}else {
			return $this->db->insert('adicionados', $dados);
		}
	}

	public function buscarMensagens($dados){
		$this->db->select('*');
		$this->db->from('conversa');
		$this->db->where('id_enviou', $dados['id_usuario']);
		$this->db->where('id_recebeu', $dados['id_prestador']);
		$this->db->where('usuario', 'T');
		$this->db->where('prestador', 'F');
		$this->db->or_where('id_enviou', $dados['id_prestador']);
		$this->db->where('id_recebeu', $dados['id_usuario']);
		$this->db->where('usuario', 'F');
		$this->db->where('prestador', 'T');
		$this->db->order_by('data_hora', 'ASC');
		return $this->db->get()->result_array();
	}

	public function enviarMensagem($dados){
		return $this->db->insert('conversa', $dados);
	}

	public function buscarDadosPrestadorAdicionado($dados){
		$this->db->select('prestador.id as id_prestador, prestador.nome as nome_prestador, prestador.descricao as descricao_prestador, instituicao.id as id_instituicao, instituicao.nome as nome_instituicao');
		$this->db->from('adicionados');
		$this->db->join('prestador', 'prestador.id = adicionados.id_prestador');
		$this->db->join('instituicao', 'instituicao.id = prestador.instituicao_id');
		$this->db->where('adicionados.id_usuario', $dados['id_usuario']);
		return $this->db->get()->result_array();
	}

	public function buscarDadosUsuariosAdicionado($dados){
		$this->db->select('usuario.id as id_usuario, usuario.nome as nome_usuario, usuario.descricao as descricao_usuario');
		$this->db->from('adicionados');
		$this->db->join('usuario', 'usuario.id = adicionados.id_usuario');
		$this->db->where('usuario.ativo', 'T');
		$this->db->where('adicionados.id_prestador', $dados['id_prestador']);
		return $this->db->get()->result_array();
	}


	public function salvarNovaFotoCapaInstituicao($dados){
		$this->db->where('id', $dados['id']);
		return $this->db->update('instituicao', $dados);
	} 

	public function buscarNovasInformaçõesInstituicao($dados){
		$this->db->select('id as id_instituicao, nome as nome_instituicao, latitude, longitude, logo as logo_instituicao, ativo, cnpj, email');
		$this->db->from('instituicao');
		$this->db->where('id', $dados['id']);
		return $this->db->get()->row_array();
	}

	public function alterarStatusPublicacao($dados){
		$this->db->where('id', $dados['id']);
		$this->db->where('instituicao_id', $dados['instituicao_id']);
		return $this->db->update('publicacao', $dados);
	}

	public function verificarInstituicaoCadastrada($dados){
		//$this->db->trans_start(); //inicio transação

		$this->db->select('id');
		$this->db->from('instituicao');
		$this->db->where('email', $dados['email']);
		$id = $this->db->get()->row_array();
		if ($id != null){
			return true;
		}else {
			return false;
		}
		//return $this->db->trans_complete(); //fim transação
	}

	public function verificarUsuarioCadastrado($dados){
		//$this->db->trans_start(); //inicio transação

		$this->db->select('id');
		$this->db->from('usuario');
		$this->db->where('email', $dados['email']);
		$id = $this->db->get()->row_array();
		if ($id != null){
			return true;
		}else {
			return false;
		}
		//return $this->db->trans_complete(); //fim transação
	}

	public function salvarCodigoRecuperarSenha($dados){
		return $this->db->insert('codigo', $dados);
	}

	public function desativarCodigo($dados=null){
		$this->db->set('ativo', $dados['ativo']);
		$this->db->set('data_atualizacao', $dados['data_atualizacao']);
		$this->db->where('codigo', $dados['codigo']);
		if($dados['tipo'] == 1){
			$this->db->where('email_inst', $dados['email']);
		}else{
			$this->db->where('email_user', $dados['email']);
		}
		return $this->db->update('codigo');
	}

	public function mudarSenhaRecuperada($dadosMudarSenha=null){
		if($dadosMudarSenha['tipo'] == 1){
			$this->db->set('senha', $dadosMudarSenha['senha']);
			$this->db->where('email', $dadosMudarSenha['email']);
			return $this->db->update('instituicao');
		}else{
			$this->db->set('senha', $dadosMudarSenha['senha']);
			$this->db->where('email', $dadosMudarSenha['email']);
			return $this->db->update('usuario');
		}
		
	}


}