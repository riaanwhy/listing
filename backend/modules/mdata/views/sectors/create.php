<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\sectors */

$this->title = Yii::t('app', 'Create Sectors');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
