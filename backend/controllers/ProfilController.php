<?php

namespace backend\controllers;

use Yii;
use backend\models\Profil;
use backend\models\ProfilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//Untuk Foto dan Filenya
use yii\web\UploadedFile;

/**
 * ProfilController implements the CRUD actions for Profil model.
 */
class ProfilController extends Controller
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
     * Displays a single Slider model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $id =Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        $dibuatoleh = '';
        $modelDibuatoleh = Yii::$app->DataInduk->cariPenggunaId($model->created_by);
        If (!empty($modelDibuatoleh)){$dibuatoleh = $modelDibuatoleh->username;}

        $diubaholeh = '';
        $modelDiubaholeh = Yii::$app->DataInduk->cariPenggunaId($model->updated_by);
        If (!empty($modelDiubaholeh)){$diubaholeh = $modelDiubaholeh->username;}

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dibuatoleh' => $dibuatoleh,
            'diubaholeh' => $diubaholeh,
        ]);
    }

    public function actionUpdate()
    {
        $id =Yii::$app->user->identity->id;
        $model = $this->findModel($id);

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
                   return $this->render('update', [
                        'model' => $model,
                 ]);
            }
      
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                //get the instance of the uploaded file
                //File merupakan variable buffer penyimpanan foto 
                                
                $direktorifiles = Yii::$app->params['direktoriimages'].'users/';

                //Upload Image
                $model->imageFile = UploadedFile::getInstance($model,'imageFile');
                //exit('video : '.$model->mediaFile);
                if (!empty($model->imageFile)) {

                    $fileunik =  $model->bikinStringAcakUnik('image',$model->imageFile->extension);
                    $imageName = $fileunik.'.'.$model->imageFile->extension;
                    

                    if ($model->uploadImage($direktorifiles, $imageName)) { //uploadIMEdia() fungsi di models/Slider.php 
                        
                        $image_hapus =  $model->image;
                        
                        //save the path in the db column
                        $model->image = $imageName;
                        if ($model->image!== $image_hapus ){
                            if (!empty($image_hapus)){
                                unlink($direktorifiles.$image_hapus); //Hapus yang lama
                            // unlink($direktorifiles.'thumb_'.$media_hapus);
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
     * Finds the Profil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Profil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $id =Yii::$app->user->identity->id ;
        if (($model = Profil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
