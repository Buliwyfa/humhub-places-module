<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model humhub\modules\places\models\PlaceType */

$this->title = 'Create Place Type';
$this->params['breadcrumbs'][] = ['label' => 'Place Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
