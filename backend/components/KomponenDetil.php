<?php
//Harus didaftarkan dulu di backend\config\main.php
namespace backend\components;
use yii\web\NotFoundHttpException;
use backend\models\Kursdetil;
use backend\models\Costcenterdetil;
use backend\models\Kalenderdetil;

use Yii;
use yii\base\Component;

class KomponenDetil extends Component {
 

   public function cariKalenderdetil($header_id)
    {
        if ($model = Kalenderdetil::findOne(['kalender_id'=> $header_id])) {
             return $model;
        }
    }
	public function cariKursdetil($header_id)
    {
        if ($model = Kursdetil::findOne(['kurs_id'=> $header_id])) {
             return $model;
        }
    }

	public function cariCostcenterdetil($header_id)
    {
        if ($model = Costcenterdetil::findOne(['costcenter_id'=> $header_id])) {
             return $model;
        }
    }
}
?>