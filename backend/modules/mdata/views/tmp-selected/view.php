<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\mdata\models\TmpSelected */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tmp Selecteds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tmp-selected-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'companies_id',
            'finances_id',
        ],
    ]) ?>

</div>
<?php

\app\components\ExcelGrid::widget([ 
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
     'extension'=>'xlsx',
     'filename'=>'country-list'.date('Y-m-dH:i:s'),
     'properties' =>[
     //'creator' =>'',
     //'title'  => '',
     //'subject'  => '',
     //'category' => '',
     //'keywords'  => '',
     //'manager'  => '',
     ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'country_name',
        [
            'attribute' => 'created_at',
            'value' => function ($data) {
                return Yii::$app->formatter->asDateTime($data->created_at);
            },
        ],
        [
            'attribute' => 'created_by',
            'value' => 'createdBy.user_login_id',
        ],
        [
            'attribute' => 'updated_at',
            'value' => function ($data) {
                return (!empty($data->updated_at) ? Yii::$app->formatter->asDateTime($data->updated_at) : Yii::t('stu', ' (not set) '));
            },
        ],
        [
            'attribute' => 'updated_by',
            'value' => 'updatedBy.user_login_id',
        ],
    ],
]);

?>