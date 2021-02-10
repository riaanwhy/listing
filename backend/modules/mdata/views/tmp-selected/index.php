<?php

use yii\helpers\Html;
use yii\grid\GridView;

use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\mdata\models\TmpSelectedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data selected';
$this->params['breadcrumbs'][] = $this->title;
?>
 <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> Data Selected
              </h3>
                 <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                    <div class="col-md-7">



                    <?=Html::beginForm(['bulkacc'],'post');?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                             'columns' => [
                                
                                ['class' => 'yii\grid\CheckboxColumn',
                                    'header'=>'Selected',

                                ],
                              
                                ['class' => 'yii\grid\SerialColumn',
                                    'header'=>'no',
                                ],

                                    [
                                        'header'=>'Companies',
                                        'value'=>'company.name',
                                        'options'=>[

                                    'width'=>'200px'   
                                            ]
                                    ],

                            ],
                        ]); ?>

   


<div class="col-sm-3">
        <?=Html::submitButton('Delete', ['class' => 'btn btn-danger','name'=>'del']);?> |
    </div>
<div class="col-sm-3">
          <?php


        echo Select2::widget([
            'name' => 'year',
            'data' => Yii::$app->MyComponent->tahun(),
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => 'tahun...', 

            'multiple' => true, 'autocomplete' => 'off'],
            'pluginOptions' => [
                'allowClear' => true,
                'width'=>'100px'

            ],
        ]);
        ?>
    </div>

<div class="col-sm-6">
        <?=Html::submitButton('Proses', ['class' => 'btn btn-info','name'=>'acc']);?>  
    </div>
        <?= Html::endForm();?> 
                               
               


                    </div>

                    <div class="col-md-5">
                        
                                      <div class="panel panel-default">
                                  <div class="panel-body">
                            
                                        Petunjuk penggunaan <br>
                                        1) Data di box adalah data yang dipilih user pada menu companies<br>
                                        2) Pada menu ini user dapat menggunakan  atau menghapus data companies <br>
                                        3) Untuk menghapus data terpilih caranya : <br>
                                           * pilih checkbox di men sebelah kiri <br>
                                            * klik tombol D


                                            elete data di bagian bawah<br> 
                                        <hr>
                                        4) Untuk mendapatkan data keuangan dari setiap perusahaan caranya :<br>
                                        * pilih rentang tahun yang ada di bagian bawah data <br>
                                        * klik tombol proses <br>
                                        * jika ada pesan sukses maka data sudah berhasil di ambil     <br>
                                  </div>
                              </div>
                 
              
                </div>


        </div>
</div>
