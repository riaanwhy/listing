<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Tabel */
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
//use dosamigos\ckeditor\CKEditor;
use mihaildev\ckeditor\CKEditor;
use bupy7\cropbox\Cropbox;
use kartik\file\FileInput;

use backend\models\Status;
use kartik\widgets\SwitchInput;

//Pendefisian direktori image untuk di 'initialPreview'=>[$imagePreview],
if ($model->image == '') {
    $imagePreview = Yii::$app->urlManager->baseUrl . '/' . \Yii::$app->params['direktoriimages'].'users/doe.jpg';
}else{
    $imagePreview = Yii::$app->urlManager->baseUrl . '/' . \Yii::$app->params['direktoriimages'].'users/'.$model->image;
}
?>

<div class="slider-form">
    <?php $form = ActiveForm::begin(['id' => 'slider-form','options' => ['enctype' => 'multipart/form-data'], 
                    'enableAjaxValidation'=>false]); ?>

    <div class="box box-default">                
        <div class="box-header with-border">
            <div class="form-group">
                <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-left"> '.
                    Yii::t('app', 'BACK').'</i>', Yii::$app->homeUrl, ['class' => 'btn btn-warning','title'=>Yii::t('app', 'BACK')]) ?>       
            </div>
            <!--<h3 class="box-title">Header</h3>-->

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
          </div>
        </div>



        <div class="box-body">
            <!--konten-->
            <div class="col-sm-6 col-md-6"> 
            
                <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
                    'name' => 'Upload Image',
                    'options'=>[
                        'multiple'=> false,
                        'accept' => 'image/*',
                    ],
                    'pluginOptions' => [
                        //'uploadUrl' => Url::to([]),
                        'initialPreview'=>[$imagePreview],
                        'initialPreviewAsData'=>true,
                        'previewFileType' => 'image/*',
                        'initialCaption'=>Yii::t('app', 'Hanya image file ...'),
                        'showUpload' => true,
                        'showClose' => true,
                        'showCaption' => true,
                        'showRemove' => true,
                        //'mainClass' => 'input-group-md',
                        'browseLabel' => Yii::t('app', 'Pilih ...'),
                        'maxFileCount' => 1,     
                        'browseClass' => 'btn btn-success',
                        'uploadClass' => 'btn btn-info',
                        'removeClass' => 'btn btn-danger',
                        'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '       
                    ]
                ]); ?>   

            </div> 
 
            <div class ='row'>
                <div class="col-sm-3 col-md-3"> 
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' =>true]) ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
 
             </div>
        </div>    <!--box-body-->
    </div>    <!--box box-default-->
    <div class="box-header with-border">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus-sign"> '.Yii::t('app', 'ADD').'</i>' :
                 '<i class="glyphicon glyphicon-floppy-save"> '.Yii::t('app', 'SAVE').'</i>', 
                 ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-primary', 
                 'title' => $model->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Save')]) ?>
        </div>  
    </div>                      
    <?php ActiveForm::end(); ?>
</div> <!--kontenhumas-form-->    