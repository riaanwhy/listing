<?php

namespace backend\controllers;

use Yii;
use backend\models\Kontenakses;
use backend\models\KontenaksesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KontenaksesController implements the CRUD actions for Kontenakses model.
 */
class KontenaksesController extends Controller
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
     * Lists all Kontenakses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KontenaksesSearch();
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
     * Displays a single Kontenakses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {  
        $model = $this->findModel($id);
        $userakses = '';
        $modelUser = Yii::$app->DataInduk->cariPenggunaId($model->user_id);
        If (!empty($modelUser)){$userakses = $modelUser->username;}

        $tipekonten = '';
        $modelKontentipe = Yii::$app->DataInduk->cariKontentipeId($model->tipekonten_id);
        If (!empty($modelKontentipe)){$tipekonten = $modelKontentipe->tipekonten;}

        $dibuatoleh = '';
        $modelDibuatoleh = Yii::$app->DataInduk->cariPenggunaId($model->created_by);
        If (!empty($modelDibuatoleh)){$dibuatoleh = $modelDibuatoleh->username;}

        $diubaholeh = '';
        $modelDiubaholeh = Yii::$app->DataInduk->cariPenggunaId($model->updated_by);
        If (!empty($modelDiubaholeh)){$diubaholeh = $modelDiubaholeh->username;}   

        return $this->render('view', [
            'model' => $this->findModel($id),
             'userakses' => $userakses,
             'tipekonten' =>  $tipekonten,
             'dibuatoleh' => $dibuatoleh,
             'diubaholeh' => $diubaholeh,
                 
        ]);
    }

    /**
     * Creates a new Kontenakses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kontenakses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kontenakses model.
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
     * Deletes an existing Kontenakses model.
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
     * Finds the Kontenakses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kontenakses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kontenakses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
