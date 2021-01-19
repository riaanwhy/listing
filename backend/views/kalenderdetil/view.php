<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Kalender; //untuk tampilan header

/* @var $this yii\web\View */
/* @var $model backend\models\Kalenderdetil */

$this->title = Yii::t('app', 'Kalender Detil') ;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['kalender/index', 'page' => Yii::$app->session['myPage']]];
$this->title = Yii::t('app', 'Detil') ;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'page' => Yii::$app->session['myPage2']]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Lihat');
//$this->title = Yii::t('app', 'Kegiatan Detil') ;


$created_by = 'null';
$modelCreatedby = Yii::$app->DataInduk->cariPengguna($model->created_by);
If (!empty($modelCreatedby)){$created_by = $modelCreatedby->username;} 

$updated_by = 'null';
$modelUpdatedby = Yii::$app->DataInduk->cariPengguna($model->updated_by);
If (!empty($modelUpdatedby)){$updated_by = $modelUpdatedby->username;} 

$periode = 'null';
$modelPeriode = Yii::$app->DataInduk->cariPeriode($model->periode_id);
If (!empty($modelPeriode)){$periode = $modelPeriode->periode;} 

?>

<div class="box box-default">
    <div class="box-header with-border">
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['index', 'page' => Yii::$app->session['myPage2']], ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Tutup')]) ?>
    
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!--  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
        </div>
    
    </p>
    </div>

    <?php $modelKalender = Kalender::findOne($model->kalender_id);?>   
    <?php  echo $this->render('/kalender/view_header', ['model' => $modelKalender]); ?>

    <div class="panel panel-info">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-th-list"></i> <?=Yii::t('app', 'Lihat Detil')?></h4></div>
        <div class="panel-body"> 
            <p>
            <?= Html::button('<i class="glyphicon glyphicon-plus"></i>',
                        ['value' => \yii\helpers\Url::to(['create']),
                         'title' => Yii::t('app', 'Cipta'), 'class' => 'showModalButton btn btn-info'])?>
 
            <?= Html::button('<i class="glyphicon glyphicon-pencil"></i>',
                        ['value' => \yii\helpers\Url::to(['update','id'=>$model->id]),
                         'title' => Yii::t('app', 'Ubah'), 'class' => 'showModalButton btn btn-primary'])?>

            <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger', 
                'data' => [
                    'confirm' => Yii::t('app', 'Yakin hapus?'),
                    'method' => 'post',
                ],
                'title'=>Yii::t('app', 'Hapus'),
            ]) ?>           
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    //'kalender_id',
                    [
                        'attribute' => 'periode_id',
                        'value' => $periode,
                    ], 
                    'tgl_awal',
                    'tgl_akhir',
                    [
                        'attribute' => 'terkini',
                        'format' => 'boolean',
                    ], 
					[
                        'attribute' => 'pu',
                        'format' => 'boolean',
					],	
                    [
                        'attribute' => 'sa',
                        'format' => 'boolean',
                    ], 
					[
                        'attribute' => 'wp',
                        'format' => 'boolean',
                    ], 
				    [
                        'attribute' => 'gl',
                        'format' => 'boolean',
                    ], 
                    [
                        'attribute' => 'ar',
                        'format' => 'boolean',
                    ], 
					[
                        'attribute' => 'ap',
                        'format' => 'boolean',
                    ], 
                    [
                        'attribute' => 'fa',
                        'format' => 'boolean',
                    ], 
					[
                        'attribute' => 'pi',
                        'format' => 'boolean',
                    ], 
                    [ 
                        'attribute' => 'hr',
                        'format' => 'boolean',
                    ], 
	
                    [
                        'attribute' => 'anggaran',
                        'format' => 'boolean',
                    ],
                    [
                        'attribute' => 'tugas',
                        'format' => 'boolean',
                    ],                    
                    [
                        'attribute' => 'created_by',
                        'value' => $created_by,
                    ],
                    [
                        'attribute'=>'created_at',
                        'value'=> \Yii::t('app', Yii::$app->formatter->asDatetime($model->created_at,'long')),
                        ], 
                    [
                        'attribute' => 'updated_by',
                        'value' => $updated_by,
                    ],
                    [
                        'attribute'=>'updated_at',
                        'value'=> \Yii::t('app', Yii::$app->formatter->asDatetime($model->updated_at,'long')),
                    ],                     
                    
                 ],
            ]) ?>
        </div>
    </div>        

</div>
