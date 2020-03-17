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

try {

$mpdf = new mPDF();

//$mpdf->debug = true;

//$stylesheet = file_get_contents($project_index.'/view/assets/bootstrap/css/bootstrap.css');

//$stylesheet = file_get_contents('bootstrap.css');

$html = '
		<div class="col-md-12 receituario">
			<div class="col-md-6">
				<h5>Nome:</h5>
				<p>'.$show_r['patient_name'].'</p>
			</div>
			<div class="col-md-4">
				<h5>Data:</h5>
				<p>'.$prescription_r['prescription_date'].'</p>
			</div>
		</div>

		<div class="col-md-6 receituario">
			<!--Olho Direito-->
			<div class="col-md-12">
				<h4>Olho Direito</h4>
				<table class="table table-condensed">
				  <thead>
				    <tr>
				      <th>Cilindrico</th>
				      <th>Esferico</th>
				      <th>Eixo</th>
				      <th>DP</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td>'.$prescription_r['prescription_re_esf'].'</td>
				      <td>'.$prescription_r['prescription_re_cil'].'</td>
				      <td>'.$prescription_r['prescription_re_eixo'].'</td>
				      <td>'.$prescription_r['prescription_re_dp'].'</td>
				    </tr>
				  </tbody>
				</table>
			</div>
			<!-- Fim Olho Direito -->

			<!--Olho Esquerdo-->
			<div class="col-md-12">
				<h4>Olho Esquerdo</h4>
				<table class="table table-condensed">
				  <thead>
				    <tr>
				      <th>Cilindrico</th>
				      <th>Esferico</th>
				      <th>Eixo</th>
				      <th>DP</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <td>'.$prescription_r['prescription_le_esf'].'</td>
				      <td>'.$prescription_r['prescription_le_cil'].'</td>
				      <td>'.$prescription_r['prescription_le_eixo'].'</td>
				      <td>'.$prescription_r['prescription_le_dp'].'</td>
				    </tr>
				  </tbody>
				</table>
			</div>
			<!-- Fim Olho Esquerdo -->
			<div class="col-md-12">
			<br>
				<label>Adição</label><p>'.$prescription_r['prescription_addition'].'</p>
				<br>
				<label>Observações</label><p>'.$prescription_r['prescription_comments'].'</p>
				<br>
			</div>
	</div>

	';

//$mpdf->WriteHTML(file_get_contents($project_index.'/view/assets/bootstrap/css/bootstrap.css'),1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();

} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}
exit;

//==============================================================
//==============================================================
//==============================================================

?>