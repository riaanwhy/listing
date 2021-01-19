<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tabel".
 *
 * @property string $id
 * @property string $tabel Tabel
 * @property string $keterangan Keterangan
 * @property string $catatan Catatan
 * @property int $status_id
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 *
 * @property Status $status
 * @property User $createdBy
 * @property User $updatedBy
 * @property Tabeldetil[] $tabeldetils
 */
class Tabel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tabel';
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
            [['status_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['tabel'], 'string', 'max' => 25],
            [['keterangan'], 'string', 'max' => 1000],
            [['catatan'], 'string', 'max' => 10000],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['tabel','keterangan','status_id'], 'required'],   
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tabel' => Yii::t('app', 'Tabel'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabeldetil()
    {
        return $this->hasMany(Tabeldetil::className(), ['tabel_id' => 'id']);
    }
}
