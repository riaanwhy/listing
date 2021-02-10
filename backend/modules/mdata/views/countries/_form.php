<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\modules\mdata\models\Countries;
use backend\modules\mdata\models\Sectors;
use backend\modules\mdata\models\Companies;
use backend\modules\mdata\models\Finances;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container">

<div class="col-md-2">
    
</div>


<div class="col-md-8">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Form Add Countries
              </h3>
                 <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>


</div>

<div class="col-md-2">
    
</div>

</div>