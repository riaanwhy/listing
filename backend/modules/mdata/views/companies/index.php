<?php

use yii\helpers\Html;
use backend\modules\mdata\models\Sectors;
use backend\modules\mdata\models\Countries;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mdata\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Data Companies
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
   





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'sic_code',
                'name',

            [
                'attribute' => 'sector',
                'filter' => ArrayHelper::map(Sectors::find()->asArray()->all(), 'id', 'name'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'200px'
                    ],
                ],
                'value'=>function($data){
                   return  $data->sector0->name ;  
                }
            ],

      //      'sub_sector',
            [
                'attribute' => 'sub_sector',
                'filter' => ArrayHelper::map(Sectors::find()->asArray()->all(), 'id', 'name'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'200px'
                    ],
                ],
                'value'=>function($data){
                   return  $data->subSector->name ;  
                }
            ],
            [
                'attribute' => 'country',
                'filter' => ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'200px'
                    ],
                ],
                'value'=>function($data){
                   return  $data->country0->name ;  
                }
            ],
            //'country',
            //'exchange',
            //'website',
            //'profile:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    </div> <!--box body -->
</div> <!-- box primary-->