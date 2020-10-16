<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'График выплат';

?>
<div class="site-contact">
    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">date</th>
            <th scope="col">monthly payment</th>
            <th scope="col">payable interest</th>
            <th scope="col">payable main</th>
            <th scope="col">balance owed</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($scheduleList as $item): ?>
        <tr>
            <th><?=$item['payment_number']?></th>
            <td><?=$item['payment_date']?></td>
            <td><?=$item['monthly_payment']?></td>
            <td><?=$item['payable_interest']?></td>
            <td><?=$item['payable_main']?></td>
            <td><?=($item['balance_owed'] > 2) ? $item['balance_owed'] : 0?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="list-group">
        <?php foreach ($loansList as $item): ?>
            <a href="<?=Url::to(['site/item', 'id' => $item['id']])?>" class="list-group-item list-group-item-action list-group-item-secondary">
                Займ: <?=$item['loan_amount']?> грн  | От: <?=$item['start_date']?> | Срок: <?=$item['loan_term']?> мес. | Ставка: <?=$item['interest_rate']?>%
            </a>
        <?php endforeach; ?>
    </div>
</div>
