<?php

use yii\helpers\Html;

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kota-update">
	<!--<h1><?= Html::encode($this->title) ?></h1>-->
 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
