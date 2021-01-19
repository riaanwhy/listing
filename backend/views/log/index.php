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

//untuk Select
use yii\helpers\ArrayHelper;

use backend\models\User;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\PibSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'page' => Yii::$app->session['myPage']]];
?>

<div class="pib-index">
    <div class="row">
<!--         <div class="col-lg-5">
           <?= $this->render('_search', ['model' => $searchModel]); ?>
           <br>
        </div> -->
    </div>
    <?php

        $scrollingTop=True;
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            'key',
            'modul',
            'fungsi',
            'aksi',     
            [
                'attribute' => 'created_at',
                'value' => function ($model, $index, $widget) {
                                return Yii::$app->formatter->asDatetime($model->created_at,'php: Y-m-d H:i:s');
                            },              
//              'value' => 'created_at',
//              'format' => ['date', 'php: Y-m-d GG:i'], // php: Y-m-d GG:i 
                'filterType' => GridView::FILTER_DATETIME,
        //      'width' => '150px',
        //      'hAlign' => 'center',
                'filterWidgetOptions' => [
                    //'removeButton' => false, //tutup ini jika tampilan X button
                    'pluginOptions' => [
                        'endDate' => '+1d', //untuk filter tidak boleh lebih besar dari hari ini
                        'autoclose'=>true,
                        'format'=>'yyyy-mm-dd hh:mm:ss', // Format'=>'yyyy-mm-dd hh:mm' jika FILTER_DATETIME
                        'todayHighlight' => true, //tgl hari ini di highlight
    
                        ],

                    ],
                    //'filterInputOptions'=>['placeholder'=>'Tgl Daftar ...'],
                    
            ],      
            [
                'attribute'=>'created_by', 
                'vAlign'=>'left',
                'width'=>'150px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->user->username;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Pilih...'],
                'format'=>'raw'
            ],                
         ]; // $gridColumns 


    ?>



    <?=  GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
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
                'type' => GridView::TYPE_PRIMARY,
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-list"></i> '.Html::encode($this->title).'</h3>',
            ],
            // set a label for default menu
            'export' => [
                'label' => 'Page',
                'fontAwesome' => true,
            ],
            // your toolbar can include the additional full export menu
            'toolbar' => [              
                
                '{export}',
  
                ['content'=>
                    
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], 
                        [
                        'data-pjax'=>0, 
                        'class' => 'btn btn-default', 
                        'title'=>'Reset Grid'
                    ])
                ],
                '{toggleData}',
            ],


        ]); //Gridview
    ?>
</div>
