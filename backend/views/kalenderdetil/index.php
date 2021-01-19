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
use backend\models\Kalender;
use backend\models\Periode;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SkorpekerjadetilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Skorpekerjadetils';
//$this->params['breadcrumbs'][] = $this->title;

$this->title = Yii::t('app','Kalender');

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['kalender/index', 'page' => Yii::$app->session['myPage']]];
$this->title = Yii::t('app','Detil');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'page' => Yii::$app->session['myPage2']]];

?>

<div class="box box-danger">
    <div class="box-header with-border">
        <p>
            <?= Html::a('<i class="glyphicon glyphicon-home"></i>', ['kalender/index', 'page' => Yii::$app->session['myPage']], ['class' => 'btn btn-warning','title'=>Yii::t('app', 'Tutup')]) ?>
        </p>  
 
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>    
     
    <?php 

        //Tampilan Header Kalender
        //Benerin dulu KalenderdetilController.php actionIndex
        $modelKalender = Kalender::findOne($searchModel->kalender_id); 
        echo $this->render('/kalender/view_header', ['model' => $modelKalender, ]); 

        //Tampilan Index Kalenderdetil
        $scrollingTop=True;

        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            //'id',
            //'kalender_id',
            [
                'attribute'=>'periode_id', 
                'vAlign'=>'left',
                'width'=>'1px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->periode->periode;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Periode::find()->orderBy('id')->asArray()->all(), 'id', 'periode'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>Yii::t('app', 'Pilih...')],
                'format'=>'raw',
				
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
            [
                'attribute' => 'terkini',
                'format' => 'boolean',
                //'contentOptions' => [ 'style' => 'width: 50%;' ],
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
                //'contentOptions' => [ 'style' => 'width: 50%;' ],
            ],
            [
                'attribute' => 'tugas',
                'format' => 'boolean',
                //'contentOptions' => [ 'style' => 'width: 50%;' ],
            ],
    
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            ['class' => 'kartik\grid\ActionColumn',
                'header' => 'Action',
                'width' => '100px',
                'template' => '{view} {update} {delete}',
                'buttons' => [
    
                    'view' => function ($url, $model,$key) {
                         return (Yii::$app->user->can('lihat') OR Yii::$app->user->can('All')) ? 
                                Html::a('<span class="glyphicon glyphicon-eye-open" style="color:#00e6ac"> </span>', $url, ['title' => Yii::t('app', 'Lihat'), ])  :
                                Html::a('<span class="glyphicon glyphicon-eye-open" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'Lihat'), ]) ;},
                    'update' => function ($url, $model,$key) {
                         return (Yii::$app->user->can('ubah') OR Yii::$app->user->can('All')) ? 
                                Html::button('<span class="glyphicon glyphicon-pencil" style="color:#33adff"> </span>',
                                    ['value' => \yii\helpers\Url::to(['update','id'=>$key]),
                                     'title' => Yii::t('app', 'Ubah'), 'class' => 'showModalButton',
                                     'style' => 'border:0px solid black; background-color: transparent;']) :
                                Html::a('<span class="glyphicon glyphicon-pencil" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'Ubah'), ]) ;},

                    'delete' => function ($url, $model,$key) {
                          return (Yii::$app->user->can('hapus') OR Yii::$app->user->can('All')) ? 
                               Html::a('<span class="glyphicon glyphicon-trash" style="color:#ff0000"> </span>', $url, ['title' => Yii::t('app', 'Hapus'),'data-confirm' => Yii::t('yii', 'Yakin hapus?'),'data-method'  => 'post', ]) :
                                Html::a('<span class="glyphicon glyphicon-trash" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'Hapus'), ]) ;},
                ], 

                //'contentOptions' => [ 'style' => 'width: 6%;' ],   //dipasang jika tidak tidak beraturan          
                 
            ],  

        ]; // $gridColumns 

    ?>

    <?=  GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'options' => [ 'style' => 'table-layout:fixed;' ], //skorpekerja gak ketutup layar 
            'rowOptions' => function($model, $key, $index, $column){
                //if($index % 2 == 0){
                //    return ['class' => 'info'];
                //}
            },
            'hover' => true,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'skorpekerja']],
            'panel' => [
                'type' => 'danger',
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> '.Html::encode( Yii::t('app','Detil')).'</h3>',
            ],
            // set a label for default menu
            'export' => [
                'label' => Yii::t('app', 'Halaman'),
                'fontAwesome' => true,
            ],
            // your toolbar can include the additional full export menu
            'toolbar' => [

               ['content'=> (Yii::$app->user->can('cipta') OR Yii::$app->user->can('All')) ?
                     Html::button('<i class="glyphicon glyphicon-plus"></i>',
                        ['value' => \yii\helpers\Url::to(['create']),
                         'title' => Yii::t('app', 'Cipta'), 'class' => 'showModalButton btn btn-info']) :
                    ''                 
                ],                
                
                ['content'=> (Yii::$app->user->can('ekspor') OR Yii::$app->user->can('All')) ?
                    '{export}' : ''
                ],       
  
                ['content'=>
                    
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], 
                        [
                        'data-pjax'=>0, 
                        'class' => 'btn btn-default', 
                        'title'=>Yii::t('app','Ulang Kisi') //'Reset Grid'
                    ])
                ],
                '{toggleData}',
            ],


        ]); //Gridview
    ?>
</div>
