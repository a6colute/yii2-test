<?php
use yii\helpers\Html;
?>
<div class="product">
	<?= Html::img('/uploads/' . $model->img) ?>

    <h2><?= Html::encode($model->name) ?></h2>

    <?= $model->price ?> р.
</div>