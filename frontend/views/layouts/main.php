<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use backend\models\Perusahaan;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<?php
  $modelPerusahaan = Perusahaan::findOne(1);
  $perusahaan = $modelPerusahaan->perusahaan;

?>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
  <?php
    NavBar::begin([
        'brandLabel' => $perusahaan,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
        
    $menuItems [] = ['label' => '<span class="glyphicon glyphicon-home"></span> Home', 'url' => ['/site/index']];
   //$menuItems [] = ['label' => '<span class="glyphicon glyphicon-phone-alt"></span> About', 'url' => ['/site/about']];
   // $menuItems [] = ['label' => '<span class="glyphicon glyphicon-envelope"></span> Contact', 'url' => ['/site/contact']];
    if (Yii::$app->user->isGuest) {
        //Ditutup saat ini belum diperlukan, di SiteController actionLogin dan signup juga ditutup
        //$menuItems [] = ['label' => '<span class="glyphicon glyphicon-pencil"></span> Signup', 'url' => ['/site/signup']];       
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-user"></span> Login', 'url' => ['/admin']];   
    } else {  
         $menuItems[] = ['label' => '<span class="glyphicon glyphicon-off"></span> Logout (' . Html::encode(Yii::$app->user->identity->username) . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']];
         $menuItems[] = ['label' => '<span class="glyphicon glyphicon-share"></span> Go Backend', 'url' => ['/admin']]; 
     }   
 
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
         'encodeLabels' => false, //Agar glyphicon
  
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

   <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.1
        </div>
        <strong><a href="">&copy; sutedy.abd@gmail.com<?= date('Y') ?></a>.</strong> All rights
        reserved.
     
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
