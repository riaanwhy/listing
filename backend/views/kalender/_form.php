<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tugas */
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

$created_by = 'Null';
$modelCreatedby = Yii::$app->DataInduk->cariPengguna($model->created_by);
If (!empty($modelCreatedby)){$created_by = $modelCreatedby->username;} 

$updated_by = 'Null';
$modelUpdatedby = Yii::$app->DataInduk->cariPengguna($model->updated_by);
If (!empty($modelUpdatedby)){$updated_by = $modelUpdatedby->username;} 

$created_at = \Yii::t('app', Yii::$app->formatter->asDatetime($model->created_at,'long'));
$updated_at = \Yii::t('app', Yii::$app->formatter->asDatetime($model->updated_at,'long'));
           
?>

<div class="kalender-form">

    <?php $form = ActiveForm::begin(['id' => 'kalender-form']); ?>
              
    <div class="box box-default">

        <div class="box-header with-border">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus"></i>' : '<i class="glyphicon glyphicon-floppy-save"></i>', ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-primary', 'title' => $model->isNewRecord ? Yii::t('app', 'Cipta') : Yii::t('app', 'Simpan')]) ?>
                <?php if (!$model->isNewRecord){ ?>     
                    <?= Html::a('<i class="glyphicon glyphicon-list"></i>', ['/kalenderdetil', 'id' => $model->id], ['class' => 'btn btn-success','title'=>Yii::t('app', 'Detil')]) ?>
                <?php }?>
                <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['index', 'page' => Yii::$app->session['myPage']], ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Tutup')]) ?>       
            </div>
            <!--<h3 class="box-title">Header</h3>-->

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
            </div>
        </div>

        <div class="box-body">
            <div class='row'>
                <div class="col-sm-6 col-md-6"> 
                    <?= $form->field($model, 'fiskal')->widget(etsoft\widgets\YearSelectbox::classname(), [
                        'yearStart' => -5,
                        'yearEnd' => 5,
                     ]);
                    ?>
                </div>    
                <div class="col-sm-6 col-md-6"> 
                    <?= $form->field($model, 'created_at')->textInput(['value' => $created_at, 'disabled' => true]) ?>
                </div>                
            </div> 
            <div class='row'>
                <div class="col-sm-6 col-md-6">  
                    <?= $form->field($model, 'tgl_awal')->widget(DateControl::classname(), []); ?> 
                </div>       
                <div class="col-sm-6 col-md-6">  
                    <?= $form->field($model, 'created_by')->textInput(['value' => $created_by,'disabled' => true]) ?>
                </div>           
            </div> 

           <div class='row'>
                <div class="col-sm-6 col-md-6">  
                    <?= $form->field($model, 'tgl_akhir')->widget(DateControl::classname(), []); ?> 
                </div> 
                <div class="col-sm-6 col-md-6">  
                      <?= $form->field($model, 'updated_at')->textInput(['value' => $updated_at, 'disabled' => true]) ?>
                </div>                
                 
            </div> 
            <div class='row'>
               <div class="col-sm-6 col-md-6"> 
                   <?= $form->field($model, 'tutup')->widget(SwitchInput::classname(), 
                    ['pluginOptions' => [
                        'handleWidth'=>50,
                        'onText'=>Yii::t('app', 'Ya'),
                        'offText'=>Yii::t('app', 'Tidak '),
                        'onColor' => 'danger',
                        'offColor' => 'success',                 
                    ]]) ?> 
               </div> 
                <div class="col-sm-6 col-md-6"> 
                    <?= $form->field($model, 'updated_by')->textInput(['value' => $updated_by,'disabled' => true]) ?> 
                </div> 
            </div>  
            <div class='row'>
                <div class="col-sm-6 col-md-6"> 
                    <?= $form->field($model, 'terkini')->widget(SwitchInput::classname(), 
                            ['pluginOptions' => [
                                'handleWidth'=>50,
                        'onText'=>Yii::t('app', 'Ya'),
                        'offText'=>Yii::t('app', 'Tidak '),
                    ]]) ?>
                </div> 
                <div class="col-sm-6 col-md-6"> 

                </div> 
            </div>  
        </div>                  
    </div> 
    <?php ActiveForm::end(); ?>
   


</div>