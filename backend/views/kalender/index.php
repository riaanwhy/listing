<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\PJax;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\datecontrol\DateControl;
use kartik\export\ExportMenu;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper; //untuk Select
use backend\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Kalender');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'page' => Yii::$app->session['myPage']]];
?>

<div class="kalender-index">
    
<!--     <div class="row">
        <div class="col-lg-5">
           <?= $this->render('_search', ['model' => $searchModel]); ?>
           <br>
        </div>
    </div> -->
    <?php

        $scrollingTop=True;

        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            //'id',
            [
				//'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'fiskal',
               // 'contentOptions' => [ 'style' => 'width: 10%;' ],
            ],
            [
                'attribute' => 'tutup',
                'format' => 'boolean',
               // 'contentOptions' => [ 'style' => 'width: 10%;' ],
            ],
            [
                'attribute' => 'terkini',
                'format' => 'boolean',
                //'contentOptions' => [ 'style' => 'width: 50%;' ],
            ],
            [
                'attribute' => 'tgl_awal',
                'value' => function ($model, $index, $widget) {
                                return Yii::$app->formatter->asDate($model->tgl_awal,'php: Y-m-d');
                            },              
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    //'removeButton' => false, //tutup ini jika tampilan X button
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format'=>'yyyy-mm-dd', // Format'=>'yyyy-mm-dd hh:mm' jika FILTER_DATETIME
                         'todayHighlight' => true, //tgl hari ini di highlight  
                        ],

                    ],    
                //'contentOptions' => [ 'style' => 'width: 7%;' ],                 
            ],             
            [
                'attribute' => 'tgl_akhir',
                'value' => function ($model, $index, $widget) {
                                return Yii::$app->formatter->asDate($model->tgl_akhir,'php: Y-m-d');
                            },              
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    //'removeButton' => false, //tutup ini jika tampilan X button
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format'=>'yyyy-mm-dd', // Format'=>'yyyy-mm-dd hh:mm' jika FILTER_DATETIME
                         'todayHighlight' => true, //tgl hari ini di highlight  
                        ],

                    ],    
                //'contentOptions' => [ 'style' => 'width: 7%;' ],                 
            ],          
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{view} {update} {delete} {printid} {detil}',
                //'template' => '{view} {update} {delete}',
                'buttons' => [
    
                    'view' => function ($url, $model,$key) {
                         return (Yii::$app->user->can('lihat') OR Yii::$app->user->can('All')) ? 
                                Html::a('<span class="glyphicon glyphicon-eye-open" style="color:#00e6ac"> </span>', $url, ['title' => Yii::t('app', 'Lihat'), ]) :
                                Html::a('<span class="glyphicon glyphicon-eye-open" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'Lihat'), ]) ;},

                    'update' => function ($url, $model,$key) {
                         return (Yii::$app->user->can('ubah')  OR Yii::$app->user->can('All')) ? 
                                Html::a('<span class="glyphicon glyphicon-pencil" style="color:#33adff"> </span>', $url, ['title' => Yii::t('app', 'Ubah'), ]) :
                                Html::a('<span class="glyphicon glyphicon-pencil" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'Ubah'), ]) ;},

                    'delete' => function ($url, $model,$key) {
								return (Yii::$app->user->can('hapus') OR Yii::$app->user->can('All') AND
										empty(Yii::$app->KomponenDetil->cariKalenderdetil($model->id))) ? 
								Html::a('<span class="glyphicon glyphicon-trash" style="color:#ff0000"> </span>', $url, ['title' => Yii::t('app', 'Hapus'),'data-confirm' => Yii::t('yii', 'Yakin hapus?'),'data-method'  => 'post', ]) :
                                Html::a('<span class="glyphicon glyphicon-trash" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'Hapus'), ]) ;},
                   'detil' => function ($url, $model,$key) {
                         $url= Yii::$app->urlManager->createAbsoluteUrl(['/kalenderdetil', 'id' => $model->id ]);   
                         return (Yii::$app->user->can('detil') OR Yii::$app->user->can('All')) ? 
                                Html::a('<span class="glyphicon glyphicon-list" style="color:#d966ff"> </span>', $url, ['title' => Yii::t('app', 'Detil'), ]) :
                                Html::a('<span class="glyphicon glyphicon-list" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'Detil'), ]) ;},                                
                ],   
                'contentOptions' => [ 'style' => 'width: 10%;' ],   //dipasang jika tidak tidak beraturan          
            ],  

        ]; // $gridColumns 
    ?>

    <?=  GridView::widget([
			'id' => 'kv-grid-demo',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
             'options' => [ 'style' => 'table-layout:fixed;' ], //kalender gak ketutup layar
            //Untuk gridrow warna selang seling
            //'rowOptions' => function($model, $key, $index, $column){
            //    if($index % 2 == 0){
            //        return ['class' => 'info'];
            //    }
           // },
			'hover' => true,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'header']],
            'panel' => [
                'type' => GridView::TYPE_DEFAULT,
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> '.Html::encode($this->title).'</h3>',
            ],
            // set a label for default menu
            'export' => [
                'label' => Yii::t('app', 'Halaman'),
                'fontAwesome' => true,
            ],
            // your toolbar can include the additional full export menu
            'toolbar' => [

                ['content'=> (Yii::$app->user->can('cipta') OR Yii::$app->user->can('All')) ?
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', 
                        ['create'], 
                        ['class' => 'btn btn-info','title'=>Yii::t('app', 'Cipta')]) : ''
                ],               

                ['content'=> (Yii::$app->user->can('cetak') OR Yii::$app->user->can('All')) ?
                   Html::a('<span class="glyphicon glyphicon-print"> </span>', 
                    ['print'], 
                    ['class' => 'btn  btn-success','title'=>Yii::t('app', 'Cetak')]) : ''
                ],
                ['content'=> (Yii::$app->user->can('ekspor') OR Yii::$app->user->can('All')) ?
                    '{export}' : ''
                ],               
               
                ['content'=>
                    
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], 
                        [
                        'data-pjax'=>0, 
                        'class' => 'btn btn-default', 
                        'title'=>Yii::t('app', 'Ulang Kisi') //Reset Grid
                    ])
                ],
                '{toggleData}',
            ],
       ]); //Gridview
    ?>
</div>
