<?php

namespace backend\components;
use yii\web\NotFoundHttpException;
use backend\models\Log;
use backend\models\Organisasi;
use backend\models\Organisasitingkat;
use backend\models\Menukiri;
use backend\models\Menuheader;
use backend\models\Kontentipe;
use backend\models\Kontenakses;
use yii\helpers\Html;
use Yii;
use yii\base\Component;
use backend\models\AuthAssignment;


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
    
    /*ini validasi cek di fisik folder*/
 	public function fileUnik($direktoridokumen, $ekstensi, $panjang = 32) {

		$file_pointer = Yii::$app->getSecurity()->generateRandomString($panjang).'.'.$ekstensi;         
        if (!file_exists($direktoridokumen.$file_pointer))  
			return $file_pointer;
		else
			return $this->fileUnik($direktoridokumen, $ekstensi, $panjang);
			
	} 

    /*ini validasi cek di tabel Pekerja, atribut nama kolomnya*/
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


                if (!empty($value->name)){
                    //if (Yii::$app->user->can($value->name) OR Yii::$app->user->can('bebas')  
                    //print_r($value->name);exit();
                    if (Yii::$app->user->can($value->name) OR Yii::$app->user->can('All'))
                    {
                        $tmp[$x]['title'] = $tmp[$x]['label'] = (!empty($value->name)) ? $value->name : 'KOSONG';
                        $tmp[$x]['icon'] =(!empty($value->ikon)) ? $value->ikon : 'minus';
                        $tmp[$x]['options'] = [(!empty($value->opsi)) ? $value->opsi : ''];
                 
                        $tmp[$x]['url'] = [(!empty($value->program)) ? '/'.$value->program : '#'];
                        $tmp[$x]['children'] = Yii::$app->MyComponent->getMenukiri($value->id,1);
                        if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                        $x++;
                    }    
                }
            }

            //print_r($tmp);
            //exit();
            if ($x > 0 ) return $tmp;
            
        }else{
            //Semua level child
            $menukiri= Menukiri::findOne(['id' => $id]);
            $childs = $menukiri->children(1)->all();
            if(!empty($childs)){
                $x=0;
                foreach ($childs as $value1) 
                {
                    if (empty($value1->name)) continue;
                    $tmp[$x]['title'] = $tmp[$x]['label'] = (!empty($value1->name)) ? $value1->name : 'KOSONG';
                    $tmp[$x]['icon'] =(!empty($value1->ikon)) ? $value1->ikon : 'arrow-right';
                    $tmp[$x]['options'] = [(!empty($value1->opsi)) ? $value1->opsi : ''];
                    $tmp[$x]['url'] = [(!empty($value1->program)) ? '/'.$value1->program : '#'];
                    
                    
          
                    
                    //$tmp[$x]['visible'] = (Yii::$app->user->can($value1->name) ) ? true : false;
                    $tmp[$x]['children'] = Yii::$app->MyComponent->getMenukiri($value1->id,$value1->lvl);
                    if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                    $x++;      
                    
                }
                //print_r($tmp);
                if ($x > 0 ) return $tmp;
            }else{
                return false;
            }

        }    
    } //getMenukiri

   
    public static function getMenuheader($id,$lvl=0){
        if ($lvl==0)
        {
            $roots = Menuheader::find()->roots()->all();
            //$tmp=[];
            $tmp[0] = array('title'=>'BERANDA',
                'label' => '<i class="fa fa-home"></i>HOME',
                'url' => ['/site/index']);
   

            $x=1;
            //hanya untuk level 0, ini pertama kali dibaca
            foreach ($roots as $value) 
            {


                if (!empty($value->name)){
                    //if (Yii::$app->user->can($value->name) OR Yii::$app->user->can('bebas')  
                    //print_r($value->name);exit();
                    //if (Yii::$app->user->can($value->name) OR Yii::$app->user->can('bebas')   )
                    if (true)
                    {
                        $tmp[$x]['title'] = $tmp[$x]['label'] = (!empty($value->name)) ? $value->name : 'KOSONG';
                        $tmp[$x]['icon'] =(!empty($value->ikon)) ? $value->ikon : 'minus';
                        $tmp[$x]['linkOptions'] = [(!empty($value->opsi)) ? $value->opsi : ''];
                 
                        $tmp[$x]['url'] = [(!empty($value->program)) ? '/'.$value->program : '#'];

                        if(stristr($value->program, 'http')) {
                            //print_r('opsi '.$value1->opsi);
                            //$tmp[$x]['linkOptions'] = ['target'=>'_blank'];
                            $tmp[$x]['options'] = ['target'=>'_blank'];
                            $tmp[$x]['url'] = ['/external?link='.$value->program]; 
                        }   

                        $tmp[$x]['children'] = Yii::$app->MyComponent->getMenuheader($value->id,1);
                        if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                        $x++;
                    }    
                }
            }
            if (!Yii::$app->user->isGuest) {
                $tmp[$x]['title'] = $tmp[$x]['label'] = 'BACKEND';        
                $tmp[$x]['url'] = [Html::encode('/'.Yii::$app->params['url_admin'])];
            }   
            //print_r($tmp);
            //exit();
            if ($x > 0 ) return $tmp;
            
        }else{
            //Semua level child
            $menuheader= Menuheader::findOne(['id' => $id]);
            $childs = $menuheader->children(1)->all();
            if(!empty($childs)){
                $x=0;
                foreach ($childs as $value1) 
                {
                    if (empty($value1->name)) continue;
                    $tmp[$x]['title'] = $tmp[$x]['label'] = (!empty($value1->name)) ? $value1->name : 'KOSONG';
                    $tmp[$x]['icon'] =(!empty($value1->ikon)) ? $value1->ikon : 'arrow-right';
                    if(!empty($value1->opsi)){
                        list($key, $value)=explode("=>",$value1->opsi);
                        $tmp[$x]['linkOptions'] = [$key=>$value];
                    }
                                 
                    $tmp[$x]['url'] = [(!empty($value1->program)) ? '/'.$value1->program : '#'];
                 
                    if(stristr($value1->program, 'http')) {
                        //print_r('opsi '.$value1->opsi);
                        //$tmp[$x]['linkOptions'] = ['target'=>'_blank'];
                        $tmp[$x]['options'] = ['target'=>'_blank'];
                        $tmp[$x]['url'] = ['/external?link='.$value1->program]; 
                    }    
 /*                    
                    if (!Yii::$app->user->can('bebas')) {
                        if (!Yii::$app->user->can($value1->program.'/*')){
                            //Jika tidak ada permision atau di tabel auth_item_child
                            //untuk view,delete dll dicek pada masing2 program untuk tampilan button 
                            $tmp[$x]['url'] = ['#'];
                            $tmp[$x]['icon'] = 'remove';
                        }
                    }  */   
                    
                    //$tmp[$x]['visible'] = (Yii::$app->user->can($value1->name) ) ? true : false;
                    $tmp[$x]['children'] = Yii::$app->MyComponent->getMenuheader($value1->id,$value1->lvl);
                    if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                    $x++;      
                    
                }
                //print_r($tmp);
                if ($x > 0 ) return $tmp;
            }else{
                return false;
            }

        }    
    } //getTopmenu
       

    
    
    public static function getKontentipe($id,$lvl=0){
       
            //Level root dilewatin hanya ambil semua level child tapi @id sudah diisi di getKontentipe()
            $kontentipe= Kontentipe::findOne(['id' => $id]);
            $childs = $kontentipe->children(1)->all();
            if(!empty($childs)){
                $x=0;
                foreach ($childs as $value1) 
                {
                    if (empty($value1->name)) continue;
                    $tmp[$x]['title'] = $tmp[$x]['label'] = (!empty($value1->name)) ? $value1->name : 'KOSONG';
                    $tmp[$x]['icon'] =(!empty($value1->ikon)) ? $value1->ikon : 'arrow-right';
                    if(!empty($value1->opsi)){
                        list($key, $value)=explode("=>",$value1->opsi);
                        $tmp[$x]['linkOptions'] = [$key=>$value];
                    }
                                 
                    $tmp[$x]['url'] = [(!empty($value1->program)) ? '/'.$value1->program.'?kategori_id='.$value1->id : '#'];
                 
                    if(stristr($value1->program, 'http')) {
                        //print_r('opsi '.$value1->opsi);
                        $tmp[$x]['url'] = ['/external?link='.$value1->program]; 
                    }    
                    $tmp[$x]['children'] = Yii::$app->MyComponent->getKontentipe($value1->id,$value1->lvl);
                    if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                    $tmp[$x]['options'] = ['class'=>'dropdown'];
                    $x++;      
                    
                }
                //print_r($tmp);
                if ($x > 0 ) return $tmp;
            }else{
                return false;
            }

      
    } //getTopmenu


    public static function getOrganisasi($id,$lvl=0){
        if ($lvl==0)
        {
            $roots = Organisasi::find()->roots()->all();
            $tmp=[];
            $x=0;
            //hanya untuk level 0, ini pertama kali dibaca
            foreach ($roots as $value) 
            {

                if (!empty($value->name)){
        
                        $tmp[$x]['title'] = $tmp[$x]['label'] = Html::a(Yii::t('app', $value->name), ['view?id='.$value->id], ['class' => 'btn btn-warning']);
                        $tmp[$x]['children'] = Yii::$app->MyComponent->getOrganisasi($value->id,1);
                        if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                        $x++;
                     
                }
            }
            //print_r($tmp);
            //exit();
            if ($x > 0 ) return $tmp;
            
        }else{
            //Semua level child
            $menuheader= Organisasi::findOne(['id' => $id]);
            $childs = $menuheader->children(1)->all();
            if(!empty($childs)){
                $x=0;
                foreach ($childs as $value1) 
                {
                    if (empty($value1->name)) continue;
                    $tmp[$x]['title'] = $tmp[$x]['label'] = Html::a(Yii::t('app', $value1->name), ['view?id='.$value1->id], ['class' => 'btn btn-info']);
                    $tmp[$x]['children'] = Yii::$app->MyComponent->getOrganisasi($value1->id,$value1->lvl);
                    if(!empty($tmp[$x]['children'])) $tmp[$x]['items'] = $tmp[$x]['children'];
                    $x++;      
                    
                }
                //print_r($tmp);
                if ($x > 0 ) return $tmp;
            }else{
                return false;
            }

        }    
    } //getTopmenu
       
    public static function getKontenakses()
    {
        //filter yang sesuai dengan kontenakses    
        $kontensakses_array= [];
        $modelKontenakses = Kontenakses::find()->where('user_id='.Yii::$app->user->identity->id)->all();
        foreach ($modelKontenakses as $value) 
        {
            $kontensakses_array[] = $value->tipekonten_id;        
        } 
        return $kontensakses_array;

    }    

    public static function getKontenaksesId($tipe_id)
    {
        //filter yang sesuai dengan kontenakses   
        $kontensakses_array = []; 
        $modelKontenakses = Kontenakses::find()
            ->where('user_id='.Yii::$app->user->identity->id.' AND tipekonten_id='.$tipe_id)
            ->all();
        foreach ($modelKontenakses as $value) 
        {
            $kontensakses_array[] = $value->tipekonten_id;        
        } 
        return $kontensakses_array;

    } 

    public static function listKontenakses()
    {
        //filter yang sesuai dengan kontenakses    
        $modelKontenakses = Kontenakses::find()->where('user_id='.Yii::$app->user->identity->id)->all();
        $kontensakses_array=[];
        foreach ($modelKontenakses as $value) 
        {
            $modelKontentipe = Kontentipe::findOne(['id' => $value->tipekonten_id]);
            If (!empty($modelKontentipe))
            {
                $kontensakses_array[] = $modelKontentipe->tipekonten; 
            }
                   
        } 
        return $kontensakses_array;
    } 

    public static function listAssignment()
    {
        //filter yang sesuai dengan assignement    
        $modelAssignment = AuthAssignment::find()->where('user_id='.Yii::$app->user->identity->id)->all();
        $assignment_array=[];
        foreach ($modelAssignment as $value) 
        {
           
                $assignment_array[] = $value['item_name']; 
           
                   
        } 
        return $assignment_array;
    } 

}
?>