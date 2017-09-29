<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->dropDownList(
        yii\Helpers\ArrayHelper::map(app\models\Company::find()->all(),'id','name'), 
        ['prompt'=>'Select...']); 
    ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    
    <h3>Address Info</h3>
    <?= $form->field($addressModel, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($addressModel, 'apt')->textInput() ?>

    <?= $form->field($addressModel, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($addressModel, 'state')->textInput() ?>

    <?= $form->field($addressModel, 'zipcode')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
