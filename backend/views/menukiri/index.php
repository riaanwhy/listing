<?php

use yii\helpers\Html;
use backend\models\Menukiri;
use backend\models\MenukiriSearch;  


/* @var $this yii\web\View */
/* @var $searchModel backend\models\TreeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Backend - Left Menu');
$this->params['breadcrumbs'][] = $this->title;
$isAdmin=false;
if (Yii::$app->user->identity->username == 'superadmin') $isAdmin = true;
?>
<div class="tree-index">
    <?php
        echo \kartik\tree\TreeView::widget([
            'query'             => Menukiri::find()->addOrderBy('root, lft'),             
            'headingOptions' => ['label' => 'Menu'],

            'rootOptions' => [
                'label'=>'<span><i class="fa fa-star"></i>'.Yii::$app->name.'</span>',  // custom root label
                'class'=>'text-success'
            ],
            'topRootAsHeading' => true, // this will override the headingOptions
            'fontAwesome' => true,
            'isAdmin' => $isAdmin,
             'iconEditSettings'=> [
                 'show' => 'none',
            //     'listData' => [
            //         'folder' => 'Folder',
            //         'file' => 'File',
            //         'mobile' => 'Phone',
            //         'bell' => 'Bell',
            //     ]
             ],
            'nodeAddlViews' => [
                \kartik\tree\Module::VIEW_PART_2 => '@backend/views/menukiri/_treePart2'
            ],

            'softDelete' => false,
            'cacheSettings' => ['enableCache' => true],
        ]);
    ?>
</div>
