<?php 
	use yii\widgets\ActiveForm;
	use yii\helpers\Html;

$this->title = Yii::t('app','Pembuatan Laporan');
$this->params['breadcrumbs'][] = ['label' => 'Design', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Report';

?>
<div class="reportico-view">

	<!-- Start of Reportico Report -->
  <?php

   	$reportico = \Yii::$app->getModule('reportico');
    $engine = $reportico->getReporticoEngine();
    $reportico->engine->initial_execute_mode = "ADMIN";
    $reportico->engine->access_mode = "FULL";
    $engine->bootstrap_styles = "3"; 
    $engine->force_reportico_mini_maintains = true;   
    $engine->bootstrap_preloaded = true;   
    $engine->clear_reportico_session = true;   
    $engine->initial_project_password = "beenam";
    $engine->execute(); 
    ?> 
      <!-- End of Reportico Report -->
<!--
    $engine = $reportico->getReporticoEngine();        // Fetches reportico engine
    $engine->access_mode = "ONEREPORT";                // Allows access to single specified report
    $engine->initial_execute_mode = "PREPARE";         // Starts user in report criteria selection mode
    $engine->initial_project = "atom";            // Name of report project folder
    $engine->initial_report = "receipts";           // Name of report to run
    $engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
    $engine->force_reportico_mini_maintains = true;    // Often required
    $engine->bootstrap_preloaded = true;               // true if you dont need Reportico to load its own bootstrap
    $engine->execute(); 
  -->   
</div>		