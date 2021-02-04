<?php 
	use yii\widgets\ActiveForm;



use kartik\widgets\FileInput;
use yii\helpers\Html;
?>
<h1>Import Data</h1>
<div class="col-md-6 col-md-offset-2">


<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);?>
<?php echo $form->field($modelImport, 'fileImport')->label(false)->widget(FileInput::classname(), [
    'options' => ['id' => 'input-id'],
    'pluginOptions' => [
        'showUpload' => false,
        'showPreview' => false,
    ],
]);?>
</div>

<?= Html::submitButton('Import',['class'=>'btn btn-primary']);?>


                   &nbsp;
                    
 <?php  echo Html::a('Template Import', ['exptmp'], ['class' => 'btn btn-danger']) ?>
<?php ActiveForm::end();?>
<br>