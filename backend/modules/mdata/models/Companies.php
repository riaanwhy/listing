<?php

namespace backend\modules\mdata\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property int $sic_code
 * @property string $name
 * @property int $sector
 * @property int $sub_sector
 * @property int $country
 * @property string $exchange
 * @property string $website
 * @property string $profile
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Countries $country0
 * @property Sectors $sector0
 * @property Sectors $subSector
 * @property Finances[] $finances
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sic_code', 'name', 'sector', 'sub_sector', 'country', 'exchange', 'website', 'profile'], 'required'],
            [['sic_code', 'sector', 'sub_sector', 'country', 'created_by', 'updated_by'], 'integer'],
            [['profile'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'website'], 'string', 'max' => 100],
            [['exchange'], 'string', 'max' => 10],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country' => 'id']],
            [['sector'], 'exist', 'skipOnError' => true, 'targetClass' => Sectors::className(), 'targetAttribute' => ['sector' => 'id']],
            [['sub_sector'], 'exist', 'skipOnError' => true, 'targetClass' => Sectors::className(), 'targetAttribute' => ['sub_sector' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sic_code' => 'Sic Code',
            'name' => 'Name',
            'sector' => 'Sector',
            'sub_sector' => 'Sub Sector',
            'country' => 'Country',
            'exchange' => 'Exchange',
            'website' => 'Website',
            'profile' => 'Profile',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector0()
    {
        return $this->hasOne(Sectors::className(), ['id' => 'sector']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubSector()
    {
        return $this->hasOne(Sectors::className(), ['id' => 'sub_sector']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinances()
    {
        return $this->hasMany(Finances::className(), ['company_id' => 'id']);
    }
}
