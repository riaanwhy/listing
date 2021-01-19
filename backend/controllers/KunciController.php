<?php

namespace backend\controllers;
use common\models\User;

use Yii;
//use backend\models\User;
use backend\models\Kunci;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\web\IdentityInterface;

/**
 * RawinimpController implements the CRUD actions for Rawinimp model.
 */
class KunciController extends Controller
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

    public function actionIndex()
    {
        
        $model = New Kunci();

        if ($model->load(Yii::$app->request->post())) {  

             // validate  models
            if (!$model->validate()){
                \Yii::$app->session->setFlash('error','Lengkapi sesuai rule.');
                return $this->render('index',['model' => $model]);
            }

            // if (!$user->validatePassword($this->password)){
            //     $this->addError($attribute, 'Incorrect username or password.');
            //     return $this->render('index',['model' => $model]);
            // }

            $modelUser = User::findOne(Yii::$app->user->identity->id);
            if (!empty($modelUser)){
                
                $modelUser->setPassword($model->new_password);
                $modelUser->generateAuthKey();
               
               //hash = v7kvgpSMYM7TZZ_EibQhkSuR8UWBrmay
               //auth = $2y$13$SX2eZxnHg/KYtqgGFIV.UeYBe/cugCgEwj//OVqGxRsw2oVhJmQmy
             
                if ($modelUser->save()) {
                 \Yii::$app->session->setFlash('success','Perubahaan berhasil.'); 
                }else{
                     \Yii::$app->session->setFlash('error','Perubahaan gagal.'); 
                } 
            }else {
                 \Yii::$app->session->setFlash('error','Tidak ketemu username-nya'); 
            }
       
        }
        
        return $this->render('index',['model' => $model]);
    }

 
}