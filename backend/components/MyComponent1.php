<?php

namespace backend\components;
use yii\web\NotFoundHttpException;
use backend\models\Log;
use backend\models\Organisasi;
use backend\models\Organisasitingkat;
use backend\models\Pekerja;
use backend\models\Menukiri;

use Yii;
use yii\base\Component;

class MyComponent extends Component {
	
/* 	public function hello(){
		echo 'Hallo';
	} */
	
    public function getTanggalExcel($tanggal_excel) {
        $d=substr($tanggal_excel,0,2);
        $m=substr($tanggal_excel,3,2);
        if (strlen($tanggal_excel)>8) {
             $y=substr($tanggal_excel,6,4);
        }else{    
            $y=substr($tanggal_excel,6,2);
        } 

        $tanggal_import = $y.'-'.$m.'-'.$d; 
        If (!checkdate($m,$d,$y)){
             $m1=$d;
             $d1=$m;   
             $tanggal_import = $y.'-'.$m1.'-'.$d1; //dari excel suka ngaco jadi diusahakan bolak-balik
             If (!checkdate($m1,$d1,$y)){
                throw new NotFoundHttpException('Tanggal :'.$tanggal_import.' salah format!');
             }   
        }
         
        return $tanggal_import;
    }	
  
    public function toFloat($string) {
        $number = str_replace(',', '', $string);
        return floatval($number);
        
    }

 	public  function eventLog($key,$modul,$fungsi,$aksi,$informasi) {
 
        $model = new Log();
        $model->key = $key;
        $model->modul = $modul;
       	$model->fungsi = $fungsi;
       	$model->aksi = $aksi;
       	$model->informasi = $informasi;
        try {
        	 if (!($model->save())) {  
                 throw new NotFoundHttpException('Save log GAGAL!');
    		}	 
        } catch(\Exception $e) {
            \Yii::$app->session->setFlash('error','Exception save GAGAL!'); 
            throw $e;
        } catch(\Throwable $e) {
            \Yii::$app->session->setFlash('error','Throwable save GAGAL!'); 
            throw $e;
        }
     
    }

 	public function generateNoAnggota($kode,$konter,$panjang_konter = 4) {
		
		$format_number="%0".$panjang_konter."d";
		$cari=$kode.vsprintf($format_number,$konter);

		if(Pekerja::findOne(['image' => $cari]) == Null) {
			//Dicari pertama kali dng konter yg dikirim = 1, jika belum ada maka dijadikan nomor anggota yg pertama
			return $cari;
		}else{
			//dikonter terus sampai yg belum ada
			++$konter;
			return $this->generateNoAnggota($kode,$konter, $panjang_konter);
		}
		
	} 
	
 	public function bikinStringAcakUnik($atribut, $ekstensi, $panjang = 32) {
			
		$stringAcak = Yii::$app->getSecurity()->generateRandomString($panjang).'.'.$ekstensi;
				
		if(Pekerja::findOne([$atribut => $stringAcak]) == Null)
			return $stringAcak;
		else
			return $this->bikinStringAcakUnik($atribut, $ekstensi, $panjang);
			
	} 

    public static function getMenukiri($id,$lvl=0){
        if ($lvl==0)
        {
            $roots = Menukiri::find()->roots()->all();
            //$tmp=[];
            $tmp[0] = array('title'=>'MENU','label' => 'MENU');
            $tmp[1] = array('title'=>'HOME','label' => 'HOME', 'icon' => 'dashboard', 'url' => ['/site/index']);
            $x=2;
            //hanya untuk level 0, ini pertama kali dibaca
            foreach ($roots as $value) 
            {
                $tmp[$x]['title'] = $tmp[$x]['label'] = (!empty($value->name)) ? $value->name : 'KOSONG';
                $tmp[$x]['icon'] =(!empty($value->ikon)) ? $value->ikon : 'minus';
                $tmp[$x]['url'] = [(!empty($value->program)) ? $value->program : '#'];
                $tmp[$x]['children'] = Yii::$app->MyComponent->getMenukiri($value->id,1);
                if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                $x++;
            }

            //print_r($tmp);
            //exit();
            return $tmp;
            
        }else{
            //Semua level child
            $menukiri= Menukiri::findOne(['id' => $id]);
            $childs = $menukiri->children(1)->all();
            if(!empty($childs)){
                $x=0;
                foreach ($childs as $value1) 
                {
                    $tmp[$x]['title'] = $tmp[$x]['label'] = (!empty($value1->name)) ? $value1->name : 'KOSONG';
                    $tmp[$x]['icon'] =(!empty($value1->ikon)) ? $value1->ikon : 'arrow-right';
                    $tmp[$x]['url'] = [(!empty($value1->program)) ? $value1->program : '#'];
                    $tmp[$x]['children'] = Yii::$app->MyComponent->getMenukiri($value1->id,$value1->lvl);
                    if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                  $x++;      
                }
               
                return $tmp;
            }else{
                return false;
            }
        }    
    }
   
}
?>