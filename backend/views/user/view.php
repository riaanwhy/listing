<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\Pib */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Penerimaan Bahan Baku', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'View ';
?>
<div class="pib-view">
   <!-- <h1><?= Html::encode($this->title) ?></h1>-->
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-left"> '.Yii::t('app', 'Back').'</i>', ['index', 'page' => Yii::$app->session['myPage']], ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Back')]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-plus-sign"> '.Yii::t('app', 'Create').'</i>', ['create'], ['class' => 'btn btn-info','title'=>Yii::t('app', 'Create')]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"> '.Yii::t('app', 'Update').'</i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary','title'=>Yii::t('app', 'Update')]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"> '.Yii::t('app', 'Delete').'</i>', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger', 
            'data' => [
                'confirm' => Yii::t('app', 'Yakin hapus?'),
                'method' => 'post',
            ],
            'title'=>Yii::t('app', 'Hapus'),
        ]) ?>
 
    </p>
    <div class="col-sm-4 col-md-6">  
         <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'email:email',
   
                [
                    'attribute'=>'status',
                    'value'=> $status,
                ], 
                [
                    'attribute' => 'created_by',
                    'value' => $dibuatoleh,
                ],
                [
                    'attribute'=>'created_at',
                    'value'=> \Yii::t('app', Yii::$app->formatter->asDatetime($model->created_at,'long')),
                    ], 
                [
                    'attribute' => 'updated_by',
                    'value' => $diubaholeh,
                ],
                [
                    'attribute'=>'updated_at',
                    'value'=> \Yii::t('app', Yii::$app->formatter->asDatetime($model->updated_at,'long')),
                ],  
             
            ],    
        ]) ?>
    </div>    
    
</div>
