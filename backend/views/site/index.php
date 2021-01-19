<?php
  use miloschuman\highcharts\Highcharts;
  use miloschuman\highcharts\Highstock;
  use yii\web\JsExpression;
  use yii\db\Query;

  use yii\web\NotFoundHttpException;
  
  /* @var $this yii\web\View */
  $this->title = 'Home';
  
  $modelAssignment = Yii::$app->MyComponent->listAssignment();

?>
<section class="content">

  <section class="col-lg-5 connectedSortable">

  <!-- Map box -->
  <div class="box box-solid bg-light-blue-gradient">
      <div class="box-header">
        <!-- tools box -->
        <div class="pull-right box-tools">
          <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
        </div><!-- /. tools -->

        <i class="fa fa-user"></i>
        <h3 class="box-title">
          Login as: <?= Yii::$app->user->identity->username; ?>
        </h3>
      </div>
      <div class="box-body no-padding">
        <table class="table table-condensed">
            <tr>
              <th style="width: 10px">#</th>
              <th>Akses</th>
              <th>Created Date</th>
            </tr>
            <?php 
              $i=1;
              foreach ($modelAssignment as $values) 
            {?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $values; ?></td>
              <td><?= '' ?></td>
            </tr>
            <?php 
              $i++;
              }?>
          </table>
      </div><!-- /.box-body-->
    </div>
  </section>

</section> 