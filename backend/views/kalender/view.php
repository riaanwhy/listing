<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Kalender */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kalender'), 'url' => ['index', 'page' => Yii::$app->session['myPage']]]; 
$this->params['breadcrumbs'][] = $this->title;
$this->title = Yii::t('app', 'Kalender ');

?>

<div class="box box-default">
    <div class="box-header with-border">
        <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-info','title'=>Yii::t('app', 'Cipta')]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary','title'=>Yii::t('app', 'Ubah')]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger', 
            'data' => [
                'confirm' => Yii::t('app', 'Yakin hapus?'),
                'method' => 'post',
            ],
            'title'=>Yii::t('app', 'Hapus'),
        ]) ?>
  
        <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['index', 'page' => Yii::$app->session['myPage']], ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Tutup')]) ?>
        </p>        
       <!-- <h3 class="box-title">Header ID#: <?= $model->id ?></h3>-->
        <div class="box-tools pull-right">
            <button type="button" class="btn btn- box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
        </div>
    </div>    

    <?= $this->render('view_header.php', ['model' => $model, ]) ?>
  
</div>


