<?php

namespace backend\modules\mdata\models;

use Yii;

/**
 * This is the model class for table "sectors".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 *
 * @property Companies[] $companies
 * @property Companies[] $companies0
 */
class Sectors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sectors';
    }
    public $fileImport;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Companies::className(), ['sector' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies0()
    {
        return $this->hasMany(Companies::className(), ['sub_sector' => 'id']);
    }
}
