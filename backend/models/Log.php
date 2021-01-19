<?php

namespace backend\models;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "log".
 *
 * @property string $id
 * @property string $key nama tabel
 * @property string $modul #id dari tabel tsb
 * @property string $fungsi
 * @property string $aksi
 * @property string $informasi
 * @property int $created_at
 * @property int $created_by
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }
    public function behaviors()
    {
        return [
             [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
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
            [['created_at', 'created_by'], 'integer'],
            [['key', 'modul', 'fungsi'], 'string', 'max' => 50],
            [['aksi'], 'string', 'max' => 25],
            [['informasi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'modul' => 'Modul',
            'fungsi' => 'Fungsi',
            'aksi' => 'Aksi',
            'informasi' => 'Informasi',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
