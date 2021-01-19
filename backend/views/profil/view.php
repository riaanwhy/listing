<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Slider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profil'), 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = $this->title;
$this->title = Yii::t('app', 'View ');

?>

<div class="box box-default">
    <div class="box-header with-border">
        <p> 
      
            <?= Html::a('<i class="glyphicon glyphicon-circle-arrow-left"> '.Yii::t('app', 'BACK').'</i>', Yii::$app->homeUrl, 
                    ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Back')]) ?>
            <?= Html::a('<i class="glyphicon glyphicon-pencil"> '.Yii::t('app', 'UPDATE').'</i>', ['update', 'id' => $model->id], 
                ['class' => 'btn btn-primary','title'=>Yii::t('app', 'Update')]) ;?>
        </p>        
       <!-- <h3 class="box-title">Header ID#: <?= $model->id ?></h3>-->
        <div class="box-tools pull-right">
            <button type="button" class="btn btn- box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
        </div>
    </div>    

    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute'=>'image',
                    'format' => ['image',['width'=>'300px']],    
                    'value' => function ($data) {
                        return 
                        \Yii::$app->urlManager->baseUrl. '/' . \Yii::$app->params['direktoriimages'] .'users/'.$data['image'];
                },
                ],  
                'username',
                'email',
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
