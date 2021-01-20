<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\Finances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="finances-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

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
