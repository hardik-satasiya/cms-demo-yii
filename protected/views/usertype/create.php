<?php
/* @var $this UsertypeController */
/* @var $model Usertype */

$this->breadcrumbs=array(
	'Usertypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Usertype', 'url'=>array('index')),
	array('label'=>'Manage Usertype', 'url'=>array('admin')),
);
?>

<h1>Create Usertype</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>