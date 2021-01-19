<?php

namespace backend\controllers;

use Yii;
use backend\models\Kalender;
use backend\models\KalenderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KalenderController implements the CRUD actions for Kalender model.
 */
class KalenderController extends Controller
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
     * Lists all Kalender models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KalenderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	/* 	// validate if there is a editable input saved via AJAX
		if (Yii::$app->request->post('hasEditable')) {
			// instantiate your Kalender model for saving
			$kalenderId = Yii::$app->request->post('editableKey');
			$model = Kalender::findOne($kalenderIdId);

			// store a default json response as desired by editable
			$out = Json::encode(['output'=>'', 'message'=>'']);

			// fetch the first entry in posted data (there should only be one entry 
			// anyway in this array for an editable submission)
			// - $posted is the posted data for Kalender without any indexes
			// - $post is the converted array for single model validation
			$posted = current($_POST['Kalender']);
			$post = ['Kalender' => $posted];

			// load model like any single model validation
			if ($model->load($post)) {
			// can save model or do something before saving model
			$model->save();

			// custom output to return to be displayed as the editable grid cell
			// data. Normally this is empty - whereby whatever value is edited by
			// in the input by user is updated automatically.
			$output = '';


			$out = Json::encode(['output'=>$output, 'message'=>'']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		} */
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kalender model.
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
     * Creates a new Kalender model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kalender();

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
                   return $this->render('create', [
                        'model' => $model,
                 ]);
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
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } catch (Exception $e) {
                // penyimpanan gagal, rollback database transaction
                  \Yii::$app->session->setFlash('error',Yii::t('app', 'Coba simpan gagal')); 
                $transaction->rollBack();
                throw $e;
            }

        } // Post 

        return $this->render('create', [
            'model' => $model,

        ]);      

    }//Create

    /**
     * Updates an existing Kalender model.
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
                   return $this->render('update', [
                        'model' => $model,
                 ]);
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
     * Deletes an existing Kalender model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        $model = $this->findModel($id);
        $modelDetil = $model->kalenderdetils; //di /models/kalender.php pada getKalenderdetils()
     
        // mulai database transaction
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            // pertama, delete semua detail records
            foreach ($modelDetil as $detil) {
                $detil->delete();
            }
            // kemudian, delete master record
            $model->delete();
            // sukses, commit transaction
            \Yii::$app->session->setFlash('success',Yii::t('app', 'Hapus berhasil.')); 
 
            $transaction->commit();
     
        } catch (Exception $e) {
            // gagal, rollback database transaction
            \Yii::$app->session->setFlash('error',Yii::t('app', 'Hapus gagal!')); 

            $transaction->rollBack();
        }
     
        return $this->redirect(['index']);
    } //end actionDelete

    /**
     * Finds the Kalender model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kalender the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kalender::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
