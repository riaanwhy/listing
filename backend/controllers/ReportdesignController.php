<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\web\Response;
use yii\helpers\Html;

/**
 * RawinimpController implements the CRUD actions for Rawinimp model.
 */
class ReportdesignController extends Controller
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
     * Lists all Rawinimp models.
     * @return mixed
     */
    public function actionIndex()
    {
         
        $model = new \yii\base\DynamicModel();    
     
        return $this->render('index',['model' => $model]);
    }
  
}
