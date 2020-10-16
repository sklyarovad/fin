<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "loan".
 *
 * @property int $id
 * @property string $start_date
 * @property string $loan_amount
 * @property string $loan_term
 * @property string $interest_rate
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'loan_amount', 'loan_term', 'interest_rate'], 'required'],
            [['start_date'], 'safe'],
            [['loan_amount', 'loan_term', 'interest_rate'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'loan_amount' => 'Loan Amount',
            'loan_term' => 'Loan Term',
            'interest_rate' => 'Interest Rate',
        ];
    }
}
