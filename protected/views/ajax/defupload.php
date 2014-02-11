<h4>Default Upload</h4>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
   'id'=>'show-form',
   'enableAjaxValidation'=>false,
       'htmlOptions' => array('enctype' => 'multipart/form-data'),

)); ?>

<div class="row">
    <?php echo $form->labelEx($model,'upload_file'); ?>
    <?php echo $form->fileField($model,'upload_file',array('size'=>45,'maxlength'=>45)); ?>
    <?php echo $form->error($model,'upload_file'); ?>
</div>

<div class="row">
    <?php echo CHtml::submitButton('Submit New Product Form'); ?>
</div>
<?php $this->endWidget(); ?>    

</div>