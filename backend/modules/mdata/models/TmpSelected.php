<?php

namespace backend\modules\mdata\models;

use Yii;

/**
 * This is the model class for table "tmp_selected".
 *
 * @property int $id
 * @property int $companies_id
 * @property int $finances_id
 */
class TmpSelected extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tmp_selected';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companies_id'], 'required'],
            [['companies_id', 'finances_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companies_id' => 'Companies ID',
            'finances_id' => 'Finances ID',
        ];
    }

     public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'companies_id']);
    }

     public function getFinance()
    {
        return $this->hasOne(Finances::className(), ['id' => 'finances_id']);
    }
}
