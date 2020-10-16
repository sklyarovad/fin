<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RequestForm extends Model
{
    public $start_date;
    public $loan_amount;
    public $loan_term;
    public $interest_rate;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'loan_amount', 'loan_term', 'interest_rate'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'start_date' => 'Начальная дата',
            'loan_amount' => 'Сумма займа',
            'loan_term' => 'Срок займа (в месяцах)',
            'interest_rate' => 'Годовая процентная ставка',
        ];
    }
}
