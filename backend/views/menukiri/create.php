<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Menukiri */

$this->title = Yii::t('app', 'Create Menukiri');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menukiris'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menukiri-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
