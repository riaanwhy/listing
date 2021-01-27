<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\modules\mdata\models\Companies;
use backend\modules\mdata\models\Countries;
use backend\modules\mdata\models\Finances;
use backend\modules\mdata\models\Sectors;
/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\Finances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="finances-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'company_id')->label(false)->widget(Select2::classname(), ['data' => ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name'),
           'options' => ['placeholder' => 'Project'],
            'pluginOptions' => [
                'width'=>'200px',
                'allowClear' => true,                               
                                ],
            ])->label("Company_id");?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales')->textInput() ?>

    <?= $form->field($model, 'cogs')->textInput() ?>

    <?= $form->field($model, 'adm_expense')->textInput() ?>

    <?= $form->field($model, 'sales_expense')->textInput() ?>

    <?= $form->field($model, 'dep_expense')->textInput() ?>

    <?= $form->field($model, 'gm')->textInput() ?>

    <?= $form->field($model, 'nm')->textInput() ?>

    <?= $form->field($model, 'gm_percent')->textInput() ?>

    <?= $form->field($model, 'nm_percent')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
