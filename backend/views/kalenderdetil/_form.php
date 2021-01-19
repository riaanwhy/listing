<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\kegiatan */
/* @var $form yii\widgets\ActiveForm */

//Satu set untuk menampilkan detil
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper; 

use kartik\select2\Select2;
use kartik\widgets\DepDrop;
use yii\jui\DatePicker;
use kartik\widgets\DateTimePicker; 
//use kartik\datetime\DateTimePicker; // masih belum bener pakainya
use kartik\datecontrol\DateControl;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\SwitchInput;
use backend\models\Periode;
?>

<div class="kalenderdetil-form">

  <?php $form = ActiveForm::begin(['id' => 'kalenderdetil-form']); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i>' : '<i class="glyphicon glyphicon-floppy-save"></i>', ['class' => $model->isNewRecord ? 'showModalButton btn btn-info' : 'showModalButton btn btn-primary', 'title' => $model->isNewRecord ? Yii::t('app', 'Cipta') : Yii::t('app', 'Simpan')]) ?>

        <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['index', 'page' => Yii::$app->session['myPage']], ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Tutup')]) ?>
        
        <br><br>

        <?= $form->field($model, 'periode_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Periode::find()->all(),'id','periode'),
            'options' => ['placeholder' => Yii::t('app', 'Pilih...')],
            'pluginOptions' => [
                'allowClear' => true,
                ],
            ]);
        ?>    
        <?= $form->field($model, 'tgl_awal')->widget(DateControl::classname(), []); ?> 
        <?= $form->field($model, 'tgl_akhir')->widget(DateControl::classname(), []); ?> 
        <?= $form->field($model, 'terkini')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
            ]]) ?>
		<?= $form->field($model, 'pu')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 	
		<?= $form->field($model, 'sa')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 		
		<?= $form->field($model, 'wp')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 	
		<?= $form->field($model, 'gl')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 
		<?= $form->field($model, 'ar')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 
		<?= $form->field($model, 'ap')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 	

		<?= $form->field($model, 'pi')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 	
		<?= $form->field($model, 'hr')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?> 	
        <?= $form->field($model, 'anggaran')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',               
            ]]) ?>
        <?= $form->field($model, 'tugas')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                'onText'=>Yii::t('app', 'Ya'),
                'offText'=>Yii::t('app', 'Tidak '),
                'onColor' => 'danger',
                'offColor' => 'success',                 
            ]]) ?>                   
    </div> 
    <?php ActiveForm::end(); ?>
   
</div>