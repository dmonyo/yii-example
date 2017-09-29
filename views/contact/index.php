<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contact', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'fullname',
            [
                'label' => 'Company',
                'value' => 'company.name',
            ],
            [
                'label' => 'Is Default?',
                'value' => function($model, $key, $index, $column) { return $model->default_contact == 0 ? 'No' : 'Yes';}
            ],
            //'telephone',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
