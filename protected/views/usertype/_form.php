<?php
/* @var $this UsertypeController */
/* @var $model Usertype */
/* @var $form CActiveForm */
?>
<style>


</style>
<div class="form">

<?php 
//    $form=$this->beginWidget('CActiveForm', array(
//	'id'=>'usertype-form',
//	'enableAjaxValidation'=>false,
//      )); 

        $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'usertype-form',
                'enableAjaxValidation'=>true,
        ));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php //echo ($model->isNewRecord)?"New":"Update"; ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php //echo $form->textField($model,'role',array('size'=>20,'maxlength'=>20)); ?>                
                <?php   if($model->isNewRecord)
                        {
                            echo $form->textField($model,'role',array('size'=>20,'maxlength'=>20));                 
                        }
                        else
                        {
                            echo '<input type="text" value ="'. $model->role .'" disabled="false" >'; 
                        }
                        
                ?>		
		<?php echo $form->error($model,'role'); ?>
	</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'actions'); ?>
                <?php 
//                                echo "<pre/>";                                
//                                echo "model";
//                                print_r($model->actions);
//                                echo "method";
//                                print_r($this->getPriv_chk_box());
                ?>
		<?php //echo $form->textField($model,'actions',array('size'=>60,'maxlength'=>100)); ?>
                <?php //echo $form->checkBoxList($model, 'actions', $this->getPriv_chk_box()); ?>
		<?php //echo $form->error($model,'actions'); ?>
	</div>
        
        <div class="row">        
        <?php
                 $this->widget('CustomDD',array(                                
                                'model'=>$model, 
                                'attribute'=>'actions',                  
                                'tags'=>$this->getCustomDDList($this->getAllPrivs(),'id','labeled'),
                                'preselected'=>$model->actions,
                                'placeholder' => 'Select Priviliges',
                                'width'=>'500px',
                                )
                     );    
        ?>
             
        </div>   
        <div class="row buttons">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit')); ?>                
	</div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->