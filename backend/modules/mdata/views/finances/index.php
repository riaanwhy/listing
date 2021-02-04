<?php

use yii\helpers\Html;
use backend\modules\mdata\models\Companies;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mdata\models\FinancesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Finances');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finances-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Finances'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
          <?= Html::a(Yii::t('app', 'IMPORT'), ['import'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
       //     'company_id',
              [
                'attribute' => 'company_id',
                'filter' => ArrayHelper::map(Companies::find()->asArray()->all(), 'id', 'name'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'200px'
                    ],
                ],
                'value'=>function($data){
                   return  $data->company->name ;  
                }
            ],
            'year',
            'sales',
            'cogs',
            //'adm_expense',
            //'sales_expense',
            //'dep_expense',
            //'gm',
            //'nm',
            //'gm_percent',
            //'nm_percent',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
