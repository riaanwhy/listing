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
/* @var $model backend\modules\mdata\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sic_code')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  
     <?php echo $form->field($model, 'sector')->label(false)->widget(Select2::classname(), ['data' => ArrayHelper::map(Sectors::find()->asArray()->all(), 'id', 'name'),
           'options' => ['placeholder' => 'Project'],
            'pluginOptions' => [
                'width'=>'200px',
                'allowClear' => true,                               
                                ],
            ])->label("Sector");?>

    <?php echo $form->field($model, 'sub_sector')->label(false)->widget(Select2::classname(), ['data' => ArrayHelper::map(Sectors::find()->asArray()->all(), 'id', 'name'),
           'options' => ['placeholder' => 'Project'],
            'pluginOptions' => [
                'width'=>'200px',
                'allowClear' => true,                               
                                ],
            ])->label("sub_sector");?>

    <?php //echo $form->field($model, 'country')->textInput() ?>

    <?php echo $form->field($model, 'country')->label(false)->widget(Select2::classname(), ['data' => ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name'),
           'options' => ['placeholder' => 'Project'],
            'pluginOptions' => [
                'width'=>'200px',
                'allowClear' => true,                               
                                ],
            ])->label("Contry");?>
            

    <?= $form->field($model, 'exchange')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
