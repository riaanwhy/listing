<?php

use yii\helpers\Html;
use backend\modules\mdata\models\Sectors;
use backend\modules\mdata\models\Countries;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mdata\models\SectorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sectors');
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Data Sectors
              </h3>
                 <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


        <div class="row">
          <div class="col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-body">
                       


              <?= Html::a('<i class="fa fa-plus"></i> Create ', ['create'], ['class' => 'btn btn-success']) ?>

              |

              <?= Html::a('<i class="fa fa-file"></i> Import', ['import'], ['class' => 'btn btn-success']) ?>
            
               </div>
              </div>
          </div>

            <div class="col-md-9"></div>
               
            </div>        
<?php
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'no',
    'name',
  
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns
]);

// You can choose to render your own GridView separately
//echo \kartik\grid\GridView::widget([
 //   'dataProvider' => $dataProvider,
  //  'filterModel' => $searchModel,
   // 'columns' => $gridColumns
//]); 
 ?>     

   



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'header'=>'no' ],
            
            [
                'attribute' => 'name',
                'filter' => ArrayHelper::map(Sectors::find()->asArray()->all(), 'name', 'name'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'200px'
                    ],
                ],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
