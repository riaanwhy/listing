<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pengguna */

$this->title = Yii::t('app', 'User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cipta'), 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
