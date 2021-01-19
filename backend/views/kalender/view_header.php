<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\web\NotFoundHttpException;

/* @var $this yii\web\View */
/* @var $model backend\models\Pib */

$created_by = 'Null';
$modelCreatedby = Yii::$app->DataInduk->cariPengguna($model->created_by);
If (!empty($modelCreatedby)){$created_by = $modelCreatedby->username;} 

$updated_by = 'Null';
$modelUpdatedby = Yii::$app->DataInduk->cariPengguna($model->updated_by);
If (!empty($modelUpdatedby)){$updated_by = $modelUpdatedby->username;} 

?>
<div class="box-body">

    <div class="col-sm-6 col-md-6"> 
     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fiskal',
            'tgl_awal',
            'tgl_akhir',
            [
                'attribute' => 'tutup',
                'format' => 'boolean',
            ],
            [
                'attribute' => 'terkini',
                'format' => 'boolean',
            ],
        ],    
    ]) ?>
    </div>

    <div class="col-sm-6 col-md-6"> 
     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [                    
            [
                'attribute' => 'created_by',
                'value' => $created_by,
            ],    
            [
                'attribute' => 'created_at',
                'value'=> \Yii::t('app', Yii::$app->formatter->asDatetime($model->created_at,'long')),
            ],    
            [
                'attribute' => 'updated_by',
                'value' => $updated_by,
            ],    

            [
                'attribute' => 'updated_at',
                'value'=> \Yii::t('app', Yii::$app->formatter->asDatetime($model->updated_at,'long')),
            ],   
         ],    
    ]) ?>
    </div>  

</div> 
