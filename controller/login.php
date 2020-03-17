<?php
	
	# Incluindo o arquivo de Rotas
	include_once dirname(__DIR__).'/model/config.php';

	# Incluindo as classes necessárias
	include_once $project_path.'/model/class/Connect.class.php';
	include_once $project_path.'/model/class/Manager.class.php';
	include_once $project_path.'/model/class/User.class.php';

	# Recebendo os dados do formulário
	$email = $_POST['email'];
	$password = sha1($_POST['password']);


	# Criando o objeto gerenciador do banco
	$manager = new Manager();

	##########################################
	# Preparando a busca do usuário no banco #
	##########################################

	//Tabelas a serem buscadas
	$tables['tb_users'] = array(); //todas as colunas

	//Filtro da Busca
	$filters['tb_users.user_email'] = $email;

	# Realizando a consulta no banco
	$log = $manager->select_special($tables,null,$filters," LIMIT 1");

	# Realizamos testes de login
	
	//testando
	if($log === false){
		header("location: $project_index/?error=user_not_found");
	}elseif($log[0]['user_password'] != $password){
		# Se o usuário errou a senha ele manda pro index com o erro de aviso de senha!	
		header("location: $project_index/?error=password_incorrect");
	}else{

		# Se chegou aqui, os dados do formulário estão corretos.
				
		# Removendo a senha para que ela não fique salva na sessão e nem no objeto.
		unset($log[0]['user_password']);

		# Criando o objeto com os dados do usuário cadastrados no banco de dados.
		$user = new User($log[0]['user_name'], $log[0]['user_email']);

		# Colocando os dados do usuario dentro do objeto pelo foreach! Esse método só é possivel devido o método mágico __set da classe User
		foreach ($log[0] as $k => $v) {
			$user->$k = $v;
		}

		# Inicia-se o serviço de sessão
		session_start();

		# Salvamos os dados do objeto dentro da sessao.
		$_SESSION[md5('us_inventory')] = $user;

		# Redirecionamos para o index
		header("location: $project_index");
		
	}//fecha o else

	