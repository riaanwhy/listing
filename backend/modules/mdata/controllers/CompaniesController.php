<?php

namespace backend\modules\mdata\controllers;

use Yii;
use backend\modules\mdata\models\Companies;
use backend\modules\mdata\models\Countries;
use backend\modules\mdata\models\Sectors;
use backend\modules\mdata\models\TmpSelected;


use backend\modules\mdata\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use moonland\phpexcel\Excel;
use arturoliveira\ExcelView;

use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;


/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
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
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companies model.
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
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Companies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Companies model.
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
     * Deletes an existing Companies model.
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
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



      public function simpanDariXLS($data){

                $no                    =  (String)$data[0];

                $sic_code              =  (String)$data[1];

                $nama                  =  (String)$data[2];

                $sector                =  (String)$data[3];

                $sub_sector             =  (String)$data[4];

                $country               =  (String)$data[5];

                $exchange              =  $data[6];

                $website               =  $data[7];

                $profile                =  $data[8];


               $coun = new Countries();
               $coun = Countries::find()->where(['name'=>$country])->one(); 
               $obj = new Companies();
               $obj = Companies::find()->where(['country'=>$coun->id,'name'=>$nama])->one();


               $sect = new Sectors();
               $sect = Sectors::find()->where(['name'=>$sector])->one();
               $obj = new Companies;
               $obj = Companies::find()->where(['sector'=>$sect->id,'name'=>$nama])->one();

               $sect = new Sectors();
               $sect = Sectors::find()->where(['name'=>$sub_sector])->one();
               $obj = new Companies;
               $obj = Companies::find()->where(['sub_sector'=>$sect->id,'name'=>$nama])->one();
               

        /*       $comp = new Companies();
               $comp = Companies::find()->where(['name'=>$company_id])->one();
               $obj = new Finances();
               $obj = Finances::find()->where(['company_id'=>$comp->id,'year'=>$year])->one(); */
          //     die(print_r($coun->name));
               
               if (empty($obj)) {
                    # code...

                $model = new Companies;
                $model->name = $nama;
                $model->sic_code = $sic_code;
                $model->sector = $sect->id;
                $model->sub_sector = $sect->id;
                $model->country = $coun->id;
                $model->exchange = $exchange;
                $model->website = $website;
                $model->profile = $profile;
                $model->save();
                } 
                else{

                $obj->name = $nama;
                $obj->sic_code = $sic_code;
                $obj->sector = $sect->id;
                $obj->sub_sector = $sect->id;
                $obj->country = $coun->id;
                $obj->exchange = $exchange;
                $obj->website = $website;
                $obj->profile = $profile;
                $obj->save();
                }
               

    }


    public function actionImport(){
           
        $ar_data = array();

             $modelImport = new  Companies([
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
       $modelImport = new Companies([
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
                    $model = new \backend\mdata\models\Companies;
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


     public function actionBulkacc(){
    $action=Yii::$app->request->post('action');
    $selection=(array)Yii::$app->request->post('selection');//typecasting
    
    if ($selection == null ) {
        # code... 
        Yii::$app->session->setFlash('error', "No one's data selected !!  Please, Selected one data or more to this action ");
    }
    else {


                if (isset($_POST['trm'])) {
                      foreach($selection as $id){

                        $selected=Companies::findOne((int)$id);//make a typecasting
                      
                        $objTmp = new TmpSelected();
                        $objTmp->companies_id = $selected->id;
                        $objTmp->save();

                   

                      }
                  Yii::$app->session->setFlash('success', "Succes selected data ");

                      
                       return $this->redirect(['/mdata/tmp-selected/index']);
                        Yii::$app->session->setFlash('success', "Succes selected data ");

                }//tutup if

    }


     return $this->redirect('index');
  }



    public function actionExptmp(){

            $fileType = 'Excel2007';
       $template = Yii::getAlias('@backend/web').'/format_import_companies.xlsx';
                
            $objReader = \PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load($template);

            $objPHPExcel->getProperties()->setCreator("Riyan Wahyudi");
            $objPHPExcel->getProperties()->setLastModifiedBy("Riyan Wahyudi");
            $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
            $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
            $objPHPExcel->getProperties()->setDescription("Test document , generated using PHP classes.");

           
            $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel,'Excel2007');
            header('Content-type: application/vnd.ms-excel');
     header('Content-Disposition: attachment; filename="import_companies.xlsx"');

            header("Pragma: no-cache");
            header("Expires: 0");
           
            // Write file to the browser
            $objWriter->save('php://output');
           // $objWriter->save($template);
    }
}
