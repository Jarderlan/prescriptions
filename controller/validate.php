<?php

	//validação de mensagens na tela.
	function validate_message(){
		//caso haja mensagem a ser mostrada, mostre-as.
		if(isset($_GET['error'])){
			@$alert_msg = $GLOBALS['dictionary'][$_GET['error']];
			$alert_icon = "warning-sign";
			$alert_class = "danger";
		}elseif(isset($_GET['success'])){
			@$alert_msg = $GLOBALS['dictionary'][$_GET['success']];
			$alert_icon = "ok-circle";
			$alert_class = "success";
		}else{
			return false;
		}

		//renderizando alert
		include_once $GLOBALS['project_path'].'/view/alert.html';
	}

	# Essa função é responsável por validar as opçoes do menu e das ações no perfil e, através dessas ações, realizar consultas e alterações no banco de dados
	function validate_option(){
		//testa se existe pedido de option
		if(!isset($_GET['option'])){
			return false;
		}

		# Globalizando o objeto Usuário
		global $user;

		# Incluindo as classes necessárias
		include_once $GLOBALS['project_path']."/model/class/Connect.class.php";

		include_once $GLOBALS['project_path']."/model/class/Manager.class.php";

		# Switch que verifica qual opção está selecionada no momento
		switch($_GET['option']){
			#######################################
			########## CRUD DOS USUÁRIOS ##########
			#######################################
			case 'list_users':

				# Testando se existe user logado e se é admin
				if(!isset($user) || $user->user_profile != "admin"){
					return false;
				}	

				# Cria o objeto do tipo Manager
				$manager = new Manager();

				# Realizando a busca no banco com o método select_common
				$table_content = $manager->select_common('tb_users', null, null, null);

				# Setando os campos na tabela e modificando os títulos originais. Ex: user_name => Nome
				$table_titles["user_name"] = "Nome";
				$table_titles["user_email"] = "Email";
				$table_titles["user_occupation"] = "Profissão";
				$table_titles["user_profile"] = "Perfil";

				# Ações que o usuário pode fazer
				$update = true;
				$delete = true;

				# Caminho das ações
				$update_destiny = "?option=update_user&content=Modificação de Usuário";
				$delete_destiny = "controller/delete_user.php";

				# Filtro que as ações usarão
				$filter = "id_user";

				# Chamando o arquivo que gera a tabela
				include_once $GLOBALS['project_path']."/view/list_common.html";

				# Botão para inserir um user
				echo '<hr>
					<a href="?option=insert_user&content=Inserção de Usuário" class="btn btn-primary">';
				echo '<span class="fa fa-plus"></span>';
				echo ' Novo Usuário</a><br>';

			break;

			case 'insert_user':

				$manager = new Manager();

				$profiles = $manager->select_common("tb_users",null,null,null);

				# Incluindo o formulário de inserção de user
				include_once $GLOBALS['project_path']."/view/forms/insert_user.html";

			break;

			case 'update_user':
				# Criando o objeto do tipo Manager
				$manager = new Manager();

				# Capturando o id do user a ser modificado
				$filter['id_user'] = $_GET['filter'];

				# Chamar os dados do usuário
				$user_r = $manager->select_common("tb_users",null,$filter,null);

				# Rerirar uma camada do array
				$user_r = $user_r[0];

				# Incluir o formulário de modificação
				include_once $GLOBALS['project_path']."/view/forms/update_user.html";	
			break;

			########################################
			############### Pacientes ##############
			########################################
			case 'list_patients':

				# Testando se existe user logado e se é admin
				if(!isset($user) || $user->user_profile != "admin"){
					return false;
				}	

				# Cria o objeto do tipo Manager
				$manager = new Manager();
				
				//$filter['profile_id'] = 2;
				# Realizando a busca no banco com o método select_special
				$table_content = $manager->select_common("tb_patient", null, null, null);

				# Setando os campos na tabela e modificando os títulos originais. Ex: user_name => Nome
				$table_titles['patient_name'] = "Nome do Paciente";
				$table_titles['patient_contact'] = "Contato";
				$table_titles['patient_address'] = "Endereço";
				$table_titles['patient_city'] = "Cidade";
				$table_titles['patient_cpf'] = "CPF";
				
				# Ações que o usuário pode fazer
				$update = true;
				$delete = true;
				$show = true;

				# Caminho das ações
				$show_destiny = "?option=show_patient&content=Dados Paciente";
				$update_destiny = "?option=update_patient&content=Edição Paciente";
				$delete_destiny = "controller/delete_patient.php";

				# Filtro que as ações usarão
				$filter = "id_patient";

				# Chamando o arquivo que gera a tabela
				include_once $GLOBALS['project_path']."/view/list_common.html";

				# Botão para inserir um course
				echo '<hr>
					<a href="?option=insert_patient&content=Inserção de Paciente" class="btn btn-primary">';
				echo '<span class="fa fa-id-badge"></span>';
				echo ' Novo Paciente</a><br><br>';

			break;

			case 'show_patient':
				# Criando o objeto do tipo Manager
				$manager = new Manager();

				# Capturando o id do user
				$filter['id_patient'] = $_GET['filter'];

				# Chamar os dados do usuário
				$show_r= $manager->select_common("tb_patient",null,$filter,null);

				# Rerirar uma camada do array
				$show_r = $show_r[0];

				#Consulta Receitas dos Pacientes
				# Tabelas
				$tables['tb_patient'] = array();
				$tables['tb_prescription'] = array();

				$filters['tb_prescription.patient_id'] = $filter['id_patient']; 

				# Relacionamentos
				$rels['tb_patient.id_patient'] ="tb_prescription.patient_id";

				$table_content = $manager->select_special($tables, $rels, $filters, null);

				#Olho Direito
				$table_titles['prescription_re_esf'] = "Esf. OD";
				$table_titles['prescription_re_cil'] = "Cil. OD";
				$table_titles['prescription_re_eixo'] = "Eixo. OD";
				//$table_titles['prescription_re_dp'] = "DP. OD";
				
				#Olho Esquerdo
				$table_titles['prescription_le_esf'] = "Esf. OE";
				$table_titles['prescription_le_cil'] = "Cil. OE";
				$table_titles['prescription_le_eixo'] = "Eixo. OE";
				//$table_titles['prescription_le_dp'] = "DP. OE";
				
				#Adição
				$table_titles['prescription_addition'] = "AD";
				$table_titles['prescription_date'] = "Data do Exame";
				
				#Botoes
				$print = true;
				$show = true;

				#Destino dos Botoes
				$print_destiny = $GLOBALS['project_index']."/model/print_prescription.php";
				$show_destiny = "?option=show_prescription&content=Dados da Receita";

				# Incluir o formulário de modificação
				include_once $GLOBALS['project_path']."/view/forms/show_patient.html";
			break;

			case 'show_prescription':
				#Iniciando o Objeto Manager
				$manager = new Manager();

				#Filtrando o Usuario
				$filter['id_patient']= $_GET['filter'];

				#Consulta Tabela Pacientes
				$show_r = $manager->select_common("tb_patient",null,$filter,null);

				$show_r = $show_r[0];

				#Filtro Receita
				$prescription_id['id_prescription'] = $_GET['prescription'];

				#Consulta Receita
				$prescription_r = $manager->select_common("tb_prescription", null, $prescription_id, null);

				$prescription_r = $prescription_r[0];

				include_once $GLOBALS['project_path']."/view/forms/show_prescription.html";
			break;

			case 'insert_patient':
				include_once $GLOBALS['project_path']."/view/forms/insert_patient.html";
			break;

			case 'update_patient':
				# Criando o objeto do tipo Manager
				$manager = new Manager();

				# Capturando o id do user a ser modificado
				$filter['id_patient'] = $_GET['filter'];

				# Chamar os dados do usuário
				$patient_r= $manager->select_common("tb_patient",null,$filter,null);

				# Rerirar uma camada do array
				$patient_r = $patient_r[0];

				# Incluir o formulário de modificação
				include_once $GLOBALS['project_path']."/view/forms/update_patient.html";	
			break;

			##########################################
			########## Insert Prescription ###########
			##########################################

			case 'insert_prescription':
				$manager = new Manager();

				$filter['id_patient']= $_GET['filter'];

				$show_r = $manager->select_common("tb_patient",null,$filter,null);

				$show_r = $show_r[0];

				# Incluir Formulario de Inserção
				include_once $GLOBALS['project_path']."/view/forms/insert_prescription.html";
			break;

			#####################################
			############## ALUNOS ###############
			#####################################
			case 'list_students':

				# Testando se existe user logado e se é admin
				if(!isset($user) || $user->profile_page != "admin"){
					return false;
				}	

				# Cria o objeto do tipo Manager
				$manager = new Manager();
				
				$filter['profile_id'] = 3;
				# Realizando a busca no banco com o método select_special
				$table_content = $manager->select_common("tb_users", null, $filter, null);

				# Setando os campos na tabela e modificando os títulos originais. Ex: user_name => Nome
				$table_titles['user_name'] = "Nome do Aluno";
				$table_titles['user_email'] = "Email do Aluno";
				$table_titles['user_phone'] = "Contato";
				$table_titles['user_address'] = "Endereço";
				

				# Ações que o usuário pode fazer
				$update = true;
				$delete = true;

				# Caminho das ações
				$update_destiny = "?option=update_user&content=Modificação de Aluno";
				$delete_destiny = "controller/delete_user.php";

				# Filtro que as ações usarão
				$filter = "id_user";

				# Chamando o arquivo que gera a tabela
				include_once $GLOBALS['project_path']."/view/list_common.html";

				# Botão para inserir um course
				echo '<hr>
					<a href="?option=insert_student&content=Inserção de Professor" class="btn btn-primary">';
				echo '<span class="fa fa-university"></span>';
				echo ' Novo Aluno</a><br>';

			break;

			case 'insert_student':
				include_once $GLOBALS['project_path']."/view/forms/insert_student.html";
			break;

			############################################
			############### TURMAS #####################
			############################################
			case 'list_classes':
				# Criando objeto do tipo Manager
				$manager = new Manager();

				# Tabelas
				$tables['tb_users'] = array();
				$tables['tb_courses'] = array();
				$tables['tb_profiles'] = array();
				$tables['tb_classes'] = array();

				# Relacionamentos
				$rels['tb_classes.user_id'] ="tb_users.id_user";
				$rels['tb_classes.course_id'] ="tb_courses.id_course";
				$rels['tb_users.profile_id'] ="tb_profiles.id_profile";

				# Filtro (id do professor)
				$filters['id_profile'] = 2;

				# Chamando a função select_special
				$table_content = $manager->select_special($tables, $rels, $filters, null);

				$table_titles['course_name'] = "Nome do Curso";
				$table_titles['user_name'] = "Nome do Professor";
				$table_titles['course_hour'] = "Horários";

				# Ações
				$update = true;
				$delete = true;
				$print = true;

				# Caminho das açõeas
				$update_destiny = "";
				$delete_destiny = "";
				$print_destiny = "model/classes_report.php";

				#filter
				$filter = "id_class";

				# Renderizando a tabela
				include_once $GLOBALS['project_path']."/view/list_common.html";

				# Botão para inserir uma turma
				echo '<hr>
					<a href="?option=insert_class&content=Inserção de Turma" class="btn btn-primary">';
				echo '<span class="fa fa-university"></span>';
				echo ' Nova Turma</a><br>';

			break;

			case 'insert_class':

				$manager = new Manager();

				$filter['profile_id'] = 2; 

				$teachers = $manager->select_common("tb_users",null,$filter, null);	

				$courses = $manager->select_common("tb_courses",null,null,null);

				include_once $GLOBALS['project_path']."/view/forms/insert_class.html";

			break;


		}//Fecha o Switch

	}//Fecha o Validade Option
?>