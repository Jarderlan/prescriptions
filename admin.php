<?php  
	
	# Incluindo o arquivo de Rotas
	include_once 'model/config.php';

	# Incluindo o arquivo de dicionario
	include_once 'model/dictionary.php';

	# Incluindo o arquivo de validacoes
	include_once 'controller/validate.php';	

	# Incluindo o arquivo modelo de User
	include_once 'model/class/User.class.php';

	//iniciar a sessao
	session_start();

	//testa se ja existe usuario logado
	if(isset($_SESSION[md5('us_inventory')])){		
		//recupera os dados do usuário
		$user = $_SESSION[md5('us_inventory')];

		//testa se é admin
		if($user->user_profile != "admin"){
			header("location: $project_index?error=permission_denied");
		}
	}else{
		header("location: $project_index?error=permission_denied");
	}

	//titulo da página
	$page_title = "Página do Administrador";

	//Titulo do Painel de Controle
	if(isset($_GET['content'])){
		$content_title = "Painel de ".$_GET['content'];
	}else{
		
		$content_title = "Este é o seu Sistema";

	}

	function page_content(){
		# Chamando a função das mensagens
		//validate_message();

		# Chamando a função foderosamente foderosa para validar os options
		if(validate_option() === false){
			include_once "view/welcome.html";
		}
		
	}

	//incluindo template
	include_once 'view/template.html';
