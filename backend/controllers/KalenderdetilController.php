<?php

namespace backend\controllers;

use Yii;
use backend\models\Kalenderdetil;
use backend\models\KalenderdetilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KalenderdetilController implements the CRUD actions for Kalenderdetil model.
 */
class KalenderdetilController extends Controller
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
     * Lists all Kalenderdetil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KalenderdetilSearch();
        if (!(empty($_GET['id']))) {
            $searchModel->kalender_id = $_GET['id'];
        }else{
            $searchModel->kalender_id = $_SESSION['$id'] ;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //untuk breadcrums kembali ke halaman yg  di detil
        $session = Yii::$app->session;
        $session->remove('myPage2');
        $_SESSION['myPage2'] = Yii::$app->request->get('page');
        $_SESSION['$id'] = $searchModel->kalender_id;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kalenderdetil model.
     * @param string $id
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
     * Creates a new Kalenderdetil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kalenderdetil();

        //Tambahkan untuk validasi tanggal  'enableAjaxValidation'=>true di _form jika tidak nanti tidak sempurna refreshnya
        if (Yii::$app->request->isAjax && $model->load($_POST)){
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
    
        $model->kalender_id = $_SESSION['$id']; //agar ke save untuk link dengan header
         // Post
        if ($model->load(Yii::$app->request->post())) {  
     
            // validate  models
            if (!$model->validate()){
                 \Yii::$app->session->setFlash('error',Yii::t('app', 'Data tidak sesuai rules')); 
                  return $this->redirect(['index']);
            }
    
            $transaction = \Yii::$app->db->beginTransaction();
            try {

                // simpan master record                   
                if ($model->save()) {
                    // sukses, commit database transaction
                    // kemudian tampilkan hasilnya
                    $transaction->commit();
                    \Yii::$app->session->setFlash('success',Yii::t('app', 'Cipta berhasil.')); 
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $transaction->rollBack();
                    \Yii::$app->session->setFlash('error',Yii::t('app', 'Simpan gagal')); 
                    return $this->redirect(['index', 'page' => Yii::$app->session['myPage']]);
                }
            } catch (Exception $e) {
                // penyimpanan gagal, rollback database transaction
                \Yii::$app->session->setFlash('error',Yii::t('app', 'Coba simpan gagal')); 
                $transaction->rollBack();
                throw $e;
            }

        } // Post 

        return $this->renderAjax('create', [
            'model' => $model,

        ]); 
    }

    /**
     * Updates an existing Kalenderdetil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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

         // Post
        if ($model->load(Yii::$app->request->post())) {  
     
            // validate  models
            if (!$model->validate()){
                 \Yii::$app->session->setFlash('error',Yii::t('app', 'Data tidak sesuai rules')); 
                 return $this->redirect(['index', 'page' => Yii::$app->session['myPage']]);
            }
      
            $transaction = \Yii::$app->db->beginTransaction();
            try {
              
                // simpan master record                   
                if ($model->save()) {
                    // sukses, commit database transaction
                    // kemudian tampilkan hasilnya
                    $transaction->commit();
                    \Yii::$app->session->setFlash('success',Yii::t('app', 'Ubah berhasil.'));                   
                    return $this->redirect(['view', 'id' => $model->id]);

                } else {
                   \Yii::$app->session->setFlash('error',Yii::t('app', 'Ubah gagal')); 
                   $transaction->rollBack();
                   return $this->redirect(['index', 'page' => Yii::$app->session['myPage']]);
                }
            } catch (Exception $e) {
                // penyimpanan galga, rollback database transaction

                  \Yii::$app->session->setFlash('update',Yii::t('app', 'Coba ubah gagal')); 
                $transaction->rollBack();
                throw $e;
            }

        } // Post 

        return $this->renderAjax('update', [
            'model' => $model,
       ]);
    }

    /**
     * Deletes an existing Kalenderdetil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kalenderdetil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kalenderdetil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kalenderdetil::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
