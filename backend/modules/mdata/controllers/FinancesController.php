<?php

namespace backend\modules\mdata\controllers;

use Yii;
use backend\modules\mdata\models\Finances;
use backend\modules\mdata\models\FinancesSearch;

use backend\modules\mdata\models\Companies;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use moonland\phpexcel\Excel;
use arturoliveira\ExcelView;

use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;
/**
 * FinancesController implements the CRUD actions for Finances model.
 */
class FinancesController extends Controller
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
     * Lists all Finances models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FinancesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Finances model.
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
     * Creates a new Finances model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Finances();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Finances model.
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
     * Deletes an existing Finances model.
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
     * Finds the Finances model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Finances the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Finances::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
     public function simpanDariXLS($data){

                $no                     =  (String)$data[0];
                $company_id             = (String) $data[1];  // pkae string
                $year                   =  $data[2];
                $sales                  =  $data[3];
                $cogs                   =  $data[4];
                $adm_expense            =  $data[5];
                $sales_expense          =  $data[6];
                $dep_expense            =  $data[7];
                $gm                     =  $data[8];
                $nm                     =  $data[9];
                $gm_percent             =  $data[10];
                $nm_percent             =  $data[11];


               $comp = new Companies();
               $comp = Companies::find()->where(['name'=>$company_id])->one();
               $obj = new Finances();
               $obj = Finances::find()->where(['company_id'=>$comp->id,'year'=>$year])->one();
               
               // jika data yg di cari kosong
             //  die(print_r($comp->id));

            if (empty($obj)) {
              
              // masukan data baru
                $model = new Finances;
                $model->company_id = $comp->id;
                $model->year = $year;
                $model->sales = $sales;
                $model->cogs = $cogs;
                $model->adm_expense = $adm_expense;
                $model->sales_expense = $sales_expense;
                $model->dep_expense = $dep_expense;
                $model->gm = $gm;
                $model->nm = $nm;
                $model->gm_percent = $gm_percent;
                $model->nm_percent = $nm_percent;
                
                $model->save();
                
                } 
                else{

                $obj->company_id = $company_id;
                $obj->year = $year;
                $obj->sales = $sales;
                $obj->cogs = $cogs;
                $obj->adm_expense = $adm_expense;
                $obj->sales_expense = $sales_expense;
                $obj->dep_expense = $dep_expense;
                $obj->gm = $gm;
                $obj->nm = $nm;
                $obj->gm_percent = $gm_percent;
                $obj->nm_percent = $nm_percent;
                $obj->save();
                }

     
               

    }


    public function actionImport(){
           
        $ar_data = array();

             $modelImport = new  Finances([
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
          $modelImport = new Finances([
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
                    $model = new \backend\mdata\models\Finances;
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
