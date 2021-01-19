<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id ID#
 * @property string $status Status
 * @property int $impor Impor
 * @property int $pekerja Pekerja
 * @property int $karir Karir
 * @property int $pendapatan Pendapatan
 * @property int $potongan Potongan
 * @property int $otoritas
 * @property int $otoritaspekerja
 * @property int $pendidikan
 * @property int $jabatan
 * @property int $kalender
 * @property int $kalenderdetilupah
 * @property int $tabel
 * @property int $tabeldetil
 * @property int $bank
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 *
 * @property Bank[] $banks
 * @property Hubunganpekerja[] $hubunganpekerjas
 * @property Kalender[] $kalenders
 * @property Kalenderdetil[] $kalenderdetils
 * @property Karir[] $karirs
 * @property Organisasi[] $organisasis
 * @property Otoritas[] $otoritas0
 * @property Otoritaspekerja[] $otoritaspekerjas
 * @property Pemotongan[] $pemotongans
 * @property Pemotonganpekerja[] $pemotonganpekerjas
 * @property Pendapatan[] $pendapatans
 * @property Pendapatanpekerja[] $pendapatanpekerjas
 * @property Pendidikanpekerja[] $pendidikanpekerjas
 * @property Ptkppekerja[] $ptkppekerjas
 * @property User $createdBy
 * @property User $updatedBy
 * @property Suksesipekerja[] $suksesipekerjas
 * @property Tabel[] $tabels
 * @property Tabeldetil[] $tabeldetils
 * @property User[] $users
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['impor', 'pekerja', 'karir', 'pendapatan', 'potongan', 'otoritas', 'otoritaspekerja', 'pendidikan', 'jabatan', 'kalender', 'kalenderdetilupah', 'tabel', 'tabeldetil', 'bank', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['status'], 'string', 'max' => 15],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'impor' => Yii::t('app', 'Impor'),
            'pekerja' => Yii::t('app', 'Pekerja'),
            'karir' => Yii::t('app', 'Karir'),
            'pendapatan' => Yii::t('app', 'Pendapatan'),
            'potongan' => Yii::t('app', 'Potongan'),
            'otoritas' => Yii::t('app', 'Otoritas'),
            'otoritaspekerja' => Yii::t('app', 'Otoritaspekerja'),
            'pendidikan' => Yii::t('app', 'Pendidikan'),
            'jabatan' => Yii::t('app', 'Jabatan'),
            'kalender' => Yii::t('app', 'Kalender'),
            'kalenderdetilupah' => Yii::t('app', 'Kalenderdetilupah'),
            'tabel' => Yii::t('app', 'Tabel'),
            'tabeldetil' => Yii::t('app', 'Tabeldetil'),
            'bank' => Yii::t('app', 'Bank'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanks()
    {
        return $this->hasMany(Bank::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHubunganpekerjas()
    {
        return $this->hasMany(Hubunganpekerja::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalenders()
    {
        return $this->hasMany(Kalender::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalenderdetils()
    {
        return $this->hasMany(Kalenderdetil::className(), ['statusupah_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKarirs()
    {
        return $this->hasMany(Karir::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisasis()
    {
        return $this->hasMany(Organisasi::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtoritas0()
    {
        return $this->hasMany(Otoritas::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtoritaspekerjas()
    {
        return $this->hasMany(Otoritaspekerja::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemotongans()
    {
        return $this->hasMany(Pemotongan::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemotonganpekerjas()
    {
        return $this->hasMany(Pemotonganpekerja::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendapatans()
    {
        return $this->hasMany(Pendapatan::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendapatanpekerjas()
    {
        return $this->hasMany(Pendapatanpekerja::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendidikanpekerjas()
    {
        return $this->hasMany(Pendidikanpekerja::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtkppekerjas()
    {
        return $this->hasMany(Ptkppekerja::className(), ['status_id' => 'id']);
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
    public function getSuksesipekerjas()
    {
        return $this->hasMany(Suksesipekerja::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabels()
    {
        return $this->hasMany(Tabel::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabeldetils()
    {
        return $this->hasMany(Tabeldetil::className(), ['status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['status_id' => 'id']);
    }
}
