<?php

namespace backend\modules\mdata\models;

use Yii;

/**
 * This is the model class for table "finances".
 *
 * @property int $id
 * @property int $company_id
 * @property string $year
 * @property double $sales
 * @property double $cogs
 * @property double $adm_expense
 * @property double $sales_expense
 * @property double $dep_expense
 * @property double $gm
 * @property double $nm
 * @property double $gm_percent
 * @property double $nm_percent
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Companies $company
 */
class Finances extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finances';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'year', 'sales', 'cogs', 'adm_expense', 'sales_expense', 'dep_expense', 'gm', 'nm', 'gm_percent', 'nm_percent'], 'required'],
            [['company_id', 'created_by', 'updated_by'], 'integer'],
            [['year', 'created_at', 'updated_at'], 'safe'],
            [['sales', 'cogs', 'adm_expense', 'sales_expense', 'dep_expense', 'gm', 'nm', 'gm_percent', 'nm_percent'], 'number'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'year' => 'Year',
            'sales' => 'Sales',
            'cogs' => 'Cogs',
            'adm_expense' => 'Adm Expense',
            'sales_expense' => 'Sales Expense',
            'dep_expense' => 'Dep Expense',
            'gm' => 'Gm',
            'nm' => 'Nm',
            'gm_percent' => 'Gm Percent',
            'nm_percent' => 'Nm Percent',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }
}
