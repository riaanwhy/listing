<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\FinancesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="finances-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'sales') ?>

    <?= $form->field($model, 'cogs') ?>

    <?php // echo $form->field($model, 'adm_expense') ?>

    <?php // echo $form->field($model, 'sales_expense') ?>

    <?php // echo $form->field($model, 'dep_expense') ?>

    <?php // echo $form->field($model, 'gm') ?>

    <?php // echo $form->field($model, 'nm') ?>

    <?php // echo $form->field($model, 'gm_percent') ?>

    <?php // echo $form->field($model, 'nm_percent') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
