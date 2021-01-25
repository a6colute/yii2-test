<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
$this->registerJsFile('js/filter.js', ['depends' => [JqueryAsset::class]]);
?>

<div class="student-form">
    <?php $form = ActiveForm::begin(['id' => 'filter-form', 'method' => 'get']); ?>
	
	<?php foreach ($checkboxFilter as $k => $filter) { ?>
	
	<?= Html::label($filter['name'], $k) ?>
	<?= Html::checkboxList($k, $filter['checked'], $filter['attributes']) ?>
	
	<?php } ?>

	<?= Html::label('Цена от', 'priceFrom') ?>
    <?= Html::input('text', 'priceFrom', $priceFrom) ?>

	<?= Html::label('до', 'priceTo') ?>
	<?= Html::input('text', 'priceTo', $priceTo) ?>

    <div class="form-group">
        <?= Html::resetButton('Сбросить фильтр', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_product',
]);
