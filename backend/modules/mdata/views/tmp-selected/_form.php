<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\TmpSelected */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tmp-selected-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'companies_id')->textInput() ?>

    <?= $form->field($model, 'finances_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
