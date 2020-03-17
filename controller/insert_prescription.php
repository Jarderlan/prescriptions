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

	# Guardando os dados do cadastro no array Data
	$data = $_POST;

	# Criptografando a senha
	//$data['user_password'] = sha1($data['user_password']);

	# Criando o obejto do tipo Manager
	$manager = new Manager();

	# Inserindo no banco através do método INSERT
	$manager->insert_common("tb_prescription",$data,null);



		$option  = "?option=show_patient";
		$content = "Pacientes";
		$success = "insert_prescription";
		$filter = $_POST['patient_id'];


	# Redireciona para a lista
	header("location: $project_index/".$user->user_profile.".php".$option."&success=".$success."&content=".$content."&filter=".$filter);


?>