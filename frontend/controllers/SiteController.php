<?php
namespace frontend\controllers;

use frontend\models\Loan;
use frontend\models\RequestForm;
use frontend\models\Schedule;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new RequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $loan = new Loan();
            $loan->start_date = $model->start_date;
            $loan->loan_amount = $model->loan_amount;
            $loan->loan_term = $model->loan_term;
            $loan->interest_rate = $model->interest_rate;
            $loan->save();

            $r = $model->interest_rate / 100 / 12;
            $monthly_payment = round($loan->loan_amount * ($r * pow((1 + $r), $model->loan_term)) / (pow((1 + $r), $model->loan_term) - 1), 1);

            $curr = $model->loan_amount;
            $interest = 0;
            for ($i = 1; $i <= $model->loan_term; $i++) {
                $interest += $curr * $model->interest_rate / 100 / 12;
                $sched = new Schedule();
                $sched->loan_id = $loan->getPrimaryKey();
                $sched->payment_number = $i;
                $sched->payment_date = date('Y-m-d', strtotime($model->start_date) + 3600 * 24 * 30 * $i);
                $sched->monthly_payment = $monthly_payment;
                $sched->payable_interest = round($curr * $model->interest_rate / 100 / 12, 1);
                $sched->payable_main = round($monthly_payment - $curr * $model->interest_rate / 100 / 12, 1);
                $sched->balance_owed = round(($model->loan_amount - $monthly_payment * $i) + $interest, 1);
                $curr = $sched->balance_owed;
                $sched->save();

            }

            Yii::$app->session->setFlash('success', 'График платежей построен');
            return Yii::$app->response->redirect(['site/item', 'id' => $loan->getPrimaryKey()]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    public function actionList()
    {
        $loansList = Loan::find()->asArray()->all();
        return $this->render('list', [
            'loansList' => array_reverse($loansList)
        ]);
    }

    public function actionItem($id)
    {
        $loansList = Loan::find()->asArray()->all();
        $scheduleList = Schedule::find()->where(['loan_id' => $id])->asArray()->all();

        return $this->render('item', [
            'loansList' => array_reverse($loansList),
            'scheduleList' => $scheduleList,
        ]);
    }


    public function actionInit()
    {
        Yii::$app->db->createCommand('CREATE TABLE loan(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            start_date DATE NOT NULL,
            loan_amount NUMERIC NOT NULL,
            loan_term NUMERIC NOT NULL,
            interest_rate NUMERIC NOT NULL
        );')->execute();
        Yii::$app->db->createCommand('CREATE TABLE schedule(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            loan_id INTEGER NOT NULL,
            payment_number NUMERIC NOT NULL,
            payment_date DATE NOT NULL,
            monthly_payment DOUBLE NOT NULL,
            payable_interest DOUBLE NOT NULL,
            payable_main DOUBLE NOT NULL,
            balance_owed DOUBLE NOT NULL
        );')->execute();
    }
}
