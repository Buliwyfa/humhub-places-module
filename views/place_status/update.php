<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model humhub\modules\places\models\PlaceStatus */

$this->title = 'Update Place Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Place Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="place-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>