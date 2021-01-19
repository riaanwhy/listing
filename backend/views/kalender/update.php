<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kalender */

$this->title = Yii::t('app', 'Kalender');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-default">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
