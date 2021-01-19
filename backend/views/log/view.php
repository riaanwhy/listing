<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pib */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Penerimaan Bahan Baku', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Log', 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'View ';
?>
<div class="pib-view">
   <!-- <h1><?= Html::encode($this->title) ?></h1>-->
    <p>
        <?= Html::a(Yii::t('app', 'Close'), ['index', 'page' => Yii::$app->session['myPage']], ['class' => 'btn btn-warning']) ?>
    </p>
    <div class="col-sm-4 col-md-6">  
         <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'key',
                'modul',
                'fungsi',
                'aksi',
                'informasi',
                'created_at',
                'created_by'           

            ],    
        ]) ?>
    </div>    
 
</div>
