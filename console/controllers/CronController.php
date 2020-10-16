<?php
namespace console\controllers;
use frontend\models\g;
use yii\console\Controller;
use Yii;
class CronController extends Controller
{
    public function actionMin()
    {
        Yii::$app->db->createCommand()->insert('question', [
            'contact' => 'Sam',
            'text' => date('d.m.Y H:i:s'),
        ])->execute();
    }
}