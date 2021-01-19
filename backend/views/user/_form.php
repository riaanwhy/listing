<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
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
use backend\models\Status;

?>

<div class="user-form">

  <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>
    <div class="form-group">

        <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-left"> '.
          Yii::t('app', 'Back').'</i>', ['index', 'page' => Yii::$app->session['myPage']],
           ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Kembali')]) ?>
 
    </div>

    <div class="col-sm-12 col-md-12"> 

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->checkbox(); ?>
          
  <!--           <?= $form->field($model, 'created_at')->textInput() ?>

            <?= $form->field($model, 'created_by')->textInput() ?>

            <?= $form->field($model, 'updated_at')->textInput() ?>

            <?= $form->field($model, 'updated_by')->textInput() ?> -->
             
    </div> 
    <div class="form-group">
        
        <?= Html::submitButton($model->isNewRecord ? '<i class="glyphicon glyphicon-plus-sign"> '.Yii::t('app', 'Create').'</i>' : 
            '<i class="glyphicon glyphicon-floppy-save"> '.Yii::t('app', 'Save').'</i>', ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-primary', 'title' => $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')]) ?>
 
    </div>
    <?php ActiveForm::end(); ?>
   
</div>