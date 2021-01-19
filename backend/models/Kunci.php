<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;
use yii\web\IdentityInterface;
use common\models\User;

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
 * @property string $tglbuat
 */
class Kunci extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $current_password, $new_password, $confirm_password;
     
    private $_user;

    public static function tableName()
    {
        return '';
    }

     /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
     
            [['password_hash','auth_key', ], 'safe'],
           
            [['current_password','new_password','confirm_password'],'required'],
            [['new_password'], 'string', 'min' => '5','max' => 255],
            ['current_password', 'validatePassword'],
     
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
            //'image' => 'Image',
            //'auth_key' => Yii::t('app', 'Auth Key'),
            //'password_hash' => Yii::t('app', 'Password Hash'),
            //'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            //'email' => Yii::t('app', 'Email'),
            //'status' => Yii::t('app', 'Status'),
            //'created_at' => Yii::t('app', 'Created At'),
            //'updated_at' => Yii::t('app', 'Updated At'),
            //'tglbuat' => Yii::t('app', 'Tglbuat'),
            'current_password' => 'Current Password',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {

            $_user = User::findOne(Yii::$app->user->identity->id);
            if (!$_user || !$_user->validatePassword($this->current_password)) {
                $this->addError($attribute, 'Incorrect current password.');
            }
        }
    }
 
}
