<?php  
	
	# Incluindo o arquivo de Rotas e Configurações
	include_once dirname(__DIR__)."/model/config.php";
	
	# Iniciando o serviço de Sessão	
	session_start();

	# Destruindo a(s) sessão(oẽs) ativa(s)
	session_destroy();

	# Redirecionando para o index
	header("location: $project_index?success=session_ending");


?>