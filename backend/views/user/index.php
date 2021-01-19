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

$this->title = Yii::t('app','Users');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'page' => Yii::$app->session['myPage']]];
?>

<div class="tabel-index">
    
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
			[
				'attribute' => 'username',
			],
            'email',            
            
			[
                'class'=>'kartik\grid\BooleanColumn',
				'attribute'=>'status', 
                'value' => 'statusBoolean',
			],		
			[
				'attribute' => 'created_at',
				'value' => function ($model, $index, $widget) {
								return Yii::$app->formatter->asDatetime($model->created_at,'php: Y-m-d H:i');
							},				
//				'value' => 'created_at',
//				'format' => ['date', 'php: Y-m-d GG:i'], // php: Y-m-d GG:i	
			 	'filterType' => GridView::FILTER_DATETIME,
		//		'width' => '150px',
		//		'hAlign' => 'center',
				'filterWidgetOptions' => [
					//'removeButton' => false, //tutup ini jika tampilan X button
					'pluginOptions' => [
						'endDate' => '+1d', //untuk filter tidak boleh lebih besar dari hari ini
						'autoclose'=>true,
						'format'=>'yyyy-mm-dd hh:mm', // Format'=>'yyyy-mm-dd hh:mm' jika FILTER_DATETIME
						'todayHighlight' => true, //tgl hari ini di highlight
	
						],

					],
					//'filterInputOptions'=>['placeholder'=>'Tgl Daftar ...'],
					
			],		
			[
				'attribute' => 'updated_at',
				'value' => function ($model, $index, $widget) {
								return Yii::$app->formatter->asDatetime($model->updated_at,'php: Y-m-d H:i');
							},				
//				'value' => 'created_at',
//				'format' => ['date', 'php: Y-m-d GG:i'], // php: Y-m-d GG:i	
			 	'filterType' => GridView::FILTER_DATETIME,
		//		'width' => '150px',
		//		'hAlign' => 'center',
				'filterWidgetOptions' => [
					//'removeButton' => false, //tutup ini jika tampilan X button
					'pluginOptions' => [
						'endDate' => '+1d', //untuk filter tidak boleh lebih besar dari hari ini
						'autoclose'=>true,
						'format'=>'yyyy-mm-dd hh:mm', // Format'=>'yyyy-mm-dd hh:mm' jika FILTER_DATETIME
						'todayHighlight' => true, //tgl hari ini di highlight
	
						],

					],
					//'filterInputOptions'=>['placeholder'=>'Tgl Daftar ...'],
					
			],	

            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{view} {update} {delete} {printid} {detil}',
                //'template' => '{view} {update} {delete}',
                'buttons' => [
    
                    'view' => function ($url, $model,$key) {
                         return (Yii::$app->user->can('view') OR Yii::$app->user->can('All')) ? 
                                Html::a('<span class="glyphicon glyphicon-eye-open" style="color:#00e6ac"> </span>', $url, ['title' => Yii::t('app', 'view'), ]) :
                                Html::a('<span class="glyphicon glyphicon-eye-open" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'view'), ]) ;},

                    'update' => function ($url, $model,$key) {
                         return (Yii::$app->user->can('update')  OR Yii::$app->user->can('All')) ? 
                                Html::a('<span class="glyphicon glyphicon-pencil" style="color:#33adff"> </span>', $url, ['title' => Yii::t('app', 'update'), ]) :
                                Html::a('<span class="glyphicon glyphicon-pencil" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'update'), ]) ;},

                    'delete' => function ($url, $model,$key) {
                          return (Yii::$app->user->can('delete')  OR Yii::$app->user->can('All')) ? 
                               Html::a('<span class="glyphicon glyphicon-trash" style="color:#ff0000"> </span>', $url, ['title' => Yii::t('app', 'delete'),'data-confirm' => Yii::t('yii', 'Yakin delete?'),'data-method'  => 'post', ]) :
                                Html::a('<span class="glyphicon glyphicon-trash" style="color:#C0C0C0"> </span>', '', ['title' => Yii::t('app', 'delete'), ]) ;},
                                               
                ],   
                'contentOptions' => [ 'style' => 'width: 8%;' ],   //dipasang jika tidak tidak beraturan          
            ],  
            ['class' => 'kartik\grid\CheckboxColumn']
        ]; // $gridColumns 
    ?>

    <?=  GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
             'options' => [ 'style' => 'table-layout:fixed;' ], //tabel gak ketutup layar
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


                ['content'=> (Yii::$app->user->can('Add') OR Yii::$app->user->can('All')) ?
                    Html::a('<i class="glyphicon glyphicon-plus-sign"> '.Yii::t('app', 'Create').'</i>', 
                        ['create'], 
                        ['class' => 'btn btn-info','title'=>Yii::t('app', 'Add')]) : ''
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
