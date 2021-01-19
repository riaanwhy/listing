<?php
use yii\helpers\Html;
use backend\models\User;
use yii\widgets\Menu;
/* @var $this \yii\web\View */
/* @var $content string */

?>

<header class="main-header">

 <!--   <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
-->

   <?= Html::a('<span class="logo-mini">'.Html::img(Yii::$app->urlManager->baseUrl . '/' . 
        \Yii::$app->params['direktoriimages'] . 'figs.png').'</span><span class="logo-lg">' .
        Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>


    <nav class="navbar navbar-static-top" role="navigation"> 
    
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu" >

        <ul class="nav navbar-nav">

 

            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= Yii::$app->urlManager->baseUrl . '/' . \Yii::$app->params['direktoriimages'] .'/users/'. Yii::$app->user->identity->image ?>" class="user-image" alt="User Image"/>
                    <span class="hidden-xs"><?= Yii::$app->user->identity->username; ?><span class="caret"></span></span>
                    
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                         <img src="<?= Yii::$app->urlManager->baseUrl . '/' . \Yii::$app->params['direktoriimages'].'/users/' . Yii::$app->user->identity->image ?>" class="img-circle"
                            alt="User Image"/>

                        <p>
                        <div class="row">
                            <?= Yii::$app->user->identity->username; ?>
                        </div>
                        <div class="row">                         
                            <small><?= \Yii::t('app','Member Sejak: ') ?> <?= \Yii::t('app', Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at,'long')) ?></small>
                        </div>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <!--
                    <li class="user-body">
                        <div class="col-xs-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </li> -->
                    
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="col-xs-4 text-center">
                            <?= Html::a('<span btn btn-default btn-flat">'.\Yii::t('app','Profil').' </span>', Yii::$app->homeUrl.'/profil/update',['class' => 'btn btn-default btn-flat']) ?>
                        </div>
                        <div class="col-xs-4 text-center">
                            <?= Html::a('<span btn btn-default btn-flat">'.\Yii::t('app','Kunci').' </span>', Yii::$app->homeUrl.'/kunci',['class' => 'btn btn-default btn-flat']) ?>
                        </div>                           
                        <div class="col-xs-4 text-center">
                            <?= Html::a(
                                'Logout',
                                ['/site/logout'],
                                ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?>
                        </div>
                    </li>
                </ul>
            </li>
             <!-- User Account: style can be found in dropdown.less -->
            <!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
            -->
        </ul>
    </div>
    </nav>
</header>
