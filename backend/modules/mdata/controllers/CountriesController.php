<?php

namespace backend\modules\mdata\controllers;

use Yii;
use backend\modules\mdata\models\Countries;
use backend\modules\mdata\models\CountriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use moonland\phpexcel\Excel;
use arturoliveira\ExcelView;

use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;

/**
 * CountriesController implements the CRUD actions for Countries model.
 */
class CountriesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Countries models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CountriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Countries model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Countries model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Countries();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Countries model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Countries model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Countries model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Countries the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Countries::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    public function simpanDariXLS($data){

                $no                    =  (String)$data[0];
              
                $nama           =  $data[1];


               $obj = Countries::find()->where(['name'=>$nama])->one();
               
               if ($obj->id == null) {
                    # code...

                $model = new Countries;
                $model->name = $nama;
                $model->save();
                } 
                else{

                $obj->name = $nama;
                $obj->save();
                }

     
               

    }


    public function actionImport(){
           
        $ar_data = array();

             $modelImport = new  Countries([
            'fileImport' => 'File Import',
        ]);
          if(Yii::$app->request->post()) {
                  $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport,'fileImport');
             
                  if($modelImport->fileImport){
                    
                      $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
                      $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                      $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                      $objPHPExcel->setActiveSheetIndex(0);
                      $sheetData = $objPHPExcel->getActiveSheet();
                      $highestRow = $sheetData->getHighestRow(); // e.g. 10 
                      $highestColumn = $sheetData->getHighestColumn(); 
                      $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
                     $sheetDatas = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     array_shift($sheetDatas);    
                      for ($row =2; $row <= $highestRow; ++$row) { 
                          # code...
                             for ($col = 0; $col <= $highestColumnIndex; ++$col) {
                                   $ar_data[]=    $sheetData->getCellByColumnAndRow($col, $row)->getValue();
                          
                        
                                  
                                    }
                        $this->simpanDariXLS($ar_data);
        
                        
                        $ar_data=array();  
                          
                      } 
                             
 
                             
                      Yii::$app->getSession()->setFlash('success','Success');
                  }else{
                      Yii::$app->getSession()->setFlash('error','Error');
                  }
                  //die(print_r($sheetDatas));
        }   

        return $this->render('import',[
                'modelImport' => $modelImport,
            ]);
              
      

  }


public function actionImport2(){
   /*     $modelImport = new \yii\base\DynamicModel([
                    'fileImport'=>'File Import',
                ]);
        $modelImport->addRule(['fileImport'],'required');
        $modelImport->addRule(['fileImport'],'file',['extensions'=>'ods,xls,xlsx'],['maxSize'=>1024*1024]);
 */
          $modelImport = new Countries([
            'fileImport' => 'File Import',
        ]);

        if(Yii::$app->request->post()){
            $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport,'fileImport');

            if($modelImport->fileImport){
                
                 $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);

                      $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                      $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
                      
                      $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                $baseRow = 2;
                while(!empty($sheetData[$baseRow]['B'])){
                    $model = new \backend\mdata\models\Countries;
                    $model->name = (string)$sheetData[$baseRow]['B'];
                   // $model->description = (string)$sheetData[$baseRow]['C'];
                    $model->save();
                    $baseRow++;
                }
                Yii::$app->getSession()->setFlash('success','Success');
            }else{
                Yii::$app->getSession()->setFlash('error','Error');
            }
        }

        return $this->render('import',[
                'modelImport' => $modelImport,
            ]);
    }


}
