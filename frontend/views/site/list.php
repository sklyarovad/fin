<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'График выплат';

?>
<div class="site-contact">
    <div class="list-group">
    <?php foreach ($loansList as $item): ?>
        <a href="<?=Url::to(['site/item', 'id' => $item['id']])?>" class="list-group-item list-group-item-action list-group-item-secondary">
            Займ: <?=$item['loan_amount']?> грн  | От: <?=$item['start_date']?> | Срок: <?=$item['loan_term']?> мес. | Ставка: <?=$item['interest_rate']?>%
        </a>
    <?php endforeach; ?>
    </div>
</div>
