<?php	
	
	#Incluindo os arquivos necessários
	include_once dirname(__DIR__).'/model/config.php';
	include_once $project_path."/model/class/Connect.class.php";
	include_once $project_path."/model/class/Manager.class.php";
	include_once $project_path."/model/class/User.class.php";
	
	# Iniciando o serviço de sessão
	session_start();

	# Testando se existe alguem logado
	if(!isset($_SESSION[md5('us_inventory')])){
		header("location: $project_index?error=access_denied");
	}	

	# Salvando os dados da sessão no objeto User
	$user = $_SESSION[md5('us_inventory')];

	# Testando os dados do formulário - PADRÃO: Comentado
	//var_dump($_POST);

	# Receber os dados do post
	$new_data = $_POST;

	# Criar o objeto do tipo Manager
	$manager = new Manager();

	# Filtro
	$filter['id_patient'] = $_POST['id_patient'];

	# Atualizando os dados no banco
	$manager->update_common("tb_patient",$new_data,$filter,null);

	# Redirecionamento
	header("location: $project_index/".$user->user_profile.".php?option=list_patients&success=patient_updated&content=Usuários");