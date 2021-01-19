<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "kalender".
 *
 * @property string $id
 * @property string $fiskal
 * @property int $tutup
 * @property int $terkini
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 *
 * @property Anggaran[] $anggarans
 * @property Kalenderdetil[] $kalenderdetils
 */
class Kalender extends \yii\db\ActiveRecord
{
   
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
    public static function tableName()
    {
        return 'kalender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fiskal','tgl_awal', 'tgl_akhir'], 'safe'], 
            [['tutup', 'terkini', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fiskal' => Yii::t('app', 'Fiskal'),
            'tutup' => Yii::t('app', 'Tutup'),
            'tgl_awal' => Yii::t('app', 'Tgl Awal'),
            'tgl_akhir' => Yii::t('app', 'Tgl Akhir'),
            'terkini' => Yii::t('app', 'Terkini'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnggarans()
    {
        return $this->hasMany(Anggaran::className(), ['kalender_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalenderdetils()
    {
        return $this->hasMany(Kalenderdetil::className(), ['kalender_id' => 'id']);
    }
}
