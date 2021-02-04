<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\Finances */

$this->title = Yii::t('app', 'Create Finances');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
