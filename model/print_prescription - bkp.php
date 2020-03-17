<?php 

	include_once dirname(__DIR__).'/model/config.php';

//==============================================================
	# Incluindo as classes necessárias
		include_once $GLOBALS['project_path']."/model/class/Connect.class.php";

		include_once $GLOBALS['project_path']."/model/class/Manager.class.php";
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
//==============================================================
//==============================================================

include $GLOBALS['project_path'].'/model/class/mpdf60/mpdf.php';
$mpdf = new mPDF('c');

ob_start();

echo '<html><head><link rel="stylesheet" href=';
echo $project_index;
echo '/view/assets/bootstrap/css/bootstrap.css"></head><body>';

echo '<div class="col-md-12 receituario">
		<div class="col-md-6">
			<h5>Nome:</h5>
			<p>';
echo $show_r['patient_name'];

echo '</p>
		</div>
		<div class="col-md-4">
			<h5>Data:</h5>
			<p>';
echo $prescription_r['prescription_date'];

echo '</p>
		</div>
	</div>';
echo '</div>';
echo '</body>';
$html = ob_get_contents();

ob_end_clean();

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================

?>