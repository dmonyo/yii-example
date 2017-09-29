<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
        ],
    ]) ?>
    <br>

    <h3>Contacts</h3>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $contactsProvider,
        'columns' => [
            'name',
            'last_name',
            [
                'label' => 'Is Default?',
                'value' => function($model, $key, $index, $column) { return $model->default_contact == 0 ? 'No' : 'Yes';}
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{download} ',
            'buttons' => [
                'download' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-check"></span>',
                        ['/company/makedefault', 'id'=> $model->company_id, 'contact_id' => $model->id], 
                        [
                            'title' => 'Make default',
                            'style'=>  $model->default_contact == 0 ? 'display:block;' : 'display:none',

                            'visible' => false,
                        ]
                    );
                },
            ],
        ],
        ],
    ]); ?>

</div>
