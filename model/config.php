<?php  

	/**
	*	Esse é o arquivo de configuração do projeto.
	*	Nele, estão contidas as variáveis de rotas,
	* 	as funções de erro, e as variáveis de rotas
	*	GLOBAIS.
	*
	*	@author: Anthony Jefferson;
	*	@project: Escola do Poder;	
	*	@package: model/config.php;
	*	@date: Fortaleza, 24 May, 2017
	*
	**/

	# Tratando os erros com as funções do PHP
	ini_set("display_errors", 1);
	error_reporting(E_ALL | E_PARSE);

	/* Configurando as variáveis de rotas */

	# Variável com o nome do projeto
	$project_name = "/prescriptions";

	# Rota com a url do projeto para inclusão de links
	$project_index = "http://".$_SERVER['SERVER_NAME'].$project_name;

	# Rota com a url da raiz do diretórios para inclusão de arquivos.
	$project_path = $_SERVER['DOCUMENT_ROOT'].$project_name;

	/* Configurar as variáveis GLOBAIS de rotas */
	
	# Url Global do projeto
	$GLOBALS['project_index'] = $project_index;

	# Url Global da Raiz
	$GLOBALS['project_path'] = $project_path;
