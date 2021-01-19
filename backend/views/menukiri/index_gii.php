<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenukiriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menukiris');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menukiri-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Menukiri'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'root',
            'lft',
            'rgt',
            'lvl',
            //'name',
            //'icon',
            //'icon_type',
            //'active',
            //'selected',
            //'disabled',
            //'readonly',
            //'visible',
            //'collapsed',
            //'movable_u',
            //'movable_d',
            //'movable_l',
            //'movable_r',
            //'removable',
            //'removable_all',
            //'child_allowed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
