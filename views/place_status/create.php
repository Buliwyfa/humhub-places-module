<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model humhub\modules\places\models\PlaceStatus */

$this->title = 'Create Place Status';
$this->params['breadcrumbs'][] = ['label' => 'Place Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
