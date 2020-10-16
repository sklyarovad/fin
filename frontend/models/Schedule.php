<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int $loan_id
 * @property string $payment_number
 * @property string $payment_date
 * @property double $monthly_payment
 * @property double $payable_interest
 * @property double $payable_main
 * @property double $balance_owed
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loan_id', 'payment_number', 'payment_date', 'monthly_payment', 'payable_interest', 'payable_main', 'balance_owed'], 'required'],
            [['loan_id'], 'integer'],
            [['payment_number', 'monthly_payment', 'payable_interest', 'balance_owed'], 'number'],
            [['payment_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'payment_number' => 'Номер платежа',
            'payment_date' => 'Дата платежа',
            'monthly_payment' => 'Ежемесячный платеж',
            'payable_interest' => 'Сумма погашаемых процентов',
            'payable_main' => 'Сумма погашаемых процентов',
            'balance_owed' => 'Остаток основного долга по займу на текущую дату',
        ];
    }
}
