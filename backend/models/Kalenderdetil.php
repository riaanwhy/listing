<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "kalenderdetil".
 *
 * @property string $id
 * @property string $kalender_id
 * @property int $periode_id
 * @property int $terkini
 * @property string $tgl_awal
 * @property string $tgl_akhir
 * @property int $anggaran
 * @property int $tugas
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 *
 * @property Kalender $kalender
 * @property Periode $periode
 * @property Ptkppekerja[] $ptkppekerjas
 */
class Kalenderdetil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kalenderdetil';
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
            [['kalender_id', 'periode_id', 'terkini', 
				'pu','sa','wp','ap','ar','gl','fa','pi','hr',			
				'anggaran', 'tugas', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['tgl_awal', 'tgl_akhir'], 'safe'],
            [['kalender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kalender::className(), 'targetAttribute' => ['kalender_id' => 'id']],
            [['periode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Periode::className(), 'targetAttribute' => ['periode_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kalender_id' => Yii::t('app', 'Kalender ID'),
            'periode_id' => Yii::t('app', 'Periode'),
            'terkini' => Yii::t('app', 'Terkini'),
            'tgl_awal' => Yii::t('app', 'Tgl Awal'),
            'tgl_akhir' => Yii::t('app', 'Tgl Akhir'),
			'pu' => Yii::t('app', 'Pembelian'),
			'sa' => Yii::t('app', 'Penjualan'),
			'wp' => Yii::t('app', 'Proses'),
			'ap' => Yii::t('app', 'Pembayaran'),
			'ar' => Yii::t('app', 'Penerimaan'),
			'gl' => Yii::t('app', 'Ledger'),
			'fa' => Yii::t('app', 'Aset'),
			'pi' => Yii::t('app', 'Stok'),
			'hr' => Yii::t('app', 'SDM'),			
            'anggaran' => Yii::t('app', 'Budget'),
            'tugas' => Yii::t('app', 'Tugas'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalender()
    {
        return $this->hasOne(Kalender::className(), ['id' => 'kalender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriode()
    {
        return $this->hasOne(Periode::className(), ['id' => 'periode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtkppekerjas()
    {
        return $this->hasMany(Ptkppekerja::className(), ['kalenderdetil_id' => 'id']);
    }
}
