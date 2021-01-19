<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;
use backend\models\Profil;

use yii\imagine\Image;
/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id ID#
 * @property string $username Pengguna
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email E-mail
 * @property string $image Foto
 * @property int $aplikasi_id
 * @property int $organisasi_id
 * @property int $status Status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Profil extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
             [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                //'value' => new Expression('NOW()'), hanya jika type field 'datetime', jika integer ditutup saja
            ],
            [
                 'class' => BlameableBehavior::className(),
                 'createdByAttribute' => 'created_by',
                 'updatedByAttribute' => 'updated_by',
            ],   

        ];
    }   
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [[ 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['username'], 'string', 'max' => 25],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [
                'imageFile', 
                'file', 
                //'skipOnEmpty' => false, //Jika harus isi dibuka commentnya
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType'=>false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'image' => Yii::t('app', 'Image'),
            'imageFile' => Yii::t('app', 'Avatar'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    //Untuk nama image dan video
    public function bikinStringAcakUnik($atribut, $ekstensi, $panjang = 32) {
        $filename = Yii::$app->getSecurity()->generateRandomString($panjang);
        $stringAcak = $filename.'.'.$ekstensi;
                
        if(Profil::findOne([$atribut => $stringAcak]) == Null)
            return $filename; //nama file image disamakan dng nama video
        else
            return $this->bikinStringAcakUnik($atribut, $ekstensi, $panjang);
            
    } 

    public function uploadImage($direktori,$namafile,$newWidth = 1000,$newHeight  = 500)
    {
        if ($namafile == Null) {
            return false;
        }    
        if ($this->validate()) {
            $this->imageFile->saveAs($direktori . $namafile);
            //crop jalan tapi lagi ditutup
         /*   Image::thumbnail($direktori.$namafile,$newWidth ,$newHeight)
              ->save(Yii::getAlias($direktori.'thumb_'.$namafile), ['quality' => 100]);  */
            return true;
        } else {
            return false;
        }
    }
}
