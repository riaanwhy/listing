<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pib */

$this->title = Yii::t('app', 'Kalender');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kalender'), 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kalender-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
