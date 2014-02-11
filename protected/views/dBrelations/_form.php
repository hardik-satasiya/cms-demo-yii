<?php
/* @var $this ManageController */
/* @var $model Users */
/* @var $form CActiveForm */
/* @var $usertype UserType */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->labelEx($model,'usertype_id'); ?>               
                <?php echo $form->dropDownList($model,'usertype_id',$this->getUsertypeDropdown(), array('prompt'=>'Select User Type')); ?>		
		<?php echo $form->error($model,'usertype_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userpass'); ?>
		<?php echo $form->textField($model,'userpass',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'userpass'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textField($model,'remarks',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); 
?>
</div><!-- form -->