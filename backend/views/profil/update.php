<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Anggaran */

$this->title = Yii::t('app', 'Profil');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-default">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
