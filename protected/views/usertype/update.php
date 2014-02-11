<?php
/* @var $this UsertypeController */
/* @var $model Usertype */

$this->breadcrumbs=array(
	'Usertypes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Usertype', 'url'=>array('index')),
	array('label'=>'Create Usertype', 'url'=>array('create')),
	array('label'=>'View Usertype', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Usertype', 'url'=>array('admin')),
);
?>

<h1>Update Usertype <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>