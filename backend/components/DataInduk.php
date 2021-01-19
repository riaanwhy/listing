<?php

namespace backend\components;
use yii\web\NotFoundHttpException;
use backend\models\Log;
use backend\models\Preferensi;
use backend\models\Kontentipe;
use backend\models\Konten;
use backend\models\User;
use backend\models\Arsip;
use backend\models\Tabel;
use backend\models\Tabeldetil;
use backend\models\Bank;
use backend\models\Periode;
use backend\models\Anggaran;
use backend\models\Kalender;
use backend\models\Kalenderdetil;
use backend\models\Kurs;
use backend\models\Negara;
use backend\models\Akun;


use Yii;
use yii\base\Component;

class DataInduk extends Component {

    public function allKontentipe()
    {
        if ($model = Kontentipe::find()->asArray()->all()) {
             return $model;
        }
    }

    public function cariKontentipe($tipekonten)
    {
        if ($model = Kontentipe::findOne([strtolower('tipekonten') => strtolower($tipekonten)])) {
             return $model;
        }
    }
    
    public function cariKontentipeId($id)
    {
        if ($model = Kontentipe::findOne(['id' => $id])) {
             return $model;
        }
    }

    public function cariKontenId($id)
    {
        if ($model = Konten::findOne(['id' => $id])) {
             return $model;
        }
    }

    public function cariStatus($id)
    {
        if (($model = Status::findOne($id)) !== null) {
             return $model;
        }
    }   

   

    public function cariPreferensi($id) {
                    
        if (($model = Preferensi::findOne($id)) !== null) {
            return $model;
        }
    } 

	
    public function cariStatusId($id)
    {
        if (($model = Status::findOne($id)) !== null) {
             return $model;
        }
    }   

   
    public function cariPenggunaId($id)
    {
        if (($model = User::findOne($id)) !== null) {
             return $model;
        }
    }  

    public function cariPengguna($id)
    {
        if (($model = User::findOne($id)) !== null) {
             return $model;
        }
        
    } 
       
    public function cariArsip($id)
    {
         if (($model = Arsip::find()
            ->where('konten_id = '.$id)
            ->asArray()->all()) !== null) {
            return $model;
       } 
    }

 	public function cariAkun($id)
    {
        if ($model = Akun::findOne(['id'=> $id])) {
             return $model;
        }
    }
    
    public function cariHints($atribut)
    {
        if ($model = Tabeldetil::findOne(['atribut'=> $atribut])) {
             return $model;
        }
    }
    

    public function cariNegara($id)
    {
        if ($model = Negara::findOne(['id'=> $id])) {
             return $model;
        }
    }

    public function cariKurs($id)
    {
        if ($model = Kurs::findOne(['id'=> $id])) {
             return $model;
        }
    }

    public function cariBankId($id) {
                    
        if (($model = Bank::findOne($id)) !== null) {
            return $model;
        }
    } 
    public function cariPeriode($id) {
                    
        if (($model = Periode::findOne($id)) !== null) {
            return $model;
        }
    } 

    public function cariKalender($id) {
                    
        if (($model = Kalender::findOne($id)) !== null) {
            return $model;
        }
    } 

}
?>