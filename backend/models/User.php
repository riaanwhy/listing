<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;
use backend\models\Organisasi;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \common\models\User
{
    /**
     * @inheritdoc
     */
	
	
	public $password; //definisikan variable sebelum digunakan
	 
	 
    public static function tableName()
    {
        return 'user';
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['username', 'password', 'email', 'status'], 'required'],
           [['status'], 'integer'],
           [['image', 'created_at', 'updated_at','created_by','updated_by'], 'safe'],
           [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),      
            'password' => Yii::t('app', 'Password'),
            'image' => 'Image',
            //'auth_key' => Yii::t('app', 'Auth Key'),
            //'password_hash' => Yii::t('app', 'Password Hash'),
            //'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            //'created_at' => Yii::t('app', 'Created At'),
            //'updated_at' => Yii::t('app', 'Updated At'),
         
        ];
    }
	
	//sebelum disimpan generate hasing password (berlaku untuk create dan update)
	public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    public function getStatusBoolean()
    {   
        return $this->status ? 'Aktif' : 'Non-aktif';
    }

}
