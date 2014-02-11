<?php
/* @var $this UsertypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usertypes',
);

$this->menu=array(
	array('label'=>'Create Usertype', 'url'=>array('create')),
	array('label'=>'Manage Usertype', 'url'=>array('admin')),
);
?>

<h1>Usertypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
