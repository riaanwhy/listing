<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\Countries */

$this->title = Yii::t('app', 'Create Countries');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
        'model' => $model,
    ]) ?>




