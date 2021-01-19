<?php

namespace backend\controllers;

use Yii;
use backend\models\Konten;
use backend\models\KontenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//Untuk Foto dan Filenya
use yii\web\UploadedFile;

/**
 * KontenController implements the CRUD actions for Konten model.
 */
class KontenController extends Controller
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
     * Lists all Konten models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KontenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //untuk breadcrums kembali ke halaman yg sama
        $session = Yii::$app->session;
        $session->remove('myPage');
        $_SESSION['myPage'] = Yii::$app->request->get('page');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Konten model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {  
        $model = $this->findModel($id);

        $dibuatoleh = '';
        $modelDibuatoleh = Yii::$app->DataInduk->cariPenggunaId($model->created_by);
        If (!empty($modelDibuatoleh)){$dibuatoleh = $modelDibuatoleh->username;}

        $diubaholeh = '';
        $modelDiubaholeh = Yii::$app->DataInduk->cariPenggunaId($model->updated_by);
        If (!empty($modelDiubaholeh)){$diubaholeh = $modelDiubaholeh->username;}

        $tipekonten = '';
        $modelKontentipe = Yii::$app->DataInduk->cariKontentipeId($model->tipekonten_id);
        If (!empty($modelKontentipe)){$tipekonten = $modelKontentipe->tipekonten;}

        return $this->render('view', [
            'model' => $this->findModel($id),
             'tipekonten' =>  $tipekonten,
             'dibuatoleh' => $dibuatoleh,
             'diubaholeh' => $diubaholeh,
                 
        ]);
    }


    /**
     * Creates a new Konten model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Konten();
  
      //Tambahkan untuk validasi tanggal  'enableAjaxValidation'=>true di _form jika tidak nanti tidak sempurna refreshnya
        if (Yii::$app->request->isAjax && $model->load($_POST)){
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

         // Post
        if ($model->load(Yii::$app->request->post())) {  
     
             // validate  models
            if (!$model->validate()){
                 \Yii::$app->session->setFlash('error',Yii::t('app', 'Data tidak sesuai rules')); 
        
                //untuk breadcrums kembali ke halaman yg sama
                $session = Yii::$app->session;
                $session->remove('myPage');
                $_SESSION['myPage'] = Yii::$app->request->get('page');

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
      
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                //get the instance of the uploaded file
                //File merupakan variable buffer penyimpanan foto 
                                
                $direktorifiles = Yii::$app->params['direktoriimages'];

                //Upload Image
                $model->imageFile = UploadedFile::getInstance($model,'imageFile');
                if (!empty($model->imageFile)) {

                    $fileunik =  $model->bikinStringAcakUnik('image',$model->imageFile->extension);
                    $imageName = $fileunik.'.'.$model->imageFile->extension;
                    
                    if ($model->uploadImage($direktorifiles, $imageName)) { //uploadImage() fungsi di models/Konten.php 
                        //Save dilakukan fungsi ini
                        $model->image = $imageName;
                    } 

                }        
              

                //Upload Video
                $model->videoFile = UploadedFile::getInstance($model,'videoFile');
                if (!empty($model->videoFile)) {

                    $fileunik =  $model->bikinStringAcakUnik('video',$model->videoFile->extension);
                    $videoName = $fileunik.'.'.$model->videoFile->extension;                  
                
                    if ($model->uploadVideo($direktorifiles, $videoName)) { //uploadVideo() fungsi di models/Konten.php 
                         //Save dilakukan fungsi ini
                         $model->video = $videoName;
                    } 

                }

               // simpan master record                   
                if ($model->save()) {
                    // sukses, commit database transaction
                    // kemudian tampilkan hasilnya
                    $transaction->commit();
                    if (empty($pesan)) {
                      \Yii::$app->session->setFlash('success',Yii::t('app', 'Simpan berhasil. ')); 
                    }else{
                      \Yii::$app->session->setFlash('warning',Yii::t('app', 'Simpan berhasil. '.$pesan));
                    }  
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    \Yii::$app->session->setFlash('error',Yii::t('app', 'Simpan gagal')); 
                    $transaction->rollBack();
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } catch (Exception $e) {
                // penyimpanan galga, rollback database transaction
                  \Yii::$app->session->setFlash('create',Yii::t('app', 'Coba buat gagal')); 
                $transaction->rollBack();
                throw $e;
            }

        }else{ 
            // Not yet post 
            $model->tanggal_publikasi = date('Y-m-d');
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Konten model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

       //Tambahkan untuk validasi tanggal  'enableAjaxValidation'=>true di _form jika tidak nanti tidak sempurna refreshnya
        if (Yii::$app->request->isAjax && $model->load($_POST)){
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        //filter yang sesuai dengan kontenakses agar terprotek dari url   
        $kontenakses_list = Yii::$app->MyComponent->getKontenaksesId($model->tipekonten_id);      
        if (count($kontenakses_list) == 0){
            throw new NotFoundHttpException(Yii::t('app', 'Tidak memiliki akses. '));
        }

         // Post
        if ($model->load(Yii::$app->request->post())) {  
        
             // validate  models
            if (!$model->validate()){
                 \Yii::$app->session->setFlash('error',Yii::t('app', 'Data tidak sesuai rules')); 
                   return $this->render('update', [
                        'model' => $model,
                 ]);
            }
  
            $transaction = \Yii::$app->db->beginTransaction();
            try {
   
                //get the instance of the uploaded file
                //File merupakan variable buffer penyimpanan foto 
                                
                $direktorifiles = Yii::$app->params['direktoriimages'];

                //Upload Image
                $model->imageFile = UploadedFile::getInstance($model,'imageFile');
                //exit('video : '.$model->imageFile);
                if (!empty($model->imageFile)) {

                    $fileunik =  $model->bikinStringAcakUnik('image',$model->imageFile->extension);
                    $imageName = $fileunik.'.'.$model->imageFile->extension;
                    

                    if ($model->uploadImage($direktorifiles, $imageName)) { //uploadImage() fungsi di models/Konten.php 
                        
                        $image_hapus =  $model->image;
                        
                        //save the path in the db column
                        $model->image = $imageName;
                        if ($model->image !== $image_hapus ){
                            if (!is_null($image_hapus)){
                                if (file_exists($direktorifiles.$image_hapus)) {
                                    unlink($direktorifiles.$image_hapus); //Hapus yang lama
                                    unlink($direktorifiles.'uk0_'.$image_hapus);
                                    unlink($direktorifiles.'uk1_'.$image_hapus);
                                    unlink($direktorifiles.'uk2_'.$image_hapus);
                                }    
                            }
                        }  
                    } 

                }        
            
                //Upload Video
                $model->videoFile = UploadedFile::getInstance($model,'videoFile');
            
                if (!empty($model->videoFile)) {
                    
                    $fileunik =  $model->bikinStringAcakUnik('video',$model->videoFile->extension);
                    $videoName = $fileunik.'.'.$model->videoFile->extension;                  
             
                    if ($model->uploadVideo($direktorifiles, $videoName)) { //uploadVideo() fungsi di models/Konten.php 
                        
                        
                        $video_hapus =  $model->video;
                        
                        //save the path in the db column
                        $model->video = $videoName;
                        if ($model->video !== $video_hapus ){
                            if (!is_null($video_hapus)){
                                unlink($direktorifiles.$video_hapus); //Hapus yang lama
                              
                            }
                        }  
                    } 

                }

               // simpan master record                   
                if ($model->save()) {
                    // sukses, commit database transaction
                    // kemudian tampilkan hasilnya
                    $transaction->commit();
                    if (empty($pesan)) {
                      \Yii::$app->session->setFlash('success',Yii::t('app', 'Ubah berhasil. ')); 
                    }else{
                      \Yii::$app->session->setFlash('warning',Yii::t('app', 'Ubah berhasil. '.$pesan));
                    }  
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    \Yii::$app->session->setFlash('error',Yii::t('app', 'Ubah gagal')); 
                    $transaction->rollBack();
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } catch (Exception $e) {
                // penyimpanan galga, rollback database transaction
                  \Yii::$app->session->setFlash('update',Yii::t('app', 'Coba ubah gagal')); 
                $transaction->rollBack();
                throw $e;
            }

        } // Post 

        return $this->render('update', [
            'model' => $model,
       ]);
    } //Update
    
    /**
     * Deletes an existing Konten model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

       // mulai database transaction
        $transaction = \Yii::$app->db->beginTransaction();
        try {
 
            // kemudian, delete master record
            $model->delete();
            $direktorifiles = Yii::$app->params['direktoriimages'];
            if (!is_null($model->image)) {
                if (file_exists($direktorifiles.$model->image)) {
                    unlink($direktorifiles.$model->image); 
                    unlink($direktorifiles.'uk0_'.$model->image);
                    unlink($direktorifiles.'uk1_'.$model->image);
                    unlink($direktorifiles.'uk2_'.$model->image);
                }    
             }
            if (!is_null($model->video)) {
                if (file_exists($direktorifiles.$model->video)) {
                    unlink($direktorifiles.$model->video); 
                }  
            }    
            // sukses, commit transaction
            \Yii::$app->session->setFlash('success',Yii::t('app', 'Hapus berhasil.')); 
  
            $transaction->commit();
        }catch (\yii\db\IntegrityException $e) {
            // do error handling
            \Yii::$app->session->setFlash('warning',Yii::t('app', 'Hapus gagal!, masih ada integritas dengan data lainnya!')); 

            $transaction->rollBack();     
        } catch (Exception $e) {
            // gagal, rollback database transaction
            \Yii::$app->session->setFlash('error',Yii::t('app', 'Hapus gagal!')); 

            $transaction->rollBack();
        }
     
        return $this->redirect(['index']);
    } //end actionDelete

    /**
     * Finds the Konten model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Konten the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Konten::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
