<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "tabeldetil".
 *
 * @property string $id
 * @property string $tabel_id
 * @property string $atribut
 * @property string $petunjuk
 * @property string $keterangan
 * @property string $catatan
 * @property int $status_id
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 *
 * @property Tabel $tabel
 * @property Status $status
 * @property User $createdBy
 * @property User $updatedBy
 */
class Tabeldetil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tabeldetil';
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
            [['tabel_id', 'status_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['atribut'], 'string', 'max' => 25],
            [['petunjuk'], 'string', 'max' => 200],
            [['keterangan'], 'string', 'max' => 1000],
            [['catatan'], 'string', 'max' => 10000],
            [['tabel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tabel::className(), 'targetAttribute' => ['tabel_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['atribut','petunjuk','tabel_id','status_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tabel_id' => Yii::t('app', 'Tabel ID'),
            'atribut' => Yii::t('app', 'Atribut'),
            'petunjuk' => Yii::t('app', 'Petunjuk'),
            'keterangan' => Yii::t('app', 'Keterangan'),
            'catatan' => Yii::t('app', 'Catatan'),
            'status_id' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabel()
    {
        return $this->hasOne(Tabel::className(), ['id' => 'tabel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
