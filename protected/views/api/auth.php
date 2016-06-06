<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 6/1/16
 * Time: 3:34 PM
 *
 * @var $model User
 */

$form = $this->beginWidget('CActiveForm', [
    'id' => 'eveapi-form-index-form',
    'enableAjaxValidation' => false,
    'action' => Yii::app()->createUrl('api/auth'),
]);
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <?php echo $form->textField($model,'region_id',[
            'class' => 'form-control',
            'maxlength' => 2,
            'placeholder' => 'Region ID',
        ]); ?>
        <?php echo $form->error($model,'region_id'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->textField($model,'last_name',[
            'class' => 'form-control',
            'maxlength' => 45,
            'placeholder' => 'Last name',
        ]); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->textField($model,'first_name',[
            'class' => 'form-control',
            'maxlength' => 45,
            'placeholder' => 'First name',
        ]); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->textField($model,'middle_name',[
            'class' => 'form-control',
            'maxlength' => 45,
            'placeholder' => 'Middle name',
        ]); ?>
        <?php echo $form->error($model,'middle_name'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->textField($model,'phone',[
            'class' => 'form-control',
            'maxlength' => 20,
            'placeholder' => 'Phone',
        ]); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('Go',['class' => 'btn btn-primary']) ?>
    </div>
    <?php $this->endWidget(); ?>
</div>