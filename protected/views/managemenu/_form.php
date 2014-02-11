<?php
/* @var $this ManagemenuController */
/* @var $model Menu */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_name'); ?>
		<?php echo $form->textField($model,'menu_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'menu_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>		
                <?php echo $form->dropDownList($model,'url',$this->getAllactions()); ?>            
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'static'); ?>		
                <?php echo $form->dropDownList($model,'static',array('0'=>'0','1'=>'1')); ?>
		<?php echo $form->error($model,'static'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'view'); ?>
		<?php echo $form->textField($model,'view',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'view'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
                <?php echo $form->dropDownList($model,'active',array('0'=>'0','1'=>'1')); ?>             
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->