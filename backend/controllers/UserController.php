<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Status;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
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
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->status==1){
            $status='Aktif';
        }else{    
            $status='Non-aktif';
        }

        $dibuatoleh = '';
        $modelDibuatoleh = Yii::$app->DataInduk->cariPenggunaId($model->created_by);
        If (!empty($modelDibuatoleh)){$dibuatoleh = $modelDibuatoleh->username;}

        $diubaholeh = '';
        $modelDiubaholeh = Yii::$app->DataInduk->cariPenggunaId($model->updated_by);
        If (!empty($modelDiubaholeh)){$diubaholeh = $modelDiubaholeh->username;}

        return $this->render('view', [
            'model' => $this->findModel($id),
            'status' => $status,
            'dibuatoleh' => $dibuatoleh,
            'diubaholeh' => $diubaholeh     
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        // return $this->redirect(['index', 'msg'=>Yii::t('app','Delete berhasil')]);

        $model = $this->findModel($id);
     
        // mulai database transaction
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model->delete();
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
    } //delete


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

